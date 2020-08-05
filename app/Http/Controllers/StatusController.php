<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Status;
use Illuminate\Http\Request;
use Flash;
use Response;

class StatusController extends AppBaseController
{
    /**
     * Display a listing of the Status.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Status $statuses */
        $statuses = Status::paginate(10);

        return view('statuses.index')
            ->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new Status.
     *
     * @return Response
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created Status in storage.
     *
     * @param CreateStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateStatusRequest $request)
    {
        $input = $request->all();

        /** @var Status $status */
        $status = Status::create($input);

        Flash::success('Status saved successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Display the specified Status.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        return view('statuses.show')->with('status', $status);
    }

    /**
     * Show the form for editing the specified Status.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        return view('statuses.edit')->with('status', $status);
    }

    /**
     * Update the specified Status in storage.
     *
     * @param int $id
     * @param UpdateStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStatusRequest $request)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        $status->fill($request->all());
        $status->save();

        Flash::success('Status updated successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Remove the specified Status from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        $status->delete();

        Flash::success('Status deleted successfully.');

        return redirect(route('statuses.index'));
    }
}
