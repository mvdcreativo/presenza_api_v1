<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaxRequest;
use App\Http\Requests\UpdateTaxRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Tax;
use Illuminate\Http\Request;
use Flash;
use Response;

class TaxController extends AppBaseController
{
    /**
     * Display a listing of the Tax.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Tax $taxes */
        $taxes = Tax::paginate(10);

        return view('taxes.index')
            ->with('taxes', $taxes);
    }

    /**
     * Show the form for creating a new Tax.
     *
     * @return Response
     */
    public function create()
    {
        return view('taxes.create');
    }

    /**
     * Store a newly created Tax in storage.
     *
     * @param CreateTaxRequest $request
     *
     * @return Response
     */
    public function store(CreateTaxRequest $request)
    {
        $input = $request->all();

        /** @var Tax $tax */
        $tax = Tax::create($input);

        Flash::success('Tax saved successfully.');

        return redirect(route('taxes.index'));
    }

    /**
     * Display the specified Tax.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tax $tax */
        $tax = Tax::find($id);

        if (empty($tax)) {
            Flash::error('Tax not found');

            return redirect(route('taxes.index'));
        }

        return view('taxes.show')->with('tax', $tax);
    }

    /**
     * Show the form for editing the specified Tax.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Tax $tax */
        $tax = Tax::find($id);

        if (empty($tax)) {
            Flash::error('Tax not found');

            return redirect(route('taxes.index'));
        }

        return view('taxes.edit')->with('tax', $tax);
    }

    /**
     * Update the specified Tax in storage.
     *
     * @param int $id
     * @param UpdateTaxRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaxRequest $request)
    {
        /** @var Tax $tax */
        $tax = Tax::find($id);

        if (empty($tax)) {
            Flash::error('Tax not found');

            return redirect(route('taxes.index'));
        }

        $tax->fill($request->all());
        $tax->save();

        Flash::success('Tax updated successfully.');

        return redirect(route('taxes.index'));
    }

    /**
     * Remove the specified Tax from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tax $tax */
        $tax = Tax::find($id);

        if (empty($tax)) {
            Flash::error('Tax not found');

            return redirect(route('taxes.index'));
        }

        $tax->delete();

        Flash::success('Tax deleted successfully.');

        return redirect(route('taxes.index'));
    }
}
