<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Image;
use Illuminate\Http\Request;
use Flash;
use Response;

class ImageController extends AppBaseController
{
    /**
     * Display a listing of the Image.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Image $images */
        $images = Image::paginate(10);

        return view('images.index')
            ->with('images', $images);
    }

    /**
     * Show the form for creating a new Image.
     *
     * @return Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created Image in storage.
     *
     * @param CreateImageRequest $request
     *
     * @return Response
     */
    public function store(CreateImageRequest $request)
    {
        $input = $request->all();

        /** @var Image $image */
        $image = Image::create($input);

        Flash::success('Image saved successfully.');

        return redirect(route('images.index'));
    }

    /**
     * Display the specified Image.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        return view('images.show')->with('image', $image);
    }

    /**
     * Show the form for editing the specified Image.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        return view('images.edit')->with('image', $image);
    }

    /**
     * Update the specified Image in storage.
     *
     * @param int $id
     * @param UpdateImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImageRequest $request)
    {
        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        $image->fill($request->all());
        $image->save();

        Flash::success('Image updated successfully.');

        return redirect(route('images.index'));
    }

    /**
     * Remove the specified Image from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Image $image */
        $image = Image::find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        $image->delete();

        Flash::success('Image deleted successfully.');

        return redirect(route('images.index'));
    }
}
