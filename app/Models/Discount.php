<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'percentage',
    ];

    public function applyDiscount($initialPrice)
    {
        $discountAmount = ($this->percentage / 100) * $initialPrice;
        $discountedPrice = $initialPrice - $discountAmount;

        return $discountedPrice;
    }
}
