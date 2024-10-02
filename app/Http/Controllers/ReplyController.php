<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function index($slug)
    {
        $comment = Comment::where('slug', $slug)->firstOrFail();
        return view('front.comment.reply.test-reply', compact('comment'));
    }

    public function fetchData($id){
        $comments = Comment::where('id',$id)->with('replies.user')->get();
        return response()->json([
            'comments' => $comments,
        ]);
    }

    public function store(Request $request, $slug)
    {
        $comment = Comment::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'body' => 'required'
        ]);
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['comment_id'] = $comment->id;
            $validated['slug'] = Str::slug($validated['body'] . '-' . time());
            Reply::create($validated);
            return response()->json([
                'msg' => "Comment has been sent"
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

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'body' => 'required',
            'comment_id' => 'required|exists:comments,id'
        ]);
        try {
            $reply = Reply::where('slug', $slug)->firstOrFail();
            $reply->update([
                'body' => $validated['body'],
                'comment_id' => $validated['comment_id'],
            ]);
            return response()->json([
                'msg' => "Reply has been edited"
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function destroy($slug)
    {
        try {
            $reply = Reply::where('slug', $slug);
            $reply->delete();
            return response()->json([
                'msg'=>'Comment has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg'=>$e->getMessage()]);
        }

    }
}
