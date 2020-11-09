<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCurrencyAPIRequest;
use App\Http\Requests\API\UpdateCurrencyAPIRequest;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CurrencyController
 * @package App\Http\Controllers\API
 */

class CurrencyAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $query = Currency::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $currencies = $query->get();

        return $this->sendResponse($currencies->toArray(), 'Currencies retrieved successfully');
    }

    public function store(CreateCurrencyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Currency $currency */
        $currency = Currency::create($input);

        return $this->sendResponse($currency->toArray(), 'Currency saved successfully');
    }


    public function show($id)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        return $this->sendResponse($currency->toArray(), 'Currency retrieved successfully');
    }


    public function update($id, UpdateCurrencyAPIRequest $request)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        $currency->fill($request->all());
        $currency->save();

        return $this->sendResponse($currency->toArray(), 'Currency updated successfully');
    }

    public function destroy($id)
    {
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        $currency->delete();

        return $this->sendSuccess('Currency deleted successfully');
    }
}
