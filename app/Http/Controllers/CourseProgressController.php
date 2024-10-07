<?php

namespace App\Http\Controllers;

use App\Models\CourseProgress;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseProgressController extends Controller
{
    public function fetchData($videoId){
        $courseVideo = CourseVideo::where('id', $videoId)->firstOrFail();
        return response()->json(
            [
                'courseVideo' => $courseVideo
            ]
        );
    }
    public function updateProgress(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'course_video_id' => 'required|exists:course_videos,id',
        ]);
        try {
            $progress = CourseProgress::create(
                [
                    'user_id' => Auth::user()->id,
                    'course_id' => $validated['course_id'],
                    'course_video_id' => $validated['course_video_id'],
                    'completed' => true,
                ]
            );

            return response()->json([
                'msg' => 'The course video has been watched',
            ]);
        } catch (\Exception $e) {

        }


    }
}
