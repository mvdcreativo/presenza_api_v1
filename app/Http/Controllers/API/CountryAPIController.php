<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCountryAPIRequest;
use App\Http\Requests\API\UpdateCountryAPIRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CountryController
 * @package App\Http\Controllers\API
 */

class CountryAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $query = Country::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $countries = $query->with('provinces')->get();

        return $this->sendResponse($countries->toArray(), 'Countries retrieved successfully');
    }


    public function store(CreateCountryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Country $country */
        $input['slug'] = Str::slug($request->name);
        $country = Country::create($input);

        return $this->sendResponse($country->toArray(), 'Country saved successfully');
    }

    
    public function show($id)
    {
        /** @var Country $country */
        $country = Country::find($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        return $this->sendResponse($country->toArray(), 'Country retrieved successfully');
    }

  
    public function update($id, UpdateCountryAPIRequest $request)
    {
        /** @var Country $country */
        $country = Country::find($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        $country->fill($request->all());
        $country->slug = Str::slug($request->name);
        $country->save();

        return $this->sendResponse($country->toArray(), 'Country updated successfully');
    }

  
    public function destroy($id)
    {
        /** @var Country $country */
        $country = Country::find($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        $country->delete();

        return $this->sendSuccess('Country deleted successfully');
    }
}
