<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePropertyAPIRequest;
use App\Http\Requests\API\UpdatePropertyAPIRequest;
use App\Models\Property;
use Illuminate\Support\Str;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;

use Response;

/**
 * Class PropertyController
 * @package App\Http\Controllers\API
 */

class PropertyAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/properties",
     *      summary="Get a listing of the Properties.",
     *      tags={"Property"},
     *      description="Get all Properties",
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
     *                  @SWG\Items(ref="#/definitions/Property")
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
        $query = Property::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $properties = $query->with('neighborhood','features')->get();

        return $this->sendResponse($properties->toArray(), 'Properties retrieved successfully');
    }

    /**
     * @param CreatePropertyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/properties",
     *      summary="Store a newly created Property in storage",
     *      tags={"Property"},
     *      description="Store Property",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Property that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Property")
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
     *                  ref="#/definitions/Property"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePropertyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Property $property */
        $input['slug'] = Str::slug($request->title);
        $property = Property::create($input);
        if($request->features){
            $features = $request->features;
            $property->features()->sync($features, true);
        }

        if($request->hasFile('images')){
            foreach($request->file('images') as $image)
            {

                // echo $image->path();
                $path = Storage::disk('public')->put('images/properties',  $image);
                // $product->fill(['file' => asset($path)])->save();
                $image = new Image;
                $image->fill(['url' => asset('storage/'.$path)])->save();
                $image->properties()->sync($id);
                // $path = $image->getClientOriginalName();
                // $image->move(public_path().'/images/publications/', $name);
                // $images_name[] = $name;

            }
         }
        return $this->sendResponse($property->toArray(), 'Property saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/properties/{id}",
     *      summary="Display the specified Property",
     *      tags={"Property"},
     *      description="Get Property",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Property",
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
     *                  ref="#/definitions/Property"
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
        /** @var Property $property */
        $property = Property::with('neighborhood','features','propertyType')->find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        return $this->sendResponse($property->toArray(), 'Property retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePropertyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/properties/{id}",
     *      summary="Update the specified Property in storage",
     *      tags={"Property"},
     *      description="Update Property",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Property",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Property that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Property")
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
     *                  ref="#/definitions/Property"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePropertyAPIRequest $request)
    {
        /** @var Property $property */
        $property = Property::find($id);
        // return $request->all();
        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        $property->fill($request->all());
        $property->slug = Str::slug($request->title);
        $property->save();
        if($request->features){
            $features = $request->features;
            $property->features()->sync($features, true);
        }
        if($request->hasFile('images')){
            foreach($request->file('images') as $image)
            {

                // echo $image->path();
                $path = Storage::disk('public')->put('images/properties',  $image);
                // $product->fill(['file' => asset($path)])->save();
                $image = new Image;
                $image->fill(['url' => asset('storage/'.$path)])->save();
                $image->properties()->sync($id);
                // $path = $image->getClientOriginalName();
                // $image->move(public_path().'/images/publications/', $name);
                // $images_name[] = $name;

            }
         }

        return $this->sendResponse($property->toArray(), 'Property updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/properties/{id}",
     *      summary="Remove the specified Property from storage",
     *      tags={"Property"},
     *      description="Delete Property",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Property",
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
        /** @var Property $property */
        $property = Property::find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        $property->delete();

        return $this->sendSuccess('Property deleted successfully');
    }
}
