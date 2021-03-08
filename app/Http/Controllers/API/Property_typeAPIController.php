<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProperty_typeAPIRequest;
use App\Http\Requests\API\UpdateProperty_typeAPIRequest;
use App\Models\Property_type;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Property_typeController
 * @package App\Http\Controllers\API
 */

class Property_typeAPIController extends AppBaseController
{
    
    public function index(Request $request)
    {
        $query = Property_type::query();

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
            $sort = "asc";
        }

        $propertyTypes = $query
        ->with('status')
        ->filter($request->get('filter'))
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->sendResponse($propertyTypes->toArray(), 'Property Types retrieved successfully');
    }

    /**
     * @param CreateProperty_typeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/propertyTypes",
     *      summary="Store a newly created Property_type in storage",
     *      tags={"Property_type"},
     *      description="Store Property_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Property_type that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Property_type")
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
     *                  ref="#/definitions/Property_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProperty_typeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Property_type $propertyType */
        $input['slug'] = Str::slug($request->name);
        $propertyType = Property_type::create($input);

        return $this->sendResponse($propertyType->toArray(), 'Property Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/propertyTypes/{id}",
     *      summary="Display the specified Property_type",
     *      tags={"Property_type"},
     *      description="Get Property_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Property_type",
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
     *                  ref="#/definitions/Property_type"
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
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            return $this->sendError('Property Type not found');
        }

        return $this->sendResponse($propertyType->toArray(), 'Property Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProperty_typeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/propertyTypes/{id}",
     *      summary="Update the specified Property_type in storage",
     *      tags={"Property_type"},
     *      description="Update Property_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Property_type",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Property_type that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Property_type")
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
     *                  ref="#/definitions/Property_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProperty_typeAPIRequest $request)
    {
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            return $this->sendError('Property Type not found');
        }

        $propertyType->fill($request->all());
        $propertyType->slug = Str::slug($request->name);
        $propertyType->save();

        return $this->sendResponse($propertyType->toArray(), 'Property_type updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/propertyTypes/{id}",
     *      summary="Remove the specified Property_type from storage",
     *      tags={"Property_type"},
     *      description="Delete Property_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Property_type",
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
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            return $this->sendError('Property Type not found');
        }

        $propertyType->delete();

        return $this->sendSuccess('Property Type deleted successfully');
    }
}
