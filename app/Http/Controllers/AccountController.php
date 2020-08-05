<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Account;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountController extends AppBaseController
{
    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Account $accounts */
        $accounts = Account::paginate(10);

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::pluck('name','id');
        return view('accounts.create',compact('users'));
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        /** @var Account $account */
        $account = Account::create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Account $account */
        $account = Account::find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.show')->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Account $account */
        $account = Account::find($id);
        /** @var Users $users */
        $users = User::pluck('name','id');


        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit',compact('users'))->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param int $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        /** @var Account $account */
        $account = Account::find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account->fill($request->all());
        $account->save();

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Account $account */
        $account = Account::find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account->delete();

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }
}
