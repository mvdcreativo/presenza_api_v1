<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaction_typeRequest;
use App\Http\Requests\UpdateTransaction_typeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Transaction_type;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Flash;
use Response;

class Transaction_typeController extends AppBaseController
{
    /**
     * Display a listing of the Transaction_type.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Transaction_type $transactionTypes */
        $transactionTypes = Transaction_type::paginate(10);

        return view('transaction_types.index')
            ->with('transactionTypes', $transactionTypes);
    }

    /**
     * Show the form for creating a new Transaction_type.
     *
     * @return Response
     */
    public function create()
    {
        return view('transaction_types.create');
    }

    /**
     * Store a newly created Transaction_type in storage.
     *
     * @param CreateTransaction_typeRequest $request
     *
     * @return Response
     */
    public function store(CreateTransaction_typeRequest $request)
    {
        $input = $request->all();

        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::create($input);

        Flash::success('Transaction Type saved successfully.');

        return redirect(route('transactionTypes.index'));
    }

    /**
     * Display the specified Transaction_type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('transactionTypes.index'));
        }

        return view('transaction_types.show')->with('transactionType', $transactionType);
    }

    /**
     * Show the form for editing the specified Transaction_type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('transactionTypes.index'));
        }

        return view('transaction_types.edit')->with('transactionType', $transactionType);
    }

    /**
     * Update the specified Transaction_type in storage.
     *
     * @param int $id
     * @param UpdateTransaction_typeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransaction_typeRequest $request)
    {
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('transactionTypes.index'));
        }

        $transactionType->fill($request->all());
        $transactionType->save();

        Flash::success('Transaction Type updated successfully.');

        return redirect(route('transactionTypes.index'));
    }

    /**
     * Remove the specified Transaction_type from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('transactionTypes.index'));
        }

        $transactionType->delete();

        Flash::success('Transaction Type deleted successfully.');

        return redirect(route('transactionTypes.index'));
    }
}
