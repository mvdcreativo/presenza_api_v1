<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePropertyAPIRequest;
use App\Http\Requests\API\UpdatePropertyAPIRequest;
use App\Models\Property;
use Illuminate\Support\Str;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Video;
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
            ->with('neighborhood','features', 'status', 'userOwner', 'publication' , 'videos')
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
                $original_name = $image->getClientOriginalName();
                $ext = pathinfo( $original_name,PATHINFO_EXTENSION );
                $imageNewName = $property->id.'-'.time().$ext;
                $path_larg = $url.'larg/'.$imageNewName;
                $path_medium = $url.'medium/'.$imageNewName;
                $path_small = $url.'small/'.$imageNewName;
                $larg_img = $this->transformImage($image, 1280, 1000, $path_larg);
                $medium_img = $this->transformImage($image, 600, 500, $path_medium);
                $small_img = $this->transformImage($image, 150, 120, $path_small);

                // return [$larg_img , $medium_img , $small_img] ;
                if ($larg_img && $medium_img && $small_img) {
                    $image = new Image;
                    $image->fill(
                        [
                            'url' => asset('storage/'.$path_larg),
                            'url_small' => asset('storage/'.$path_small),
                            'url_medium' => asset('storage/'.$path_medium)
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
        $property = Property::with('neighborhood','features','propertyType','images','publication', 'videos')->find($id);

        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        return $this->sendResponse($property->toArray(), 'Property retrieved successfully');
    }

    public function update($id, UpdatePropertyAPIRequest $request)
    {
        /** @var Property $property */
        $property = Property::with('neighborhood','features','propertyType','images', 'videos')->find($id);
        // return $request->all();
        if (empty($property)) {
            return $this->sendError('Property not found');
        }

        $property->fill($request->all());
        $property->slug = Str::slug($request->title);
        $property->save();
        if($request->features){
            $features = $request->features;
            // return $features;
            $property->features()->detach();
            $property->features()->attach($features);
        }
        if($request->video){
            $video = new Video;
            $video->url = $request->video;
            $video->save();
            $video->properties()->sync($property->id);

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
                $original_name = $image->getClientOriginalName();
                $ext = ".".pathinfo( $original_name,PATHINFO_EXTENSION );
                $imageNewName = $property->id.'-'.time().$ext;

                $path_larg = $url.'larg/'.$imageNewName;
                $path_medium = $url.'medium/'.$imageNewName;
                $path_small = $url.'small/'.$imageNewName;
                $larg_img = $this->transformImage($image, 1280, 1000, $path_larg);
                $medium_img = $this->transformImage($image, 600, 500, $path_medium);
                $small_img = $this->transformImage($image, 150, 120, $path_small);

                // return [$larg_img , $medium_img , $small_img] ;
                if ($larg_img && $medium_img && $small_img) {
                    $image = new Image;
                    $image->fill(
                        [
                            'url' => asset('storage/'.$path_larg),
                            'url_small' => asset('storage/'.$path_small),
                            'url_medium' => asset('storage/'.$path_medium)
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



    public function destroy(Request $request, $id)
    {

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
        $result_image = AlterImage::make($image);
        $result_image->resize($width, null, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        } );
        // $larg_image->crop(1280,800);
        $store = Storage::disk('public')->put( $path, $result_image->stream());
        return $store;
        
    }
}
