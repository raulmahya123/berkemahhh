<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychotest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'responses',
        'score',
    ];

    /**
     * Define a one-to-many relationship with PsychotestQuestion.
     */
    public function questions()
    {
        return $this->hasMany(PsychotestQuestion::class);
    }

    /**
     * Define a relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
