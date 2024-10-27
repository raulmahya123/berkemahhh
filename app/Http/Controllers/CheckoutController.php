<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request){
        $paketId = $request->input('paketId');
        $price = $request->input('price');
        $resi = 'TRX-' . time() . '-' . rand(1000, 9999);

        Transaction::where('user_id', Auth::id())->where('status', 'pending')->delete();

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'paket_id' => $paketId,
            'resi' => $resi,
            'price' => $price,
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->save();
        return redirect()->route('checkout', $transaction->id);
    }

    public function checkout(Transaction $transaction){
        $user = Auth::user();
        // $paket = Paket::where('slug', $slug)->firstOrFail();
        $paket = $transaction->paket;
        $transaction = $transaction;
        $codeSwift = 'BERKEMAH' . Str::upper(Str::random(5));

        return view('front.checkout', compact('codeSwift','user','paket','transaction'));
    }

    public function success(Transaction $transaction){
        $transaction->status = 'success';
        $transaction->save();
        return view('front.payment.success');
    }
}
