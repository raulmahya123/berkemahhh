<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with('keypointPakets')->get();
        return view('admin.paket.pakets.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.pakets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'slug' => 'required|unique:pakets,slug',
            'price' => 'required|integer'
        ]);

        Paket::create($request->all());
        return redirect()->route('admin.paket.pakets.index')->with('success', 'Paket created successfully.');
    }

    public function show(Paket $paket)
    {
        return view('admin.paket.pakets.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        return view('admin.paket.pakets.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'slug' => 'required|unique:pakets,slug,' . $paket->id,
            'price' => 'required|integer'
        ]);

        $paket->update($request->all());
        return redirect()->route('admin.paket.pakets.index')->with('success', 'Paket updated successfully.');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.pakets.index')->with('success', 'Paket deleted successfully.');
    }
}
