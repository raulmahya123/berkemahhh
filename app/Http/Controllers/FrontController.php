<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\SubscribeTransaction;
use App\Models\CourseVideo;
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

    $progress = $user->courseProgresses->where('course_video_id', $courseVideoId)->first();
    $isCompleted = $progress ? $progress->completed : false;

    $video = $course->course_videos->firstWhere('id', $courseVideoId);
    $user->courses()->syncWithoutDetaching($course->id);

    return view('front.learning', compact('course', 'video', 'courseVideos','courseVideo','isCompleted'));
  }

  public function category(Category $category)
  {
    $coursesByCategory = $category->courses()->get();

    return view('front.category', compact('coursesByCategory', 'category'));
  }

  public function pricing()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // If the user has an active subscription, redirect to the home page
        if (Auth::user()->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }
    } else {
        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }

    // If the user is authenticated but doesn't have an active subscription, show the pricing page
    return view('front.pricing');
}


  public function checkout()
  {
    $codeSwift = 'BERKEMAH' . Str::upper(Str::random(5));

    return view('front.checkout', compact('codeSwift'));
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
