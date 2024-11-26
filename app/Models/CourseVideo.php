<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'path_video',
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get all of the courseProgresses for the CourseVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseProgresses(): HasMany
    {
        return $this->hasMany(CourseProgress::class);
    }


}
