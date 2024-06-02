<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class UserAccount extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'user_accounts';

    protected $fillable = [
        'role_id', 
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'address', 
        'mobile_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }
}

