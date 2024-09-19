<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeTransactionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuizQuestionController;
use App\Models\CourseVideo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{course:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/quiz/{course:slug}', [QuizQuestionController::class, 'showByCourse'])->name('front.quiz');
Route::post('/quiz/{course:slug}/submit', [QuizQuestionController::class, 'submitQuiz'])->name('front.submit_quiz');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
// Route to handle certificate generation
// Route to handle certificate generation
// Route for generating a certificate
Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate'])->name('front.generate_certificate');

// Route for showing the certificate
Route::get('/certificates/{certificate_code}', [CertificateController::class, 'showCertificate'])->name('front.certificates.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [FrontController::class, 'checkout'])->name('front.checkout');

    Route::post('/checkout/store', [FrontController::class, 'checkout_store'])->name('front.checkout.store');

    Route::get('/learning/{course}/{courseVideoId}', [FrontController::class, 'learning'])->name('front.learning');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route to show the list of certificates
Route::get('certificates', [CertificateController::class, 'index'])->name('front.certificate.index');

// Route to show the form to create a new certificate
Route::get('certificates/create', [CertificateController::class, 'create'])->name('front.certificate.create');

// Route to store a newly created certificate
Route::post('certificates', [CertificateController::class, 'store'])->name('front.certificate.store');

// Route to show a specific certificate
Route::get('certificates/{certificate}', [CertificateController::class, 'show'])->name('front.certificate.show');

// Route to show the form to edit a specific certificate
Route::get('certificates/{certificate}/edit', [CertificateController::class, 'edit'])->name('front.certificate.edit');

// Route to update a specific certificate
Route::put('certificates/{certificate}', [CertificateController::class, 'update'])->name('front.certificate.update');
// routes/web.php

// Route to delete a specific certificate
Route::delete('certificates/{certificate}', [CertificateController::class, 'destroy'])->name('front.certificate.destroy');
    Route::prefix('admin')->name('admin.')->group(function () {
        // crud categories
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
        Route::resource('teachers', TeacherController::class)->middleware('role:owner');
        // crud courses
        Route::resource('courses', CourseController::class)->middleware('role:owner|teacher');

        Route::resource('subscribe_transactions', SubscribeTransactionController::class)->middleware('role:owner');

        Route::resource('quiz_questions', QuizQuestionController::class)->middleware('role:owner|teacher');

        Route::get('/add/video/{course:id}', [CourseVideoController::class, 'create'])->middleware('role:teacher|owner')->name('course.add_video');
        Route::post('/add/video/save/{course:id}', [CourseVideoController::class, 'store'])->middleware('role:teacher|owner')->name('course.add_video.save');
        Route::resource('course_videos', CourseVideoController::class)->middleware('role:owner|teacher');
    });
});

require __DIR__ . '/auth.php';
