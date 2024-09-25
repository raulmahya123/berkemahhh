<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\CourseKeypoint;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('test-comment', [
            'courses' => CourseKeypoint::with('comments.user')->get()
        ]);
    }

    public function fetchData()
    {
        $courses = CourseKeypoint::with('comments.user')->get();
        return response()->json([
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required',
            'course_keypoint_id' => 'required|exists:course_keypoints,id'
        ]);
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['course_keypoint_id'] = $validated['course_keypoint_id'];
            Comment::create($validated);
            return response()->json([
                'msg' => "Comment has been sent"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'data' => Comment::where('id', $comment->id)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'body' => 'required',
            'course_keypoint_id' => 'required|exists:course_keypoints,id'
        ]);
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['course_keypoint_id'] = $validated['course_keypoint_id'];
            Comment::where('id', $comment->id)->update($validated);
            return response()->json([
                'msg' => "Comment has been edited"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment = Comment::where('id', $comment->id);
            $comment->delete();
            return response()->json([
                'msg'=>'Comment has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }
}
