<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable
{
    use HasFactory;

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

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }
}

