<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\SubscribeTransaction;
use App\Models\CourseVideo;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrontController extends Controller
{
  public function index()
  {
    $categories = Category::take(7)->orderBy('id', 'asc')->get();

    $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('id')->get();

    return view('front.index', compact('categories', 'courses'));
  }

  public function details(Course $course)
  {
    return view('front.details', compact('course'));
  }

  public function learning(Course $course, $courseVideoId)
  {
    $user = Auth::user();
    $courseVideos = CourseVideo::where('course_id', $course->id)->get();
    $courseVideo = CourseVideo::where('id', $courseVideoId)->firstOrFail();


    if (!$user->hasActiveSubscription()) {
      return redirect()->route('front.pricing');
    }

    $completedVideos = $user->courseProgresses
                            ->where('course_id', $course->id)
                            ->where('completed', true)
                            ->pluck('course_video_id')
                            ->toArray();

    $allCompleted = count($completedVideos) == $courseVideos->count();

    $video = $course->course_videos->firstWhere('id', $courseVideoId);
    $category = $course->category->id;
    $user->courses()->syncWithoutDetaching($course->id);

    return view('front.learning', compact('course', 'video', 'courseVideos','courseVideo','completedVideos','allCompleted','category'));
  }

  public function categoryWithoutAuth(Category $category)
  {
    $coursesByCategory = $category->courses()->get();

    return view('front.categoryWithoutAuth.category', compact('coursesByCategory', 'category'));
  }

  public function category(Category $category)
  {
    $user = Auth::user();
    $coursesByCategory = $category->courses()->get();

    $completedCourses = $user->courseProgresses()
                            ->whereIn('course_id', $coursesByCategory->pluck('id'))
                            ->where('completed', true)
                            ->select('course_id')
                            ->groupBy('course_id')
                            ->havingRaw('COUNT(course_video_id) = (SELECT COUNT(*) FROM course_videos WHERE course_videos.course_id = course_progress.course_id)')
                            ->pluck('course_id')
                            ->toArray();

    return view('front.category', compact('coursesByCategory', 'category', 'completedCourses'));
  }

  public function pricing()
{
    if (Auth::check()) {
        if (Auth::user()->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }
    } else {
        return redirect()->route('login');
    }
    $user = Auth::user();
    $allPaket = Paket::with('keypointPakets')->get();
    $transaction = $user->transactions()->where('status', 'success')->first(); // Ambil transaksi yang tidak sukses


    return view('front.pricing',compact('allPaket','transaction'));
}


  public function checkout($slug)
  {
    $user = Auth::user();
    $paket = Paket::where('slug', $slug)->firstOrFail();
    $codeSwift = 'BERKEMAH' . Str::upper(Str::random(5));

    return view('front.checkout', compact('codeSwift','user','paket'));
  }

  public function checkout_store(StoreSubscribeTransactionRequest $request)
  {
    $user = Auth::user();

    if (Auth::user()->hasActiveSubscription()) {
      return redirect()->route('front.index');
    }

    DB::transaction(function () use ($request, $user) {
      $data = $request->validated();

      if ($request->hasFile('proof')) {
        $proofPath = $request->file('proof')->store('proofs', 'public');
        $data['proof'] = $proofPath;
      }

      $data['user_id'] = $user->id;
      $data['code_swift'] = $request->code_swift;
      $data['total_amount'] = 200000;
      $data['is_paid'] = false;

      $transaction = SubscribeTransaction::create($data);
    });

    return redirect()->route('front.index')->with('success', 'Transaction created successfully!');
  }
}
