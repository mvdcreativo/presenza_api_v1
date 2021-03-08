<?php

namespace App\Http\Controllers\API;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VideoController
 * @package App\Http\Controllers\API
 */

class VideoAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $query = Video::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $videos = $query->get();

        return $this->sendResponse($videos->toArray(), 'Videos retrieved successfully');
    }



    public function store(Request $request)
    {
        $input = $request->all();

        /** @var Video $video */
        $video = Video::create($input);

        return $this->sendResponse($video->toArray(), 'Video saved successfully');
    }

    
    public function show($id)
    {
        /** @var Video $video */
        $video = Video::find($id);

        if (empty($video)) {
            return $this->sendError('Video not found');
        }

        return $this->sendResponse($video->toArray(), 'Video retrieved successfully');
    }

 
 
    public function update($id, Request $request)
    {
        /** @var Video $video */
        $video = Video::find($id);

        if (empty($video)) {
            return $this->sendError('Video not found');
        }

        $video->fill($request->all());
        $video->save();
        

        return $this->sendResponse($video->toArray(), 'Video updated successfully');
    }


    public function destroy($id)
    {
        /** @var Video $video */
        $video = Video::find($id);

        if (empty($video)) {
            return $this->sendError('Video not found');
        }

        $video->delete();

        return $this->sendSuccess('Video deleted successfully');
    }
}
