<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProvinceAPIRequest;
use App\Http\Requests\API\UpdateProvinceAPIRequest;
use App\Models\Province;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProvinceController
 * @package App\Http\Controllers\API
 */

class ProvinceAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/provinces",
     *      summary="Get a listing of the Provinces.",
     *      tags={"Province"},
     *      description="Get all Provinces",
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
     *                  @SWG\Items(ref="#/definitions/Province")
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
        $query = Province::query();

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

        $provinces = $query
        ->with('country','cities' )
        ->filter($request->get('filter'))
        ->orderBy('id',  $sort )
        ->paginate($per_page);

       

        return $this->sendResponse($provinces->toArray(), 'Provinces retrieved successfully');
    }

    /**
     * @param CreateProvinceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/provinces",
     *      summary="Store a newly created Province in storage",
     *      tags={"Province"},
     *      description="Store Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Province that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Province")
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
     *                  ref="#/definitions/Province"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProvinceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Province $province */
        $input['slug'] = Str::slug($request->name);
        $province = Province::create($input);

        return $this->sendResponse($province->toArray(), 'Province saved successfully');
    }

    
    public function show($id)
    {
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            return $this->sendError('Province not found');
        }

        return $this->sendResponse($province->toArray(), 'Province retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProvinceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/provinces/{id}",
     *      summary="Update the specified Province in storage",
     *      tags={"Province"},
     *      description="Update Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Province",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Province that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Province")
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
     *                  ref="#/definitions/Province"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProvinceAPIRequest $request)
    {
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            return $this->sendError('Province not found');
        }

        $province->fill($request->all());
        $province->slug = Str::slug($request->name);
        $province->save();

        return $this->sendResponse($province->toArray(), 'Province updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/provinces/{id}",
     *      summary="Remove the specified Province from storage",
     *      tags={"Province"},
     *      description="Delete Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Province",
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
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            return $this->sendError('Province not found');
        }

        $province->delete();

        return $this->sendSuccess('Province deleted successfully');
    }
}
