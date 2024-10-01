<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Comment;
use App\Models\CourseVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class CommentController extends Controller
{
    public function index($slug){
        $course = Course::where('slug', $slug)->firstOrFail();
        $courseVideos = CourseVideo::where('course_id', $course->id)->get();
        return view('front.comment.test-comment', compact('course','courseVideos'));
    }

    public function fetchData($id){
        $courses = Course::where('id',$id)->with(['comments.user', 'comments.coursevideo'])->get();
        return response()->json([
            'courses' => $courses,
        ]);
    }

    public function store(Request $request, $slug)
    {
        // Validasi input
        $request->validate([
            'body' => 'required|string',
            'course_video_id' => 'required|integer|exists:course_videos,id',
            'course_id' => 'required|integer|exists:courses,id', // Tambahkan validasi untuk course_id
        ]);

        // Ambil nilai mentions
        $mentions = explode(',', $request->mentions);

        // Simpan komentar
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'course_video_id' => $request->course_video_id,
            'body' => $request->body,
            'slug' => Str::slug(Str::random(10)),
            'course_id' => $request->course_id, // Pastikan course_id diisi
        ]);

        // Proses mentions jika perlu
        foreach ($mentions as $mention) {
            $mentionedUser = User::where('name', $mention)->first();
            if ($mentionedUser) {
                // Logika untuk menangani mention
            }
        }

        return response()->json(['msg' => 'Comment added successfully']);
    }


    /**
     * Process mentions in the comment body.
     *
     * @param string $body
     * @param int $commentId
     */
    private function processMentions($body, $commentId)
    {
        // Use regex to find mentions in the format @username
        preg_match_all('/@([a-zA-Z0-9_]+)/', $body, $matches);

        if (!empty($matches[1])) {
            // Loop through all matched usernames
            foreach ($matches[1] as $username) {
                // Find the user by username
                $mentionedUser = User::where('username', $username)->first();

                if ($mentionedUser) {
                    // Create a mention record in the mentions table
                    Mention::create([
                        'comment_id' => $commentId,
                        'mentioned_user_id' => $mentionedUser->id
                    ]);
                }
            }
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
            'body' => 'required',
            'course_video_id' => 'required',
            'course_id' => 'required|exists:courses,id'
        ]);
        try {
            $comment = Comment::where('slug', $slug)->firstOrFail();
            $comment->update([
                'course_video_id' => $validated['course_video_id'],
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

    public function fetchAll(): JsonResponse
{
    try {
        $users = User::all(); // Ambil semua data tanpa filter
        return response()->json($users);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500); // Tangkap error dan kirimkan
    }
}
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%$query%")
            ->take(5) // Limit the number of results
            ->get(['id', 'name']); // Only fetch required fields

        return response()->json($users);
    }

}
