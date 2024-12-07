<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\SubscribeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Coupon; // Sesuaikan namespace dengan struktur aplikasi Anda
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class SubscribeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SubscribeTransaction::with(['user'])
            ->orderByDesc('id')
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribeTransaction $subscribeTransaction)
    {
        return view('admin.transactions.show', compact('subscribeTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribeTransaction $subscribeTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribeTransaction $subscribeTransaction)
    {
        $subscribeTransaction->update([
            'is_paid' => true,
            'subscription_start_date' => Carbon::now(),
        ]);

        Alert::success('Success', 'Transaction ' . $subscribeTransaction->user->name . ' has been approved!');

        return redirect()->route('admin.subscribe_transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        //
    }
    // Menampilkan daftar kupon
    public function indexCoupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    // Menampilkan form untuk membuat kupon baru
    public function showCreateCouponForm()
    {
        return view('admin.coupon.create'); // Form create coupon
    }

    // Menyimpan kupon baru ke dalam database
    public function createCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons',
        ]);

        Coupon::create([
            'code' => $request->code,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
    }

    // Menampilkan detail kupon
    public function showCoupon(Coupon $coupon)
    {
        return view('admin.coupon.show', compact('coupon'));
    }

    // Menampilkan form untuk mengedit kupon
    public function editCoupon(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }

    // Mengupdate kupon di database
    public function updateCoupon(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
        ]);

        $coupon->update([
            'code' => $request->code,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }

    // Menghapus kupon
    public function destroyCoupon(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }

    public function applyPromoCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $promoCode = $request->input('code');
        $categorySlug = $request->input('category_slug');
        $category = Category::where('slug', $categorySlug)->first();
        $courseSlug = $request->input('course_slug');
        $course = Course::where('slug', $courseSlug)->first();

        // Check if the promo code exists in the database
        $couponCourse = Coupon::where('code', $promoCode)->where('course_id', $course->id)->first();
        $couponCategory = Coupon::where('code', $promoCode)->where('category_id', $category->id)->first();

        if ($couponCourse) {
            // Find or create a subscription transaction for the user
            $subscribeTransaction = SubscribeTransaction::Create(
                ['user_id' => Auth::user()->id],
                ['type'=>'course','category_id'=>null,'course_id'=>null,'total_amount' => 0, 'is_paid' => false, 'proof' => 'No proof available'], // Provide a default proof message
            );

            // Update the subscription transaction
            $subscribeTransaction->is_paid = true;
            $subscribeTransaction->type = "course";
            $subscribeTransaction->coupon_id = $couponCourse->id; // Store the applied coupon
            $subscribeTransaction->total_amount = 0;
            $subscribeTransaction->course_id = $couponCourse->course->id;
            // proof
            $subscribeTransaction->proof = 'promo-code';
            $subscribeTransaction->save();

            return redirect()->back()->with('success', 'Promo code applied successfully! You are now a PRO member. course');
        } elseif($couponCategory) {
            // Find or create a subscription transaction for the user
            $subscribeTransaction = SubscribeTransaction::Create(
                ['user_id' => Auth::user()->id],
                ['type'=>'category','category_id'=>null,'course_id'=>null,'total_amount' => 0, 'is_paid' => false, 'proof' => 'No proof available'], // Provide a default proof message
            );

            // Update the subscription transaction
            $subscribeTransaction->is_paid = true;
            $subscribeTransaction->type = "category";
            $subscribeTransaction->coupon_id = $couponCategory->id; // Store the applied coupon
            $subscribeTransaction->total_amount = 0;
            $subscribeTransaction->category_id = $couponCategory->category->id;
            // proof
            $subscribeTransaction->proof = 'promo-code';
            $subscribeTransaction->save();

            return redirect()->back()->with('success', 'Promo code applied successfully! You are now a PRO member. category');
        }else{
            return redirect()->back()->with('error', 'Invalid promo code.');
        }


    }
}
