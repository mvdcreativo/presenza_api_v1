<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Publication;
use Illuminate\Http\Request;
use Flash;
use Response;

class PublicationController extends AppBaseController
{
    /**
     * Display a listing of the Publication.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Publication $publications */
        $publications = Publication::paginate(10);

        return view('publications.index')
            ->with('publications', $publications);
    }

    /**
     * Show the form for creating a new Publication.
     *
     * @return Response
     */
    public function create()
    {
        return view('publications.create');
    }

    /**
     * Store a newly created Publication in storage.
     *
     * @param CreatePublicationRequest $request
     *
     * @return Response
     */
    public function store(CreatePublicationRequest $request)
    {
        $input = $request->all();

        /** @var Publication $publication */
        $publication = Publication::create($input);

        Flash::success('Publication saved successfully.');

        return redirect(route('publications.index'));
    }

    /**
     * Display the specified Publication.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Publication $publication */
        $publication = Publication::find($id);

        if (empty($publication)) {
            Flash::error('Publication not found');

            return redirect(route('publications.index'));
        }

        return view('publications.show')->with('publication', $publication);
    }

    /**
     * Show the form for editing the specified Publication.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Publication $publication */
        $publication = Publication::find($id);

        if (empty($publication)) {
            Flash::error('Publication not found');

            return redirect(route('publications.index'));
        }

        return view('publications.edit')->with('publication', $publication);
    }

    /**
     * Update the specified Publication in storage.
     *
     * @param int $id
     * @param UpdatePublicationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePublicationRequest $request)
    {
        /** @var Publication $publication */
        $publication = Publication::find($id);

        if (empty($publication)) {
            Flash::error('Publication not found');

            return redirect(route('publications.index'));
        }

        $publication->fill($request->all());
        $publication->save();

        Flash::success('Publication updated successfully.');

        return redirect(route('publications.index'));
    }

    /**
     * Remove the specified Publication from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Publication $publication */
        $publication = Publication::find($id);

        if (empty($publication)) {
            Flash::error('Publication not found');

            return redirect(route('publications.index'));
        }

        $publication->delete();

        Flash::success('Publication deleted successfully.');

        return redirect(route('publications.index'));
    }
}
