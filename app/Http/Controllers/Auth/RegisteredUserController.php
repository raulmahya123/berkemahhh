<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request (Step 1).
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeStepOne(Request $request): RedirectResponse 
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'occupation' => ['nullable', 'string', 'max:255'], // Menambahkan validasi untuk occupation
        ]);
    
        // Simpan data ke sesi, termasuk occupation
        $request->session()->put('registration', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'occupation' => $request->occupation, // Simpan occupation
        ]);
    
        return redirect()->route('register.avatar');
    }

    /**
     * Register Step 2 (Simpan data occupation ke sesi).
     */
    public function registerStep1(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'occupation' => ['required', 'string', 'max:255'], // occupation wajib ada
            'password' => ['required', 'confirmed'],
        ]);

        // Simpan data ke sesi
        $data = $request->only('name', 'email', 'occupation', 'password');
        $request->session()->put('registration_data', $data);

        // Arahkan ke halaman berikutnya untuk avatar
        return redirect()->route('register.avatar');
    }

    /**
     * Menampilkan halaman avatar.
     */
    public function showAvatarForm()
    {
        if (!session('registration')) {
            return redirect()->route('register'); // Jika tidak ada sesi, kembali ke halaman awal
        }

        return view('auth.register-avatar');
    }

    /**
     * Menyelesaikan proses registrasi dan menyimpan data.
     */
    public function storeComplete(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Upload avatar
        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        // Ambil data registrasi dari sesi
        $registrationData = $request->session()->get('registration');

        // Simpan user ke database
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'],
            'occupation' => $registrationData['occupation'], // Menyimpan occupation
            'avatar' => $avatarPath,
        ]);

        // Hapus data sesi setelah selesai
        $request->session()->forget('registration');

        // Login user setelah berhasil registrasi
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
}
