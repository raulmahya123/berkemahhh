<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychotestQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('psychotest_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psychotest_id')->constrained()->onDelete('cascade');
            $table->string('question'); // Store the question
            $table->enum('type', ['frontend', 'backend', 'devops']); // Type of the question
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('psychotest_questions');
    }
}
