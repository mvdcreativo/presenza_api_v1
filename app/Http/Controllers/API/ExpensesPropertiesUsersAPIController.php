<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\ExpensesPropertiesUsers;
use App\User;
use Illuminate\Http\Request;

class ExpensesPropertiesUsersAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ExpensesPropertiesUsers::query();

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


        $expenses = $query
        ->with('user','expense','property','currency')
        ->filter($filter) 
        ->orderBy('id', $sort)
        ->paginate($per_page);

        

        return $this->sendResponse($expenses->toArray(), 'Expenses retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense_properties_users = new ExpensesPropertiesUsers;

        $expense_properties_users->fill($request->all());
        
        $expense_properties_users->save();

        return $this->sendResponse($expense_properties_users->toArray(), 'Country created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                
        $expense_properties_users = ExpensesPropertiesUsers::find($id);

        if (empty($expense_properties_users)) {
            return $this->sendError('Country not found');
        }

        $expense_properties_users->fill($request->all());
        
        $expense_properties_users->save();

        return $this->sendResponse($expense_properties_users->toArray(), 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var ExpensesPropertiesUsers $expense */
        $expense = ExpensesPropertiesUsers::find($id);

        if (empty($expense)) {
            return $this->sendError('Expense not found');
        }

        $expense->delete();

        return $this->sendSuccess('Expense deleted successfully');
    }



    public function user_expenses_all($id, Request $request)
    {

        $query = User::find($id);
        if (empty($query)) {
            return $this->sendError('User not found');
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

        $expenses = $query
        ->expenses_properties_user()
        ->with('user','expense','property','currency')
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);
        

        return $this->sendResponse($expenses->toArray(), 'Expenses retrieved successfully');
    }
}
