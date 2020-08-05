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
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/currencies",
     *      summary="Get a listing of the Currencies.",
     *      tags={"Currency"},
     *      description="Get all Currencies",
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
     *                  @SWG\Items(ref="#/definitions/Currency")
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

    /**
     * @param CreateCurrencyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/currencies",
     *      summary="Store a newly created Currency in storage",
     *      tags={"Currency"},
     *      description="Store Currency",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Currency that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Currency")
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
     *                  ref="#/definitions/Currency"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCurrencyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Currency $currency */
        $currency = Currency::create($input);

        return $this->sendResponse($currency->toArray(), 'Currency saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/currencies/{id}",
     *      summary="Display the specified Currency",
     *      tags={"Currency"},
     *      description="Get Currency",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Currency",
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
     *                  ref="#/definitions/Currency"
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
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        return $this->sendResponse($currency->toArray(), 'Currency retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCurrencyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/currencies/{id}",
     *      summary="Update the specified Currency in storage",
     *      tags={"Currency"},
     *      description="Update Currency",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Currency",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Currency that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Currency")
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
     *                  ref="#/definitions/Currency"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
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

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/currencies/{id}",
     *      summary="Remove the specified Currency from storage",
     *      tags={"Currency"},
     *      description="Delete Currency",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Currency",
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
        /** @var Currency $currency */
        $currency = Currency::find($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        $currency->delete();

        return $this->sendSuccess('Currency deleted successfully');
    }
}
