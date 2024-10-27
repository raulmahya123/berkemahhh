<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get all of the keypointPakets for the Paket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keypointPakets(): HasMany
    {
        return $this->hasMany(KeypointPaket::class);
    }

    public function getFormattedPrice()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get all of the transactions for the Paket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
