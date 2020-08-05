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
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/countries",
     *      summary="Get a listing of the Countries.",
     *      tags={"Country"},
     *      description="Get all Countries",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Country")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
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

    /**
     * @param CreateCountryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/countries",
     *      summary="Store a newly created Country in storage",
     *      tags={"Country"},
     *      description="Store Country",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Country that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Country")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Country"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCountryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Country $country */
        $input['slug'] = Str::slug($request->name);
        $country = Country::create($input);

        return $this->sendResponse($country->toArray(), 'Country saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/countries/{id}",
     *      summary="Display the specified Country",
     *      tags={"Country"},
     *      description="Get Country",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Country",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Country"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Country $country */
        $country = Country::find($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        return $this->sendResponse($country->toArray(), 'Country retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCountryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/countries/{id}",
     *      summary="Update the specified Country in storage",
     *      tags={"Country"},
     *      description="Update Country",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Country",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Country that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Country")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Country"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
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

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/countries/{id}",
     *      summary="Remove the specified Country from storage",
     *      tags={"Country"},
     *      description="Delete Country",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Country",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
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
