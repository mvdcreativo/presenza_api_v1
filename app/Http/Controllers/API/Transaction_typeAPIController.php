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
  
    public function index(Request $request)
    {
        $query = Transaction_type::query();

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
        };

        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        $transactionTypes = $query
        // ->with()
        ->filter($request->get('filter'))
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->sendResponse($transactionTypes->toArray(), 'Transaction Types retrieved successfully');
    }

    

    public function store(CreateTransaction_typeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction_type $transactionType */
        $input['slug'] = Str::slug($request->name);
        $transactionType = Transaction_type::create($input);

        return $this->sendResponse($transactionType->toArray(), 'Transaction Type saved successfully');
    }

    public function show($id)
    {
        /** @var Transaction_type $transactionType */
        $transactionType = Transaction_type::find($id);

        if (empty($transactionType)) {
            return $this->sendError('Transaction Type not found');
        }

        return $this->sendResponse($transactionType->toArray(), 'Transaction Type retrieved successfully');
    }

    

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
