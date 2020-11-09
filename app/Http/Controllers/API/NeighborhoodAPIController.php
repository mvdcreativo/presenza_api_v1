<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNeighborhoodAPIRequest;
use App\Http\Requests\API\UpdateNeighborhoodAPIRequest;
use App\Models\Neighborhood;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NeighborhoodController
 * @package App\Http\Controllers\API
 */

class NeighborhoodAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/neighborhoods",
     *      summary="Get a listing of the Neighborhoods.",
     *      tags={"Neighborhood"},
     *      description="Get all Neighborhoods",
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
     *                  @SWG\Items(ref="#/definitions/Neighborhood")
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
        $query = Neighborhood::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

       
        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        }

        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        $neighborhoods = $query
            ->with('municipality')
            ->filter($request->get('filter'))
            ->orderBy('id',$sort)
            ->paginate($per_page);

        return $this->sendResponse($neighborhoods->toArray(), 'Neighborhoods retrieved successfully');
    }

    /**
     * @param CreateNeighborhoodAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/neighborhoods",
     *      summary="Store a newly created Neighborhood in storage",
     *      tags={"Neighborhood"},
     *      description="Store Neighborhood",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Neighborhood that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Neighborhood")
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
     *                  ref="#/definitions/Neighborhood"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNeighborhoodAPIRequest $request)
    {
        $input = $request->all();

        /** @var Neighborhood $neighborhood */
        $input['slug'] = Str::slug($request->name);
        $neighborhood = Neighborhood::create($input);

        return $this->sendResponse($neighborhood->toArray(), 'Neighborhood saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/neighborhoods/{id}",
     *      summary="Display the specified Neighborhood",
     *      tags={"Neighborhood"},
     *      description="Get Neighborhood",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Neighborhood",
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
     *                  ref="#/definitions/Neighborhood"
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
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            return $this->sendError('Neighborhood not found');
        }

        return $this->sendResponse($neighborhood->toArray(), 'Neighborhood retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNeighborhoodAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/neighborhoods/{id}",
     *      summary="Update the specified Neighborhood in storage",
     *      tags={"Neighborhood"},
     *      description="Update Neighborhood",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Neighborhood",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Neighborhood that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Neighborhood")
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
     *                  ref="#/definitions/Neighborhood"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNeighborhoodAPIRequest $request)
    {
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            return $this->sendError('Neighborhood not found');
        }

        $neighborhood->fill($request->all());
        $neighborhood->slug = Str::slug($request->name);
        $neighborhood->save();

        return $this->sendResponse($neighborhood->toArray(), 'Neighborhood updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/neighborhoods/{id}",
     *      summary="Remove the specified Neighborhood from storage",
     *      tags={"Neighborhood"},
     *      description="Delete Neighborhood",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Neighborhood",
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
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            return $this->sendError('Neighborhood not found');
        }

        $neighborhood->delete();

        return $this->sendSuccess('Neighborhood deleted successfully');
    }
}
