<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMunicipalityAPIRequest;
use App\Http\Requests\API\UpdateMunicipalityAPIRequest;
use App\Models\Municipality;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MunicipalityController
 * @package App\Http\Controllers\API
 */

class MunicipalityAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/municipalities",
     *      summary="Get a listing of the Municipalities.",
     *      tags={"Municipality"},
     *      description="Get all Municipalities",
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
     *                  @SWG\Items(ref="#/definitions/Municipality")
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
        $query = Municipality::query();

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
        };
        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        $municipalities = $query
        ->with('city','neighborhoods' )
        ->filter($request->get('filter'))
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->sendResponse($municipalities->toArray(), 'Municipalities retrieved successfully');
    }

    /**
     * @param CreateMunicipalityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/municipalities",
     *      summary="Store a newly created Municipality in storage",
     *      tags={"Municipality"},
     *      description="Store Municipality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Municipality that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Municipality")
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
     *                  ref="#/definitions/Municipality"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMunicipalityAPIRequest $request)
    {
        $input = $request->all();

        /** @var Municipality $municipality */
        $input['slug'] = Str::slug($request->name);
        $municipality = Municipality::create($input);

        return $this->sendResponse($municipality->toArray(), 'Municipality saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/municipalities/{id}",
     *      summary="Display the specified Municipality",
     *      tags={"Municipality"},
     *      description="Get Municipality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Municipality",
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
     *                  ref="#/definitions/Municipality"
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
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            return $this->sendError('Municipality not found');
        }

        return $this->sendResponse($municipality->toArray(), 'Municipality retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMunicipalityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/municipalities/{id}",
     *      summary="Update the specified Municipality in storage",
     *      tags={"Municipality"},
     *      description="Update Municipality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Municipality",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Municipality that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Municipality")
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
     *                  ref="#/definitions/Municipality"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMunicipalityAPIRequest $request)
    {
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            return $this->sendError('Municipality not found');
        }

        $municipality->fill($request->all());
        $municipality->slug = Str::slug($request->name);
        $municipality->save();

        return $this->sendResponse($municipality->toArray(), 'Municipality updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/municipalities/{id}",
     *      summary="Remove the specified Municipality from storage",
     *      tags={"Municipality"},
     *      description="Delete Municipality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Municipality",
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
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            return $this->sendError('Municipality not found');
        }

        $municipality->delete();

        return $this->sendSuccess('Municipality deleted successfully');
    }
}
