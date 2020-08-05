<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Property;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Flash;
use Response;

class PropertyController extends AppBaseController
{
    /**
     * Display a listing of the Property.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Property $properties */
        $properties = Property::paginate(10);

        return view('properties.index')
            ->with('properties', $properties);
    }

    /**
     * Show the form for creating a new Property.
     *
     * @return Response
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created Property in storage.
     *
     * @param CreatePropertyRequest $request
     *
     * @return Response
     */
    public function store(CreatePropertyRequest $request)
    {
        $input = $request->all();

        /** @var Property $property */
        $property = Property::create($input);

        Flash::success('Property saved successfully.');

        return redirect(route('properties.index'));
    }

    /**
     * Display the specified Property.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Property $property */
        $property = Property::find($id);

        if (empty($property)) {
            Flash::error('Property not found');

            return redirect(route('properties.index'));
        }

        return view('properties.show')->with('property', $property);
    }

    /**
     * Show the form for editing the specified Property.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Property $property */
        $property = Property::find($id);

        if (empty($property)) {
            Flash::error('Property not found');

            return redirect(route('properties.index'));
        }

        return view('properties.edit')->with('property', $property);
    }

    /**
     * Update the specified Property in storage.
     *
     * @param int $id
     * @param UpdatePropertyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePropertyRequest $request)
    {
        /** @var Property $property */
        $property = Property::find($id);

        if (empty($property)) {
            Flash::error('Property not found');

            return redirect(route('properties.index'));
        }

        $property->fill($request->all());
        $property->save();

        Flash::success('Property updated successfully.');

        return redirect(route('properties.index'));
    }

    /**
     * Remove the specified Property from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Property $property */
        $property = Property::find($id);

        if (empty($property)) {
            Flash::error('Property not found');

            return redirect(route('properties.index'));
        }

        $property->delete();

        Flash::success('Property deleted successfully.');

        return redirect(route('properties.index'));
    }
}
