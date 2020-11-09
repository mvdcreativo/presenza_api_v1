<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFeatureAPIRequest;
use App\Http\Requests\API\UpdateFeatureAPIRequest;
use App\Models\Feature;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;

use Response;

/**
 * Class FeatureController
 * @package App\Http\Controllers\API
 */

class FeatureAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/features",
     *      summary="Get a listing of the Features.",
     *      tags={"Feature"},
     *      description="Get all Features",
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
     *                  @SWG\Items(ref="#/definitions/Feature")
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
        $query = Feature::query();

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

        $features = $query
        ->with('feature','features')
        ->filter($request->get('filter'))
        ->orderBy('id', $sort)
        ->paginate($per_page);


        return $this->sendResponse($features->toArray(), 'Features retrieved successfully');
    }

    /**
     * @param CreateFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/features",
     *      summary="Store a newly created Feature in storage",
     *      tags={"Feature"},
     *      description="Store Feature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Feature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Feature")
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
     *                  ref="#/definitions/Feature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var Feature $feature */
        $input['slug'] = Str::slug($request->name);
        $feature = Feature::create($input);

        if($request->hasFile('icon')){
            $icon = $request->file('icon');
            $path = Storage::disk('public')->put('images/icons',$icon  );
            $feature->fill(['icon' => asset('storage/'.$path)])->save();            
        }


        return $this->sendResponse($feature->toArray(), 'Feature saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/features/{id}",
     *      summary="Display the specified Feature",
     *      tags={"Feature"},
     *      description="Get Feature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Feature",
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
     *                  ref="#/definitions/Feature"
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
        /** @var Feature $feature */
        $feature = Feature::with('feature','features')->find($id);

        if (empty($feature)) {
            return $this->sendError('Feature not found');
        }

        return $this->sendResponse($feature->toArray(), 'Feature retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/features/{id}",
     *      summary="Update the specified Feature in storage",
     *      tags={"Feature"},
     *      description="Update Feature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Feature",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Feature that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Feature")
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
     *                  ref="#/definitions/Feature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFeatureAPIRequest $request)
    {
        /** @var Feature $feature */
        $feature = Feature::find($id);

        if (empty($feature)) {
            return $this->sendError('Feature not found');
        }
        
        $feature->fill($request->all());

        if($request->name)$feature->slug = Str::slug($request->name);
        $feature->save();


        if($request->hasFile('icon')){
                $icon = $request->file('icon');
                $path = Storage::disk('public')->put('images/icons',$icon  );
                $feature->fill(['icon' => asset('storage/'.$path)])->save();            
         }

        return $this->sendResponse($feature->toArray(), 'Feature updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/features/{id}",
     *      summary="Remove the specified Feature from storage",
     *      tags={"Feature"},
     *      description="Delete Feature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Feature",
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
        /** @var Feature $feature */
        $feature = Feature::find($id);

        if (empty($feature)) {
            return $this->sendError('Feature not found');
        }

        $feature->delete();

        return $this->sendSuccess('Feature deleted successfully');
    }


    public function all(Request $request)
    {
        $query = Feature::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        $query->with('feature','features');
        $features = $query->get();

        return $this->sendResponse($features->toArray(), 'Currencies retrieved successfully');
    }
}
