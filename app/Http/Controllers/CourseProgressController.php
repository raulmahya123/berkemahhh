<?php

namespace App\Http\Controllers;

use App\Models\CourseProgress;
use Illuminate\Http\Request;

class CourseProgressController extends Controller
{
    public function updateProgress(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'video_id' => 'required|exists:videos,id',
        ]);

        // Menyimpan atau memperbarui progres
        $progress = CourseProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id' => $validated['course_id'],
                'video_id' => $validated['video_id']
            ],
            [
                'completed' => true,
            ]
        );

        return response()->json([
            'message' => 'Progress updated',
            'progress' => $progress
        ]);
    }
}
