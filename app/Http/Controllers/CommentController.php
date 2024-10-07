<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Comment;
use App\Models\CourseVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($slug){
        $course = Course::where('slug', $slug)->firstOrFail();
        $courseVideos = CourseVideo::where('course_id', $course->id)->get();
        return view('front.comment.test-comment', compact('course','courseVideos'));
    }

    public function fetchData($id){
        $courses = Course::where('id', $id)->with(['comments' => function($query) { 
            $query->orderBy('created_at', 'desc');
        }, 'comments.user', 'comments.coursevideo', 'comments.course', 'teacher', 'comments.replies'])
        ->get();
        return response()->json([
            'courses' => $courses,
        ]);
    }

    public function store(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'course_video_id' => 'required',
            'body' => 'required'
        ]);
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['course_id'] = $course->id;
            $validated['slug'] = Str::slug($validated['body'] . '-' . time());
            Comment::create($validated);
            return response()->json([
                'msg' => "Komentar berhasil dibuat"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function show($id)
    {
        $comment = Comment::where('id', $id)->with('replies.user', 'user', 'coursevideo', 'course.teacher')->firstOrFail();
        return response()->json([
            'comment' => $comment
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required',
            'commentId' => 'required'
        ]);
        try {
            $comment = Comment::where('id', $validated['commentId'])->firstOrFail();
            $comment->update([
                'body' => $validated['body'],
            ]);
            return response()->json([
                'msg' => "Comment has been edited"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::where('id', $id);
            $comment->delete();
            return response()->json([
                'msg'=>'Comment has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }


}
