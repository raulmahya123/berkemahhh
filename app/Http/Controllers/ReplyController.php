<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Reply;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function index($slugCourse,$slugComment)
    {
        $course = Course::where('slug', $slugCourse)->firstOrFail();
        $comment = Comment::where('slug', $slugComment)->firstOrFail();
        return view('front.comment.reply.test-reply', compact('comment','course'));
    }

    public function fetchData($id){
        $comments = Comment::where('id',$id)->with('replies.user')->get();
        return response()->json([
            'comments' => $comments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required',
            'comment_id' => 'required'
        ]);
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['slug'] = Str::slug($validated['body'] . '-' . time());
            Reply::create($validated);
            return response()->json([
                'msg' => "Jawaban telah dikirim"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function show($slug)
    {
        $reply = Reply::where('slug', $slug)->firstOrFail();
        return response()->json([
            'data' => $reply
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'reply_id' => 'required',
            'body' => 'required'
        ]);
        try {
            $reply = Reply::where('id', $validated['reply_id'])->firstOrFail();
            $reply->update([
                'body' => $validated['body']
            ]);
            return response()->json([
                'msg' => "Balasan anda telah diperbarui"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $reply = Reply::where('id', $id);
            $reply->delete();
            return response()->json([
                'msg'=>'Comment has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }
}
