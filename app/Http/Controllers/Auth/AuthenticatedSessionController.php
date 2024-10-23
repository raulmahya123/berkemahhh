<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
// user cek role
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user
        $request->authenticate();

        // Regenerate session for security
        $request->session()->regenerate();

        // Check user occupation
        $user = $request->user();
        if ($user->occupation === 'Educator') {
            // Redirect to dashboard if the user's occupation is Educator
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Redirect to front.index for other users
        return redirect()->intended(route('front.index', absolute: false));
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword(){
        return view('auth.forgot-password');
    }
    public function forgot(Request $request){
        $request->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $request->email)->get();
        foreach ($user as $value) {
            # code...
        }
        if (count($user)>0) {
            $token = Str::random(40);
            $domain = URL::to('/');
            $url = $domain.'/reset/password?token='.$token;

            $data['url'] = $url;
            $data['email'] = $request->email;
            $data['title'] = 'Password Reset';
            $data['body'] = 'Please click the link below to reset your password';

            \Mail::send('auth.forgotPasswordMail',['data'=>$data], function($message) use ($data){
                $message->to($data['email'])->subject($data['title']);
            });

            $passwordReset = new PasswordReset;
            $passwordReset->email = $request->email;
            $passwordReset->token = $token;
            $passwordReset->user_id = $value->id;
            $passwordReset->save();

            return back()->with('success', 'Please check your mail inbox to reset your password');
        }else{
            return redirect('/forgot/password')->with('error','email does not exist!');
        }

    }

    public function loadResetPassword(Request $request){
        $resetData = PasswordReset::where('token',$request->token)->get();
        if(isset($request->token) && count($resetData) > 0){
            $user = User::where('id',$resetData[0]['user_id'])->get();
            foreach ($user as $user_data) {
                # code...
            }
            return view('auth.resetPassword',compact('user_data'));
        }else{
            return view('404');
        }
    }
    public function resetPassword(Request $request){
        $request->validate([
            'password' => 'required|confirmed'
        ]);
        try {
            $user = User::find($request->user_id);
            $user->password = Hash::make($request->password);
            $user->save();

            // delete reset token
            PasswordReset::where('email',$request->user_email)->delete();

            return redirect('/login')->with('success','Password Changed Successfully');
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }


}
