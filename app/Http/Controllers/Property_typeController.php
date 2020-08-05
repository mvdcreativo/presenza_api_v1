<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProperty_typeRequest;
use App\Http\Requests\UpdateProperty_typeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Property_type;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Flash;
use Response;

class Property_typeController extends AppBaseController
{
    /**
     * Display a listing of the Property_type.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Property_type $propertyTypes */
        $propertyTypes = Property_type::paginate(10);

        return view('property_types.index')
            ->with('propertyTypes', $propertyTypes);
    }

    /**
     * Show the form for creating a new Property_type.
     *
     * @return Response
     */
    public function create()
    {
        return view('property_types.create');
    }

    /**
     * Store a newly created Property_type in storage.
     *
     * @param CreateProperty_typeRequest $request
     *
     * @return Response
     */
    public function store(CreateProperty_typeRequest $request)
    {
        $input = $request->all();

        /** @var Property_type $propertyType */
        $propertyType = Property_type::create($input);

        Flash::success('Property Type saved successfully.');

        return redirect(route('propertyTypes.index'));
    }

    /**
     * Display the specified Property_type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            Flash::error('Property Type not found');

            return redirect(route('propertyTypes.index'));
        }

        return view('property_types.show')->with('propertyType', $propertyType);
    }

    /**
     * Show the form for editing the specified Property_type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            Flash::error('Property Type not found');

            return redirect(route('propertyTypes.index'));
        }

        return view('property_types.edit')->with('propertyType', $propertyType);
    }

    /**
     * Update the specified Property_type in storage.
     *
     * @param int $id
     * @param UpdateProperty_typeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProperty_typeRequest $request)
    {
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            Flash::error('Property Type not found');

            return redirect(route('propertyTypes.index'));
        }

        $propertyType->fill($request->all());
        $propertyType->save();

        Flash::success('Property Type updated successfully.');

        return redirect(route('propertyTypes.index'));
    }

    /**
     * Remove the specified Property_type from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Property_type $propertyType */
        $propertyType = Property_type::find($id);

        if (empty($propertyType)) {
            Flash::error('Property Type not found');

            return redirect(route('propertyTypes.index'));
        }

        $propertyType->delete();

        Flash::success('Property Type deleted successfully.');

        return redirect(route('propertyTypes.index'));
    }
}
