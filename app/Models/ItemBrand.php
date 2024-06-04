<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBrand extends Model
{
    use HasFactory;

    protected $fillable = ['brand'];

    public function brands()
    {
        return $this->hasMany(ItemProduct::class, 'brand_id');
    }
}
