<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 
                           'product_id', 
                           'total_price'];

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(ItemProduct::class, 'product_id');
    }
    
}
