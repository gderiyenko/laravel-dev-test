<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchace extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'stripe_id',
        'stripe_status',
        'stripe_product_id',
        'stripe_price_id',
        'stripe_last_digits',
    ];

    /**
     * Get the user that owns the purchace.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
