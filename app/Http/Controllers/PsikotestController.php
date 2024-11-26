<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PsikotestController extends Controller
{
    public function index(){
        $questions = Question::with('answers')->get();
        return view('front.psikotest.questions', compact('questions'));
    }

    public function submitAnswer(Request $request)
    {
        $result = [
            'frontend' => 0,
            'backend' => 0,
            'fullstack' => 0,
        ];

        foreach ($request->answers as $questionId => $answerId) {
            $answer = Answer::find($answerId);

            // Hitung hasil
            $result[$answer->category]++;

            // Simpan jawaban pengguna
            UserAnswer::create([
                'user_id' => auth()->user()->id, // pastikan user sudah login
                'question_id' => $questionId,
                'answer_id' => $answerId,
            ]);
        }

        // Tentukan hasil akhir berdasarkan jawaban terbanyak
        $max = max($result);
        $recommended = array_search($max, $result);

        return response()->json([
            'recomended' => $recommended
        ]);
    }

    public function fetchPsikotest($categoryId){
        $user = Auth::user();
        $category = Category::where('id', $categoryId)->firstOrFail();
        $coursesByCategory = $category->courses()->get();


        $completedCourses = $user->courseProgresses()
                                ->whereIn('course_id', $coursesByCategory->pluck('id'))
                                ->where('completed', true)
                                ->select('course_id')
                                ->groupBy('course_id')
                                ->havingRaw('COUNT(course_video_id) = (SELECT COUNT(*) FROM course_videos WHERE course_videos.course_id = course_progress.course_id)')
                                ->pluck('course_id')
                                ->toArray();

        $allCompleted = count($completedCourses) === $coursesByCategory->count();
        return response()->json([
            "allCompleted"=>$allCompleted
        ]);
    }
}
