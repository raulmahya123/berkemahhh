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
        Schema::table('subscribe_transactions', function (Blueprint $table) {
            $table->enum('type', ['course', 'category', "paket"])->after('id');
            $table->foreignId('category_id')->nullable()->after('type')->constrained('categories')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->after('category_id')->constrained('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscribe_transactions', function (Blueprint $table) {
            //
        });
    }
};
