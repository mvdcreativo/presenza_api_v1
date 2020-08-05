<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMunicipalityRequest;
use App\Http\Requests\UpdateMunicipalityRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Str;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Flash;
use Response;

class MunicipalityController extends AppBaseController
{
    /**
     * Display a listing of the Municipality.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Municipality $municipalities */
        $municipalities = Municipality::paginate(10);

        return view('municipalities.index')
            ->with('municipalities', $municipalities);
    }

    /**
     * Show the form for creating a new Municipality.
     *
     * @return Response
     */
    public function create()
    {
        return view('municipalities.create');
    }

    /**
     * Store a newly created Municipality in storage.
     *
     * @param CreateMunicipalityRequest $request
     *
     * @return Response
     */
    public function store(CreateMunicipalityRequest $request)
    {
        $input = $request->all();

        /** @var Municipality $municipality */
        $input['slug'] = Str::slug($request->name);
        $municipality = Municipality::create($input);

        Flash::success('Municipality saved successfully.');

        return redirect(route('municipalities.index'));
    }

    /**
     * Display the specified Municipality.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            Flash::error('Municipality not found');

            return redirect(route('municipalities.index'));
        }

        return view('municipalities.show')->with('municipality', $municipality);
    }

    /**
     * Show the form for editing the specified Municipality.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            Flash::error('Municipality not found');

            return redirect(route('municipalities.index'));
        }

        return view('municipalities.edit')->with('municipality', $municipality);
    }

    /**
     * Update the specified Municipality in storage.
     *
     * @param int $id
     * @param UpdateMunicipalityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMunicipalityRequest $request)
    {
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            Flash::error('Municipality not found');

            return redirect(route('municipalities.index'));
        }

        $municipality->fill($request->all());
        $municipality->save();

        Flash::success('Municipality updated successfully.');

        return redirect(route('municipalities.index'));
    }

    /**
     * Remove the specified Municipality from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Municipality $municipality */
        $municipality = Municipality::find($id);

        if (empty($municipality)) {
            Flash::error('Municipality not found');

            return redirect(route('municipalities.index'));
        }

        $municipality->delete();

        Flash::success('Municipality deleted successfully.');

        return redirect(route('municipalities.index'));
    }
}
