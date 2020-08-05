<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Province;
use App\Models\Country;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProvinceController extends AppBaseController
{
    /**
     * Display a listing of the Province.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Province $provinces */
        $provinces = Province::all();

        return view('provinces.index')
            ->with('provinces', $provinces);
    }

    /**
     * Show the form for creating a new Province.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id');
        return view('provinces.create',compact('countries'));
    }

    /**
     * Store a newly created Province in storage.
     *
     * @param CreateProvinceRequest $request
     *
     * @return Response
     */
    public function store(CreateProvinceRequest $request)
    {
        $input = $request->all();

        /** @var Province $province */
        $province = Province::create($input);

        Flash::success('Province saved successfully.');

        return redirect(route('provinces.index'));
    }

    /**
     * Display the specified Province.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            Flash::error('Province not found');

            return redirect(route('provinces.index'));
        }

        return view('provinces.show')->with('province', $province);
    }

    /**
     * Show the form for editing the specified Province.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            Flash::error('Province not found');

            return redirect(route('provinces.index'));
        }

        return view('provinces.edit')->with('province', $province);
    }

    /**
     * Update the specified Province in storage.
     *
     * @param int $id
     * @param UpdateProvinceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProvinceRequest $request)
    {
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            Flash::error('Province not found');

            return redirect(route('provinces.index'));
        }

        $province->fill($request->all());
        $province->save();

        Flash::success('Province updated successfully.');

        return redirect(route('provinces.index'));
    }

    /**
     * Remove the specified Province from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Province $province */
        $province = Province::find($id);

        if (empty($province)) {
            Flash::error('Province not found');

            return redirect(route('provinces.index'));
        }

        $province->delete();

        Flash::success('Province deleted successfully.');

        return redirect(route('provinces.index'));
    }
}
