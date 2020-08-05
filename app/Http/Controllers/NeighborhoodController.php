<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNeighborhoodRequest;
use App\Http\Requests\UpdateNeighborhoodRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Neighborhood;
use Illuminate\Support\Str;

use App\Models\Municipality;
use Illuminate\Http\Request;
use Flash;
use Response;

class NeighborhoodController extends AppBaseController
{
    /**
     * Display a listing of the Neighborhood.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Neighborhood $neighborhoods */
        $neighborhoods = Neighborhood::paginate(10);

        return view('neighborhoods.index')
            ->with('neighborhoods', $neighborhoods);
    }

    /**
     * Show the form for creating a new Neighborhood.
     *
     * @return Response
     */
    public function create()
    {
        $municipalities= Municipality::pluck('name','id');
        return view('neighborhoods.create', compact('municipalities'));
    }

    /**
     * Store a newly created Neighborhood in storage.
     *
     * @param CreateNeighborhoodRequest $request
     *
     * @return Response
     */
    public function store(CreateNeighborhoodRequest $request)
    {
        $input = $request->all();

        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::create($input);

        Flash::success('Neighborhood saved successfully.');

        return redirect(route('neighborhoods.index'));
    }

    /**
     * Display the specified Neighborhood.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            Flash::error('Neighborhood not found');

            return redirect(route('neighborhoods.index'));
        }

        return view('neighborhoods.show')->with('neighborhood', $neighborhood);
    }

    /**
     * Show the form for editing the specified Neighborhood.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            Flash::error('Neighborhood not found');

            return redirect(route('neighborhoods.index'));
        }

        return view('neighborhoods.edit')->with('neighborhood', $neighborhood);
    }

    /**
     * Update the specified Neighborhood in storage.
     *
     * @param int $id
     * @param UpdateNeighborhoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNeighborhoodRequest $request)
    {
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            Flash::error('Neighborhood not found');

            return redirect(route('neighborhoods.index'));
        }

        $neighborhood->fill($request->all());
        $neighborhood->save();

        Flash::success('Neighborhood updated successfully.');

        return redirect(route('neighborhoods.index'));
    }

    /**
     * Remove the specified Neighborhood from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::find($id);

        if (empty($neighborhood)) {
            Flash::error('Neighborhood not found');

            return redirect(route('neighborhoods.index'));
        }

        $neighborhood->delete();

        Flash::success('Neighborhood deleted successfully.');

        return redirect(route('neighborhoods.index'));
    }
}
