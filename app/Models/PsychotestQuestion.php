<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychotestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychotest_id',
        'question',
        'type',
    ];

    /**
     * Define a relationship with Psychotest.
     */
    public function psychotest()
    {
        return $this->belongsTo(Psychotest::class);
    }
    public function user()
{
    return $this->belongsTo(User::class); // Establishing a relationship with the User model
}
}
