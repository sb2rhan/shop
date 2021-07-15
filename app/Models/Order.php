<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'address', 'products', 'is_approved'
    ];

    protected $casts = [
        'products' => 'json', #from array to json
        'is_approved' => 'boolean'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }
}
