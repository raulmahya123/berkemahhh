<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($slug){
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('front.comment.test-comment', compact('course'));
    }

    public function fetchData($id){
        $courses = Course::where('id',$id)->with('comments.user')->get();
        return response()->json([
            'courses' => $courses
        ]);
    }

    public function store(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'title'=> 'required|max:255|string',
            'body' => 'required',
        ]);
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['course_id'] = $course->id;
            $validated['slug'] = Str::slug($validated['body']);
            Comment::create($validated);
            return response()->json([
                'msg' => "Comment has been sent"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function show($slug)
    {
        $comment = Comment::where('slug', $slug)->firstOrFail();
        return response()->json([
            'data' => $comment
        ]);
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title'=> 'required|max:255|string',
            'body' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);
        try {
            $comment = Comment::where('slug', $slug)->firstOrFail();
            $comment->update([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'course_id' => $validated['course_id'],
            ]);
            return response()->json([
                'msg' => "Comment has been edited"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function destroy($slug)
    {
        try {
            $comment = Comment::where('slug', $slug);
            $comment->delete();
            return response()->json([
                'msg'=>'Comment has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }


}
