<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransaction_typeAPIRequest;
use App\Http\Requests\API\UpdateTransaction_typeAPIRequest;
use App\Models\Transaction_type;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Transaction_typeController
 * @package App\Http\Controllers\API
 */

class Transaction_typeAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactionTypes",
     *      summary="Get a listing of the Transaction_types.",
     *      tags={"Transaction_type"},
     *      description="Get all Transaction_types",
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
     *                  @SWG\Items(ref="#/definitions/Transaction_type")
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
        $query = Transaction_type::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $transactionTypes = $query->get();

        return $this->sendResponse($transactionTypes->toArray(), 'Transaction Types retrieved successfully');
    }

    /**
     * @param CreateTransaction_typeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transactionTypes",
     *      summary="Store a newly created Transaction_type in storage",
     *      tags={"Transaction_type"},
     *      description="Store Transaction_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Transaction_type that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transaction_type")
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
     *                  ref="#/definitions/Transaction_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransaction_typeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction_type $transactionType */
        $input['slug'] = Str::slug($request->name);
        $transactionType = Transaction_type::create($input);

        return $this->sendResponse($transactionType->toArray(), 'Transaction Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactionTypes/{id}",
     *      summary="Display the specified Transaction_type",
     *      tags={"Transaction_type"},
     *      description="Get Transaction_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction_type",
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
     *                  ref="#/definitions/Transaction_type"
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
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            return $this->sendError('Transaction Type not found');
        }

        return $this->sendResponse($transactionType->toArray(), 'Transaction Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransaction_typeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transactionTypes/{id}",
     *      summary="Update the specified Transaction_type in storage",
     *      tags={"Transaction_type"},
     *      description="Update Transaction_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction_type",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Transaction_type that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transaction_type")
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
     *                  ref="#/definitions/Transaction_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransaction_typeAPIRequest $request)
    {
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            return $this->sendError('Transaction Type not found');
        }

        $transactionType->fill($request->all());
        $transactionType->slug = Str::slug($request->name);
        $transactionType->save();

        return $this->sendResponse($transactionType->toArray(), 'Transaction_type updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/transactionTypes/{id}",
     *      summary="Remove the specified Transaction_type from storage",
     *      tags={"Transaction_type"},
     *      description="Delete Transaction_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction_type",
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
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            return $this->sendError('Transaction Type not found');
        }

        $transactionType->delete();

        return $this->sendSuccess('Transaction Type deleted successfully');
    }
}
