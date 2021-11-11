<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePublicationAPIRequest;
use App\Http\Requests\API\UpdatePublicationAPIRequest;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PublicationController
 * @package App\Http\Controllers\API
 */

class PublicationAPIController extends AppBaseController
{



    public function index(Request $request)
    {
        $query = Publication::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }


        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        } else {
            $per_page = 20;
        }

        if ($request->get('sort')) {
            $sort = $request->get('sort');
        } else {
            $sort = "desc";
        }

        if($request->get('features_parameter')){
            $filterParams = $request->get('features_parameter');
        }else{
            $filterParams = null;
        }
        if($request->get('status_id')) {
            $status_id = $request->get('status_id');
        }else{
            $status_id = null;
        }

        $active = $request->get('active') ? true : false;



        $publications = $query
            ->with('property', 'transaction_types', 'status')
            ->filter($request->get('filter'))
            ->active($active)
            ->filter_status_id($status_id)
            ->filter_params($filterParams)
            ->orderBy('id', $sort)
            ->paginate($per_page);

        foreach ($publications as $pub) {
            foreach ($pub->transaction_types as $key => $p) {
                $p->pivot->currency = $p->pivot->currency;
            }
        };

        return $this->sendResponse($publications->toArray(), 'Publications retrieved successfully');
    }



    public function store(CreatePublicationAPIRequest $request)
    {
        $input = $request->all();
        // return $input;
        /** @var Publication $publication */
        $publication = Publication::create($input);
        if ($request->transaction_types) {
            $trasactions = $request->transaction_types;
            $publication->transaction_types()->sync($trasactions, true);
        }

        return $this->sendResponse($publication->toArray(), 'Publication saved successfully');
    }


    public function show($id)
    {
        /** @var Publication $publication */
        $publication = Publication::with('property', 'transaction_types')->find($id);

        if (empty($publication)) {
            return $this->sendError('Publication not found');
        }

        foreach ($publication->transaction_types as $key => $p) {
            $p->pivot->currency = $p->pivot->currency;
        }

        return $this->sendResponse($publication->toArray(), 'Publication retrieved successfully');
    }

    public function showBySlug($id,$slug)
    {
        /** @var Publication $publication */
        $publication = Publication::with('property', 'transaction_types')
        ->whereHas('property', function($q) use ($slug, $id){
            $q->where('slug', $slug);
            $q->where('id', $id);
        })->first();

        if (empty($publication)) {
            return $this->sendError('Publication not found');
        }

        foreach ($publication->transaction_types as $key => $p) {
            $p->pivot->currency = $p->pivot->currency;
        }

        return $this->sendResponse($publication->toArray(), 'Publication retrieved successfully');
    }

    public function update($id, UpdatePublicationAPIRequest $request)
    {
        /** @var Publication $publication */
        $publication = Publication::with('property', 'transaction_types')->find($id);

        if (empty($publication)) {
            return $this->sendError('Publication not found');
        }

        $publication->fill($request->all());
        $publication->save();
        if ($request->transaction_types) {
            $trasactions = $request->transaction_types;
            $publication->transaction_types()->detach();
            $publication->transaction_types()->sync($trasactions, true);
            $publication->touch();
            $publication = Publication::with('property', 'transaction_types')->find($id);

            return $this->sendResponse($publication->toArray(), 'Publication updated successfully');

        }


        return $this->sendResponse($publication->toArray(), 'Publication updated successfully');
    }


    public function destroy($id)
    {
        /** @var Publication $publication */
        $publication = Publication::find($id);

        if (empty($publication)) {
            return $this->sendError('Publication not found');
        }

        $publication->delete();

        return $this->sendSuccess('Publication deleted successfully');
    }
}
