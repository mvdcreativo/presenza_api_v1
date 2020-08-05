<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Expense;
use Illuminate\Http\Request;
use Flash;
use Response;

class ExpenseController extends AppBaseController
{
    /**
     * Display a listing of the Expense.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Expense $expenses */
        $expenses = Expense::paginate(10);

        return view('expenses.index')
            ->with('expenses', $expenses);
    }

    /**
     * Show the form for creating a new Expense.
     *
     * @return Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created Expense in storage.
     *
     * @param CreateExpenseRequest $request
     *
     * @return Response
     */
    public function store(CreateExpenseRequest $request)
    {
        $input = $request->all();

        /** @var Expense $expense */
        $expense = Expense::create($input);

        Flash::success('Expense saved successfully.');

        return redirect(route('expenses.index'));
    }

    /**
     * Display the specified Expense.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        return view('expenses.show')->with('expense', $expense);
    }

    /**
     * Show the form for editing the specified Expense.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        return view('expenses.edit')->with('expense', $expense);
    }

    /**
     * Update the specified Expense in storage.
     *
     * @param int $id
     * @param UpdateExpenseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpenseRequest $request)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        $expense->fill($request->all());
        $expense->save();

        Flash::success('Expense updated successfully.');

        return redirect(route('expenses.index'));
    }

    /**
     * Remove the specified Expense from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        $expense->delete();

        Flash::success('Expense deleted successfully.');

        return redirect(route('expenses.index'));
    }
}
