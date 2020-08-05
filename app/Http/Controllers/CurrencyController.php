<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Currency;
use Illuminate\Http\Request;
use Flash;
use Response;

class CurrencyController extends AppBaseController
{
    /**
     * Display a listing of the Currency.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Currency $currencies */
        $currencies = Currency::all();

        return view('currencies.index')
            ->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new Currency.
     *
     * @return Response
     */
    public function create()
    {
        return view('currencies.create');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param CreateCurrencyRequest $request
     *
     * @return Response
     */
    public function store(CreateCurrencyRequest $request)
    {
        $input = $request->all();

        /** @var Currency $currency */
        $currency = Currency::create($input);

        Flash::success('Currency saved successfully.');

        return redirect(route('currencies.index'));
    }

    /**
     * Display the specified Currency.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        return view('currencies.show')->with('currency', $currency);
    }

    /**
     * Show the form for editing the specified Currency.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        return view('currencies.edit')->with('currency', $currency);
    }

    /**
     * Update the specified Currency in storage.
     *
     * @param int $id
     * @param UpdateCurrencyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurrencyRequest $request)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        $currency->fill($request->all());
        $currency->save();

        Flash::success('Currency updated successfully.');

        return redirect(route('currencies.index'));
    }

    /**
     * Remove the specified Currency from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        $currency->delete();

        Flash::success('Currency deleted successfully.');

        return redirect(route('currencies.index'));
    }
}
