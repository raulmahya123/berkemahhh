<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the quiz_questions table if it does not exist
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Foreign key to the courses table
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->text('question');
            $table->json('options')->nullable(); // JSON column for options
            $table->string('correct_answer');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the quiz_questions table
        Schema::dropIfExists('quiz_questions');
    }
};
