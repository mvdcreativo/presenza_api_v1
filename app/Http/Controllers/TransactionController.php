<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Flash;
use Response;

class TransactionController extends AppBaseController
{
    /**
     * Display a listing of the Transaction.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Transaction $transactions */
        $transactions = Transaction::paginate(10);

        return view('transactions.index')
            ->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created Transaction in storage.
     *
     * @param CreateTransactionRequest $request
     *
     * @return Response
     */
    public function store(CreateTransactionRequest $request)
    {
        $input = $request->all();

        /** @var Transaction $transaction */
        $transaction = Transaction::create($input);

        Flash::success('Transaction saved successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified Transaction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        return view('transactions.show')->with('transaction', $transaction);
    }

    /**
     * Show the form for editing the specified Transaction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        return view('transactions.edit')->with('transaction', $transaction);
    }

    /**
     * Update the specified Transaction in storage.
     *
     * @param int $id
     * @param UpdateTransactionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransactionRequest $request)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        $transaction->fill($request->all());
        $transaction->save();

        Flash::success('Transaction updated successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified Transaction from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        $transaction->delete();

        Flash::success('Transaction deleted successfully.');

        return redirect(route('transactions.index'));
    }
}
