<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQuantity extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    public function quantities()
    {
        return $this->hasMany(ItemQuantity::class, 'quantity_id');
    }
}
