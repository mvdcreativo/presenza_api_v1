<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Flash;
use Response;

class FeatureController extends AppBaseController
{
    /**
     * Display a listing of the Feature.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Feature $features */
        $features = Feature::paginate(10);

        return view('features.index')
            ->with('features', $features);
    }

    /**
     * Show the form for creating a new Feature.
     *
     * @return Response
     */
    public function create()
    {
        return view('features.create');
    }

    /**
     * Store a newly created Feature in storage.
     *
     * @param CreateFeatureRequest $request
     *
     * @return Response
     */
    public function store(CreateFeatureRequest $request)
    {
        $input = $request->all();

        /** @var Feature $feature */
        $input['slug'] = Str::slug($request->name);
        $feature = Feature::create($input);

        Flash::success('Feature saved successfully.');

        return redirect(route('features.index'));
    }

    /**
     * Display the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Feature $feature */
        $feature = Feature::find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        return view('features.show')->with('feature', $feature);
    }

    /**
     * Show the form for editing the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Feature $feature */
        $feature = Feature::find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        return view('features.edit')->with('feature', $feature);
    }

    /**
     * Update the specified Feature in storage.
     *
     * @param int $id
     * @param UpdateFeatureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeatureRequest $request)
    {
        /** @var Feature $feature */
        $feature = Feature::find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        $feature->fill($request->all());
        $feature->save();

        Flash::success('Feature updated successfully.');

        return redirect(route('features.index'));
    }

    /**
     * Remove the specified Feature from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Feature $feature */
        $feature = Feature::find($id);

        if (empty($feature)) {
            Flash::error('Feature not found');

            return redirect(route('features.index'));
        }

        $feature->delete();

        Flash::success('Feature deleted successfully.');

        return redirect(route('features.index'));
    }
}
