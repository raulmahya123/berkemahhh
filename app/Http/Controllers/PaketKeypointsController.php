<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\PaketKeypoint;
use Illuminate\Http\Request;

class PaketKeypointsController extends Controller
{
    /**
     * Display a listing of the keypoints for a specific paket.
     */

     public function getAll()
     {
         // Mengambil semua data Paket beserta keypoints yang terkait
         $pakets = Paket::with('keypointPakets')->get();
         
         // Mengirimkan variabel $pakets ke view
         return view('admin.paket.paket_keypoint.index', compact('pakets'));
     }
     
     
    public function index(Paket $paket)
    {
        $keypoints = $paket->keypointPakets; // Mengambil semua keypoints terkait
        return view('admin.paket.paket_keypoint.index', compact('paket', 'keypoints'));
    }

    /**
     * Show the form for creating a new keypoint for a specific paket.
     */
    public function create(Paket $paket)
    {
        return view('admin.paket.paket_keypoint.create', compact('paket'));
    }

    /**
     * Store a newly created keypoint in storage.
     */
    public function store(Request $request, Paket $paket)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Menyimpan keypoint baru terkait dengan paket
        $paket->keypointPakets()->create($request->only('name'));
        return redirect()->route('admin.paket.paket_keypoint.index', $paket)->with('success', 'Keypoint created successfully.');
    }

    /**
     * Display the specified keypoint.
     */
    public function show(Paket $paket, PaketKeypoint $keypoint)
    {
        return view('admin.paket.paket_keypoint.show', compact('paket', 'keypoint'));
    }

    /**
     * Show the form for editing the specified keypoint.
     */
    public function edit(Paket $paket, PaketKeypoint $keypoint)
    {
        return view('admin.paket.paket_keypoint.edit', compact('paket', 'keypoint'));
    }

    /**
     * Update the specified keypoint in storage.
     */
    public function update(Request $request, Paket $paket, PaketKeypoint $keypoint)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $keypoint->update($request->only('name'));
        return redirect()->route('admin.paket.paket_keypoint.index', $paket)->with('success', 'Keypoint updated successfully.');
    }

    /**
     * Remove the specified keypoint from storage.
     */
    public function destroy(Paket $paket, PaketKeypoint $keypoint)
    {
        $keypoint->delete();
        return redirect()->route('admin.paket.paket_keypoint.index', $paket)->with('success', 'Keypoint deleted successfully.');
    }
}
