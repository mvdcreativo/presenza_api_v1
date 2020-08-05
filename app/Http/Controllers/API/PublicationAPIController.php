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
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/publications",
     *      summary="Get a listing of the Publications.",
     *      tags={"Publication"},
     *      description="Get all Publications",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Publication")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $query = Publication::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $publications = $query->with('property','transaction_types')->get();
        foreach ($publications as $pub) {
            foreach ($pub->transaction_types as $key => $p) {
                $p->pivot->currency = $p->pivot->currency;
            }
        }; 

        return $this->sendResponse($publications->toArray(), 'Publications retrieved successfully');
    }



    /**
     * @param CreatePublicationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/publications",
     *      summary="Store a newly created Publication in storage",
     *      tags={"Publication"},
     *      description="Store Publication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Publication that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Publication")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Publication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePublicationAPIRequest $request)
    {
        $input = $request->all();
// return $input;
        /** @var Publication $publication */
        $publication = Publication::create($input);
        if($request->transactionTypes){
            $trasactions = $request->transactionTypes;
            $publication->transaction_types()->sync($trasactions, true);
        }

        return $this->sendResponse($publication->toArray(), 'Publication saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/publications/{id}",
     *      summary="Display the specified Publication",
     *      tags={"Publication"},
     *      description="Get Publication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Publication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Publication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Publication $publication */
        $publication = Publication::with('property','transaction_types')->find($id);

        if (empty($publication)) {
            return $this->sendError('Publication not found');
        }

        foreach ($publication->transaction_types as $key => $p) {
            $p->pivot->currency = $p->pivot->currency;
        }
        
        return $this->sendResponse($publication->toArray(), 'Publication retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePublicationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/publications/{id}",
     *      summary="Update the specified Publication in storage",
     *      tags={"Publication"},
     *      description="Update Publication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Publication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Publication that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Publication")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Publication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePublicationAPIRequest $request)
    {
        /** @var Publication $publication */
        $publication = Publication::find($id);

        if (empty($publication)) {
            return $this->sendError('Publication not found');
        }

        $publication->fill($request->all());
        $publication->save();
        if($request->transactionTypes){
            $trasactions = $request->transactionTypes;
            $publication->transaction_types()->detach();
            $publication->transaction_types()->sync($trasactions, true);
        }


        return $this->sendResponse($publication->toArray(), 'Publication updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/publications/{id}",
     *      summary="Remove the specified Publication from storage",
     *      tags={"Publication"},
     *      description="Delete Publication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Publication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
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
