<?php
namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    // List all quiz questions with pagination
    public function index()
    {
        $quizQuestions = QuizQuestion::with('course')->paginate(10); // Paginate results
        $courses = Course::all();
        $totalQuestions = $quizQuestions->total(); // Total number of questions

        return view('admin.quiz_questions.index', compact('quizQuestions', 'courses', 'totalQuestions'));
    }

    // Show the form for creating a new quiz question
    public function create()
    {
        $courses = Course::all();
        return view('admin.quiz_questions.create', compact('courses'));
    }

    // Store a newly created quiz question in the database
    public function store(Request $request)
    {
        $data = $request->all();

        // Validate data with custom messages
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'nullable|json',
            'questions.*.correct_answer' => 'required|string',
        ], [
            'course_id.required' => 'The course field is required.',
            'course_id.exists' => 'The selected course is invalid.',
            'questions.*.question.required' => 'The question field is required for each question.',
            'questions.*.correct_answer.required' => 'The correct answer field is required for each question.',
        ]);

        // Save each question
        foreach ($data['questions'] as $questionData) {
            QuizQuestion::create([
                'course_id' => $data['course_id'],
                'question' => $questionData['question'],
                'options' => $questionData['options'],
                'correct_answer' => $questionData['correct_answer'],
            ]);
        }

        return redirect()->route('admin.quiz_questions.index')->with('success', 'Questions created successfully.');
    }

    // Display the specified quiz question
    public function show(QuizQuestion $quizQuestion)
    {
        if (!$quizQuestion) {
            return redirect()->route('admin.quiz_questions.index')->with('error', 'Quiz question not found.');
        }

        return view('admin.quiz_questions.show', compact('quizQuestion'));
    }

    // Show the form for editing the specified quiz question
    public function edit(QuizQuestion $quizQuestion)
    {
        $courses = Course::all();
        return view('admin.quiz_questions.edit', compact('quizQuestion', 'courses'));
    }

    // Update the specified quiz question in the database
    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'question' => 'required',
            'options' => 'nullable|json',
            'correct_answer' => 'required',
        ], [
            'course_id.required' => 'The course field is required.',
            'course_id.exists' => 'The selected course is invalid.',
            'question.required' => 'The question field is required.',
            'correct_answer.required' => 'The correct answer field is required.',
        ]);

        $quizQuestion->update([
            'course_id' => $request->input('course_id'),
            'question' => $request->input('question'),
            'options' => $request->input('options'),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('admin.quiz_questions.index')->with('success', 'Question updated successfully.');
    }

    // Remove the specified quiz question from the database
    public function destroy(QuizQuestion $quizQuestion)
    {
        $quizQuestion->delete();
        return redirect()->route('admin.quiz_questions.index')->with('success', 'Question deleted successfully.');
    }
}
