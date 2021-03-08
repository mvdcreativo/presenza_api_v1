<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransactionAPIRequest;
use App\Http\Requests\API\UpdateTransactionAPIRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransactionController
 * @package App\Http\Controllers\API
 */

class TransactionAPIController extends AppBaseController
{
   
    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        };

        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }


        $transactions = $query
        ->with('transactionType','currency','taxes','property','userCustomer','userOwner')
        ->filter($request->get('filter'))
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->sendResponse($transactions->toArray(), 'Transactions retrieved successfully');
    }

  
    public function store(CreateTransactionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction $transaction */
        $transaction = Transaction::create($input);

        return $this->sendResponse($transaction->toArray(), 'Transaction saved successfully');
    }

  
    public function show($id)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        return $this->sendResponse($transaction->toArray(), 'Transaction retrieved successfully');
    }



    public function update($id, UpdateTransactionAPIRequest $request)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->fill($request->all());
        $transaction->save();

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }


    
    public function destroy($id)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->delete();

        return $this->sendSuccess('Transaction deleted successfully');
    }
}
