<?php

namespace App\Http\Controllers;

use App\Models\Psychotest;
use Illuminate\Http\Request;
use App\Models\PsychotestQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PsychotestResponse;
use App\Models\PsychotestResult;

class PsychotestController extends Controller
{
    // Method to show form for creating a new psychotest
    public function create()
    {
        return view('admin.psychotest.create'); // No parameters needed
    }

    // Method to show form for creating a question for a specific psychotest
    public function createQuestion($psychotestId)
    {
        return view('admin.psychotest.create', compact('psychotestId')); // Pass the psychotestId to the view
    }

    // Store a newly created psychotest question
    public function storeQuestion(Request $request, $psychotestId)
    {
        $request->validate([
            'question' => 'required|string|max:255', // Ensure question is filled
            'type' => 'required|in:frontend,backend,devops', // Ensure type is one of the allowed values
        ]);

        // Save the question to the database with associated psychotest_id
        PsychotestQuestion::create([
            'psychotest_id' => $psychotestId,
            'question' => $request->question,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.psychotest.index')->with('success', 'Pertanyaan berhasil ditambahkan untuk psikotes!');
    }
}

