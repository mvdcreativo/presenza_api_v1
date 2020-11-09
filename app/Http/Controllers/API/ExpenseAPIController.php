<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExpenseAPIRequest;
use App\Http\Requests\API\UpdateExpenseAPIRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\User;
use Response;

/**
 * Class ExpenseController
 * @package App\Http\Controllers\API
 */

class ExpenseAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }


        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        }
        
        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        }else{
            $filter = "";
        }
        if ($request->get('user_id')) {
            $user_id = $request->get('user_id');
        }else{
            $user_id = null;
        }

        $expenses = $query
        ->with('expenses_properties_user')
        ->filter($filter) 
        ->orderBy('id', $sort)
        ->paginate($per_page);

        

        return $this->sendResponse($expenses->toArray(), 'Expenses retrieved successfully');
    }


    public function store(CreateExpenseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Expense $expense */
        $expense = Expense::create($input);

        return $this->sendResponse($expense->toArray(), 'Expense saved successfully');
    }

    
    public function show($id)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            return $this->sendError('Expense not found');
        }

        return $this->sendResponse($expense->toArray(), 'Expense retrieved successfully');
    }

   
    public function update($id, UpdateExpenseAPIRequest $request)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            return $this->sendError('Expense not found');
        }

        $expense->fill($request->all());
        $expense->save();

        return $this->sendResponse($expense->toArray(), 'Expense updated successfully');
    }

    

    public function destroy($id)
    {
        /** @var Expense $expense */
        $expense = Expense::find($id);

        if (empty($expense)) {
            return $this->sendError('Expense not found');
        }

        $expense->delete();

        return $this->sendSuccess('Expense deleted successfully');
    }

}
