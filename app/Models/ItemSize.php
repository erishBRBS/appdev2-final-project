<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSize extends Model
{
    use HasFactory;

    protected $fillable = ['size'];

    public function sizes()
    {
        return $this->hasMany(ItemSize::class, 'size_id');
    }
}
