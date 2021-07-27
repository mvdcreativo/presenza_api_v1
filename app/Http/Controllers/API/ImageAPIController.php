<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateImageAPIRequest;
use App\Http\Requests\API\UpdateImageAPIRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Intervention\Image\Facades\Image as AlterImage;
use Illuminate\Support\Facades\Storage;



/**
 * Class ImageController
 * @package App\Http\Controllers\API
 */

class ImageAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $query = Image::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $images = $query->get();

        return $this->sendResponse($images->toArray(), 'Images retrieved successfully');
    }


    public function store(CreateImageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Image $image */
        $image = Image::create($input);

        return $this->sendResponse($image->toArray(), 'Image saved successfully');
    }


    public function show($id)
    {
        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            return $this->sendError('Image not found');
        }

        return $this->sendResponse($image->toArray(), 'Image retrieved successfully');
    }


    public function update($id, UpdateImageAPIRequest $request)
    {

        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            return $this->sendError('Image not found');
        }
        // return $image

        if ($request->get('rotate')) {
            $grad_rotate = $request->get('rotate');
            $imgName = explode("/", $image->url);

            $img_larg = AlterImage::make(Storage::disk('public')->get('images/properties/larg/' . $imgName[7]));
            $img_med = AlterImage::make(Storage::disk('public')->get('images/properties/medium/' . $imgName[7]));
            $img_small = AlterImage::make(Storage::disk('public')->get('images/properties/small/' . $imgName[7]));

            $img_larg->rotate(-$grad_rotate);
            $img_med->rotate(-$grad_rotate);
            $img_small->rotate(-$grad_rotate);
            $newName = "r_" . $grad_rotate . $imgName[7];
            Storage::disk('public')->put('images/properties/larg/' . $newName, $img_larg->stream());
            Storage::disk('public')->put('images/properties/medium/' . $newName, $img_med->stream());
            Storage::disk('public')->put('images/properties/small/' . $newName, $img_small->stream());

            $image->fill(
                [
                    'url' => asset('storage/images/properties/larg/' . $newName),
                    'url_small' => asset('storage/images/properties/small/' . $newName),
                    'url_medium' => asset('storage/images/properties/medium/' . $newName)
                ]
            )->save();
            Storage::disk('public')->delete('images/properties/larg/' . $imgName[7]);
            Storage::disk('public')->delete('images/properties/medium/' . $imgName[7]);
            Storage::disk('public')->delete('images/properties/small/' . $imgName[7]);
        } else {
            $image->fill($request->all());
            $image->save();
        }




        return $this->sendResponse($image->toArray(), 'Image updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/images/{id}",
     *      summary="Remove the specified Image from storage",
     *      tags={"Image"},
     *      description="Delete Image",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Image",
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
        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            return $this->sendError('Image not found');
        }

        $image->delete();

        return $this->sendSuccess('Image deleted successfully');
    }
}
