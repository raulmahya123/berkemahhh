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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('occupation_id')->nullable()->constrained('occupations')->onDelete('set null'); // Menambahkan kolom occupation_id
            $table->string('phone')->nullable(); // Menambahkan kolom phone
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['occupation_id']); // Menghapus foreign key
            $table->dropColumn(['occupation_id', 'phone']); // Menghapus kolom occupation_id dan phone
        });
    }
};
