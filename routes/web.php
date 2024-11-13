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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseProgressController;
use App\Http\Controllers\PsikotestController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\PaketController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{course:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/quiz/{course:slug}', [QuizQuestionController::class, 'showByCourse'])->name('front.quiz');
Route::post('/quiz/{course:slug}/submit', [QuizQuestionController::class, 'submitQuiz'])->name('front.submit_quiz');
Route::get('/psikotest', [PsikotestController::class, 'index']);
Route::get('/psikotest/submit', [PsikotestController::class, 'submitAnswer']);
Route::get('/fetchPsikotest/{categoryId}', [PsikotestController::class, 'fetchPsikotest']);
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate'])->name('front.generate_certificate');
Route::get('/certificates/{certificate_code}', [CertificateController::class, 'showCertificate'])->name('front.certificates.show');
Route::get('/certificates/{certificate_code}/preview', [CertificateController::class, 'eweCertificate'])->name('front.certificates.ewe');
Route::get('/certificates/{certificate_code}/download', [CertificateController::class, 'downloadCertificate'])->name('front.certificates.download');
// New route for submitting promo codes
Route::post('/coupons/promo-code', [SubscribeTransactionController::class, 'applyPromoCode'])->name('coupon.promo.apply');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index'); // List user profiles
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit profile form
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete profile
    Route::get('/certificatesbyuser', [CertificateController::class, 'indexCertificateUser'])->name('front.certificate.index_by_user');
    Route::get('/certificates/{id}', [CertificateController::class, 'showCertificateUser'])->name('front.certificates.showw');
    Route::post('/checkout', [CheckoutController::class, 'process']);
    Route::get('/checkout/{transaction}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success/{transaction}', [CheckoutController::class, 'success'])->name('checkout.success');


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
    Route::post('/transactions/{id}/apply-coupon', [SubscribeTransactionController::class, 'applyCoupon']);

    // Route to delete a specific certificate
    Route::delete('certificates/{certificate}', [CertificateController::class, 'destroy'])->name('front.certificate.destroy');

    Route::get('comments/{slugCourse}/replies/{slugComment}', [ReplyController::class, 'index']);
    Route::get('/checklisProgress/fetchData/{id}', [CourseProgressController::class, 'fetchData']);
    Route::get('/showCertificate/{courseId}', [CourseProgressController::class,'fetchButton']);
    Route::post('/course-progress', [CourseProgressController::class, 'updateProgress']);
    Route::prefix('replies')->group(function () {
        Route::get('/fetchData/{id}', [ReplyController::class, 'fetchData']);
        Route::post('/', [ReplyController::class, 'store']);
        Route::get('/show/{slug}', [ReplyController::class, 'show']);
        Route::put('/update', [ReplyController::class, 'update']);
        Route::delete('/delete/{id}', [ReplyController::class, 'destroy']);
    });
    Route::prefix('comments')->group(function () {
        Route::get('/fetchData/{id}', [CommentController::class, 'fetchData']);
        Route::get('/{slug}', [CommentController::class, 'index']);
        Route::post('/{slug}', [CommentController::class, 'store']);
        Route::get('/show/{id}', [CommentController::class, 'show']);
        Route::put('/update', [CommentController::class, 'update']);
        Route::delete('/delete/{id}', [CommentController::class, 'destroy']);
    });


    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/coupons', [SubscribeTransactionController::class, 'indexCoupon'])->name('coupons.index');
            Route::get('/coupons/create', [SubscribeTransactionController::class, 'showCreateCouponForm'])->name('coupon.create');
            Route::post('/coupons', [SubscribeTransactionController::class, 'createCoupon'])->name('coupon.store');
            Route::get('/coupons/{coupon}', [SubscribeTransactionController::class, 'showCoupon'])->name('coupon.show');
            Route::get('/coupons/{coupon}/edit', [SubscribeTransactionController::class, 'editCoupon'])->name('coupon.edit');
            Route::put('/coupons/{coupon}', [SubscribeTransactionController::class, 'updateCoupon'])->name('coupon.update');
            Route::delete('/coupons/{coupon}', [SubscribeTransactionController::class, 'destroyCoupon'])->name('coupon.destroy');
            Route::resource('categories', CategoryController::class)->middleware('role:owner');
            Route::resource('teachers', TeacherController::class)->middleware('role:owner');
            // crud courses

            // paket

            // Menampilkan daftar paket
    Route::get('paket', [PaketController::class, 'index'])->name('paket.pakets.index');
    
    // Menampilkan form pembuatan paket baru
    Route::get('paket/create', [PaketController::class, 'create'])->name('paket.pakets.create');
    
    // Menyimpan paket baru
    Route::post('paket', [PaketController::class, 'store'])->name('paket.pakets.store');
    
    // Menampilkan detail paket tertentu
    Route::get('paket/{paket}', [PaketController::class, 'show'])->name('paket.pakets.show');
    
    // Menampilkan form edit paket
    Route::get('paket/{paket}/edit', [PaketController::class, 'edit'])->name('paket.pakets.edit');
    
    // Memperbarui data paket
    Route::put('paket/{paket}', [PaketController::class, 'update'])->name('paket.pakets.update');
    
    // Menghapus paket
    Route::delete('paket/{paket}', [PaketController::class, 'destroy'])->name('paket.pakets.destroy');

            Route::resource('courses', CourseController::class)->middleware('role:owner|teacher');

            Route::resource('subscribe_transactions', SubscribeTransactionController::class)->middleware('role:owner');

            Route::resource('quiz_questions', QuizQuestionController::class)->middleware('role:owner|teacher');

            Route::get('/add/video/{course:id}', [CourseVideoController::class, 'create'])
                ->middleware('role:teacher|owner')
                ->name('course.add_video');
            Route::post('/add/video/save/{course:id}', [CourseVideoController::class, 'store'])
                ->middleware('role:teacher|owner')
                ->name('course.add_video.save');
            Route::resource('course_videos', CourseVideoController::class)->middleware('role:owner|teacher');
        });
});

require __DIR__ . '/auth.php';
