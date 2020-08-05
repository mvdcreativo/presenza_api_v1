<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountAPIRequest;
use App\Http\Requests\API\UpdateAccountAPIRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;

use Response;

/**
 * Class AccountController
 * @package App\Http\Controllers\API
 */

class AccountAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/accounts",
     *      summary="Get a listing of the Accounts.",
     *      tags={"Account"},
     *      description="Get all Accounts",
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
     *                  @SWG\Items(ref="#/definitions/Account")
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
        $query = Account::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $accounts = $query->get();

        return $this->sendResponse($accounts->toArray(), 'Accounts retrieved successfully');
    }

    /**
     * @param CreateAccountAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/accounts",
     *      summary="Store a newly created Account in storage",
     *      tags={"Account"},
     *      description="Store Account",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Account that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Account")
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
     *                  ref="#/definitions/Account"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var Account $account */
        $account = Account::create($input);

        if($request->file('image')){
            $img = $request->file('image');

            $path = Storage::disk('public')->put('images/accounts',  $img);

            $account->fill(['image' => asset('storage/'.$path)])->save();
            
        }

        return $this->sendResponse($account->toArray(), 'Account saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/accounts/{id}",
     *      summary="Display the specified Account",
     *      tags={"Account"},
     *      description="Get Account",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Account",
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
     *                  ref="#/definitions/Account"
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
        /** @var Account $account */
        $account = Account::whith('user')->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        return $this->sendResponse($account->toArray(), 'Account retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAccountAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/accounts/{id}",
     *      summary="Update the specified Account in storage",
     *      tags={"Account"},
     *      description="Update Account",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Account",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Account that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Account")
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
     *                  ref="#/definitions/Account"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAccountAPIRequest $request)
    {
        /** @var Account $account */
        $account = Account::find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $account->fill($request->all());
        $account->save();
        if($request->file('image')){
            $img = $request->file('image');

            $path = Storage::disk('public')->put('images/accounts',  $img);

            $account->fill(['image' => asset('storage/'.$path)])->save();
            
        }

        return $this->sendResponse($account->toArray(), 'Account updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/accounts/{id}",
     *      summary="Remove the specified Account from storage",
     *      tags={"Account"},
     *      description="Delete Account",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Account",
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
        /** @var Account $account */
        $account = Account::find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $account->delete();

        return $this->sendSuccess('Account deleted successfully');
    }
}
