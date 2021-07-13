<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price'
    ];

    protected $with = [
        'category'
    ];

    protected $casts = [
        'price' => 'integer'
    ];

    function category() {
        return $this->belongsTo(Category::class);
    }

    function calculate(int $amount = 1) {
        return ($this->price * $amount) / 100;
    }
}
