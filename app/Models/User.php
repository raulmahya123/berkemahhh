<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'occupation',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_students');
    }

    public function subscribe_transactions()
    {
        return $this->hasMany(SubscribeTransaction::class);
    }

    public function hasActiveSubscriptionCategory($category_id)
    {
        $latestSubscription = $this->subscribe_transactions()->where('is_paid', true)->where('category_id', $category_id)
            ->latest('updated_at')->first();

        if (!$latestSubscription) {
            return false;
        }

        $subscriptionEndDate = Carbon::parse($latestSubscription->subscription_start_date)->addMonths(1);
        return Carbon::now()->lessThanOrEqualTo($subscriptionEndDate); // true dia berlangganan
    }
    public function hasActiveSubscriptionCourse($course_id)
    {
        $latestSubscription = $this->subscribe_transactions()->where('is_paid', true)->where('course_id', $course_id)
            ->latest('updated_at')->first();

        if (!$latestSubscription) {
            return false;
        }

        $subscriptionEndDate = Carbon::parse($latestSubscription->subscription_start_date)->addMonths(1);
        return Carbon::now()->lessThanOrEqualTo($subscriptionEndDate); // true dia berlangganan
    }
    public function hasActiveSubscriptionPaket($paket_id)
    {
        $latestSubscription = $this->subscribe_transactions()->where('is_paid', true)->where('paket_id', $paket_id)
            ->latest('updated_at')->first();

        if (!$latestSubscription) {
            return false;
        }

        $subscriptionEndDate = Carbon::parse($latestSubscription->subscription_start_date)->addMonths(1);
        return Carbon::now()->lessThanOrEqualTo($subscriptionEndDate); // true dia berlangganan
    }
    public function hasActiveSubscription()
    {
        $latestSubscription = $this->subscribe_transactions()->where('is_paid', true)
            ->latest('updated_at')->first();

        if (!$latestSubscription) {
            return false;
        }

        $subscriptionEndDate = Carbon::parse($latestSubscription->subscription_start_date)->addMonths(1);
        return Carbon::now()->lessThanOrEqualTo($subscriptionEndDate); // true dia berlangganan
    }
    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class); // Assuming a User has many QuizQuestions
    }

    public function Comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the replies for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Get all of the courseProgresses for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseProgresses(): HasMany
    {
        return $this->hasMany(CourseProgress::class);
    }

    /**
     * Get all of the transaction for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}

