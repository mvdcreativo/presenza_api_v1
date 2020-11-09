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
use Intervention\Image\Facades\Image as AlterImage;

use Response;

/**
 * Class PropertyController
 * @package App\Http\Controllers\API
 */

class PropertyAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $query = Property::query();

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

        $properties = $query
            ->with('neighborhood','features', 'status', 'userOwner', 'publication' )
            ->filter($request->get('filter'))
            ->orderBy('id', $sort)
            ->paginate($per_page);

        return $this->sendResponse($properties->toArray(), 'Properties retrieved successfully');
    }

   
    public function store(CreatePropertyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Property $property */
        $input['slug'] = Str::slug($request->title);
        $property = Property::with('neighborhood','features','propertyType','images')->create($input);
        if($request->features){
            $features = $request->features;
            $property->features()->sync($features, true);
        }

        if($request->hasFile('images')){
            foreach($request->file('images') as $image)
            {

                $url = 'images/properties/';
                $imageNewName = $property->id.'-'.time().'.jpg';

                $path_larg = $url.'larg/'.$imageNewName;
                $path_medium = $url.'medium/'.$imageNewName;
                $path_small = $url.'small/'.$imageNewName;
                $larg_img = $this->transformImage($image, 1280, 900, $path_larg);
                $medium_img = $this->transformImage($image, 600, 400, $path_medium);
                $small_img = $this->transformImage($image, 150, 100, $path_small);

                // return [$larg_img , $medium_img , $small_img] ;
                if ($larg_img && $medium_img && $small_img) {
                    $image = new Image;
                    $image->fill(
                        [
                            'url' => asset('storage/'.$path_larg),
                            'url_small' => asset('storage/'.$path_medium),
                            'url_medium' => asset('storage/'.$path_small)
                        ])->save();
                    $image->properties()->sync($property->id);
                }else{
                    return "error al subir imagenes";
                }

            }
            return $this->sendResponse($property->toArray(), 'Property saved successfully');
         }
        return $this->sendResponse($property->toArray(), 'Property saved successfully');
    }

    public function show($id)
    {
        /** @var Property $property */
        $property = Property::with('neighborhood','features','propertyType','images','publication')->find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        return $this->sendResponse($property->toArray(), 'Property retrieved successfully');
    }

    public function update($id, UpdatePropertyAPIRequest $request)
    {
        /** @var Property $property */
        $property = Property::with('neighborhood','features','propertyType','images')->find($id);
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
                $this->validate($request, [

                    'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048000'
        
                ]);
                // return $originalPath;
                // $path_larg = Storage::disk('public')->put('images/properties/larg',  $image);
                $url = 'images/properties/';
                $imageNewName = $property->id.'-'.time().'.jpg';

                $path_larg = $url.'larg/'.$imageNewName;
                $path_medium = $url.'medium/'.$imageNewName;
                $path_small = $url.'small/'.$imageNewName;
                $larg_img = $this->transformImage($image, 1280, 900, $path_larg);
                $medium_img = $this->transformImage($image, 600, 400, $path_medium);
                $small_img = $this->transformImage($image, 150, 100, $path_small);

                // return [$larg_img , $medium_img , $small_img] ;
                if ($larg_img && $medium_img && $small_img) {
                    $image = new Image;
                    $image->fill(
                        [
                            'url' => asset('storage/'.$path_larg),
                            'url_small' => asset('storage/'.$path_medium),
                            'url_medium' => asset('storage/'.$path_small)
                        ])->save();
                    $image->properties()->sync($property->id);
                }else{
                    return "error al subir imagenes";
                }


            }
            $property = Property::with('images')->find($id);
            return $this->sendResponse($property->toArray(), 'Property saved successfully');

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
    public function destroy(Request $request, $id)
    {
        /** @var Property $property */
        // $property = Property::find($id);

        // if (empty($property)) {
        //     return $this->sendError('Property not found');
        // }

        // $property->delete();

        // return $this->sendSuccess('Property deleted successfully');

        $property = Property::with('images')->findOrFail($id);

        if($request->image_id){
            foreach ($property->images as $image) {
                if($image->id == $request->image_id){
                    $img = Image::find($image->id);
                    $imgName = explode("/", $image->url);
                    // return $imgName;
                    

                    if($img->delete()){
                        Storage::disk('public')->delete('images/properties/larg/'.$imgName[7]);
                        Storage::disk('public')->delete('images/properties/medium/'.$imgName[7]);
                        Storage::disk('public')->delete('images/properties/small/'.$imgName[7]);
                        $property = Property::with('images')->findOrFail($id);
                        return $this->sendResponse($property->toArray(), 'Image deleted successfully');
                    }
                    
                    // return response()->json($property, 200);
                

                }
            }
        }else{
            
            foreach ($property->images as $image) {
                $img = Image::find($image->id);
                $imgName = explode("/", $image->url);
                Storage::disk('public')->delete('images/properties/larg/'.$imgName[7]);
                Storage::disk('public')->delete('images/properties/medium/'.$imgName[7]);
                Storage::disk('public')->delete('images/properties/small/'.$imgName[7]);
                $img->delete();
                
            }
            $property->delete();
            return $this->sendSuccess('Property deleted successfully');
        }
    }




    private function transformImage($image, $width, $height, $path)
    {
        $result_image = AlterImage::make($image)->encode('jpg',75);
        $result_image->resize($width, $height, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        } );
        // $larg_image->crop(1280,800);
        $store = Storage::disk('public')->put( $path, $result_image->stream());
        return $store;
        
    }
}
