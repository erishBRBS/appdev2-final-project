<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemProduct extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 
                           'product_name', 
                           'size_id', 
                           'price', 
                           'description', 
                           'quantity_id'];

    public function brand()
    {
        return $this->belongsTo(ItemBrand::class, 'brand_id');
    }

    public function quantity()
    {
        return $this->belongsTo(ItemQuantity::class, 'quantity_id');
    }

    public function size()
    {
        return $this->belongsTo(ItemSize::class, 'size_id');
    }
}
