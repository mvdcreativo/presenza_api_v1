<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStatusAPIRequest;
use App\Http\Requests\API\UpdateStatusAPIRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StatusController
 * @package App\Http\Controllers\API
 */

class StatusAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/statuses",
     *      summary="Get a listing of the Statuses.",
     *      tags={"Status"},
     *      description="Get all Statuses",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Status")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $query = Status::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        if ($request->get('for_element')) {
            $elem =  explode(",",$request->get('for_element'));

            foreach ($elem as $value) {
                $query->orWhere('for', $value);
            }
        }        

        $statuses = $query->get();

        return $this->sendResponse($statuses->toArray(), 'Statuses retrieved successfully');
    }

    /**
     * @param CreateStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/statuses",
     *      summary="Store a newly created Status in storage",
     *      tags={"Status"},
     *      description="Store Status",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Status that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Status")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Status"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var Status $status */
        $status = Status::create($input);

        return $this->sendResponse($status->toArray(), 'Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/statuses/{id}",
     *      summary="Display the specified Status",
     *      tags={"Status"},
     *      description="Get Status",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Status",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Status"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            return $this->sendError('Status not found');
        }

        return $this->sendResponse($status->toArray(), 'Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/statuses/{id}",
     *      summary="Update the specified Status in storage",
     *      tags={"Status"},
     *      description="Update Status",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Status",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Status that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Status")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Status"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStatusAPIRequest $request)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            return $this->sendError('Status not found');
        }

        $status->fill($request->all());
        $status->save();

        return $this->sendResponse($status->toArray(), 'Status updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/statuses/{id}",
     *      summary="Remove the specified Status from storage",
     *      tags={"Status"},
     *      description="Delete Status",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Status",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Status $status */
        $status = Status::find($id);

        if (empty($status)) {
            return $this->sendError('Status not found');
        }

        $status->delete();

        return $this->sendSuccess('Status deleted successfully');
    }
}
