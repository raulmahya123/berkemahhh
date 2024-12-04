<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Occupation;

class ProfileController extends Controller
{
    /**
     * Show the user's profile edit form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $occupations = Occupation::all(); // Ambil semua occupation dari database

        return view('profile.edit', [
            'user' => $user,
            'occupations' => $occupations, // Kirim occupations ke view
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    $user->fill($request->validated());

    // Jika ada perubahan pada email, set email_verified_at ke null
    if ($request->user()->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Simpan occupation_id dan phone
    $user->occupation_id = $request->input('occupation_id');
    $user->phone = $request->input('phone');

    // Ambil nama occupation berdasarkan occupation_id
   $occupation = Occupation::find($user->occupation_id);
   $user->occupation = $occupation ? $occupation->name : null; // Simpan nama occupation

    // Simpan perubahan
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'Profile updated successfully!');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
