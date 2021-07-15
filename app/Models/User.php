<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $withCount = [
        'cart'
    ];

    protected $with = [
        'role'
    ];

    function cart() {
        return $this->hasMany(Cart::class);
    }

    function orders() {
        return $this->hasMany(Order::class);
    }

    function role() {
        return $this->belongsTo(Role::class);
    }

    function hasRole($role) {
        if (!$this->role) return false;

        $role = is_array($role) ? $role : func_get_args();

        return (new UserRole($this->role->name))->is($role);
    }
}
