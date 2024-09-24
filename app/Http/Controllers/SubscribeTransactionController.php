<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\SubscribeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Coupon; // Sesuaikan namespace dengan struktur aplikasi Anda
use Illuminate\Support\Facades\Auth;

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

        // Check if the promo code exists in the database
        $coupon = Coupon::where('code', $promoCode)->first();

        if ($coupon) {
            // Find or create a subscription transaction for the user
            $subscribeTransaction = SubscribeTransaction::firstOrCreate(
                ['user_id' => Auth::id()],
                ['total_amount' => 0, 'is_paid' => false, 'proof' => 'No proof available'], // Provide a default proof message
            );

            // Update the subscription transaction
            $subscribeTransaction->is_paid = true;
            $subscribeTransaction->coupon_id = $coupon->id; // Store the applied coupon
            $subscribeTransaction->total_amount = 0;
            // proof
            $subscribeTransaction->proof = 'promo-code';
            $subscribeTransaction->save();

            return redirect()->back()->with('success', 'Promo code applied successfully! You are now a PRO member.');
        } else {
            return redirect()->back()->with('error', 'Invalid promo code.');
        }
    }
}
