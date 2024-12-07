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

  public function details($id,$courseSlug)
  {
    $category = Category::find($id);
    $course = Course::where('slug', $courseSlug)->first();
    // \Log::info('test ='.$course);
    return view('front.details', compact('category','course'));
  }

  public function learning($categoryId,Course $course, $courseVideoId)
  {
    $user = Auth::user();
    // $allPaket = Paket::with('keypointPakets')->get();
    $courseVideos = CourseVideo::where('course_id', $course->id)->get();
    $courseVideo = CourseVideo::where('id', $courseVideoId)->firstOrFail();


    if ($user->hasActiveSubscriptionPaket(8)) {
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
    }else if($user->hasActiveSubscriptionCourse($course->id)){
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
    }else if($user->hasActiveSubscriptionCategory($categoryId)){
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
    }else{
        dd(redirect()->route('front.pricing'));
    }
  }

  public function categoryWithoutAuth(Category $category)
  {
    $coursesByCategory = $category->courses()->get();

    return view('front.categoryWithoutAuth.category', compact('coursesByCategory', 'category'));
  }

  public function category(Category $category)
  {
    \Log::info('Category ID: ' . $category);
      $user = Auth::user();
      $coursesByCategory = $category->courses()->get();

      $courseProgresses = $user->courseProgresses()
          ->whereIn('course_id', $coursesByCategory->pluck('id'))
          ->get();

      $completedCourses = $user->courseProgresses()
          ->whereIn('course_id', $coursesByCategory->pluck('id'))
          ->where('completed', true)
          ->select('course_id')
          ->groupBy('course_id')
          ->havingRaw('COUNT(course_video_id) = (SELECT COUNT(*) FROM course_videos WHERE course_videos.course_id = course_progress.course_id)')
          ->pluck('course_id')
          ->toArray();

      $coursesWithProgress = $coursesByCategory->map(function ($course) use ($courseProgresses) {
          $totalVideos = $course->course_videos ? $course->course_videos->count() : 0;

          $completedVideos = $courseProgresses
              ->where('course_id', $course->id)
              ->where('completed', true)
              ->count();

          $progressPercentage = $totalVideos > 0
              ? round(($completedVideos / $totalVideos) * 100)
              : 0;

          return [
              'course' => $course,
              'progressPercentage' => $progressPercentage,
          ];
      });

      return view('front.category', compact('coursesWithProgress', 'coursesByCategory', 'category', 'completedCourses'));
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

}
