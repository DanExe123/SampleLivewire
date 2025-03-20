<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carts_id',
        'total_price',
       
        
    ];

     // Relationship: Each CustomerPurchase belongs to one Cart
     public function cart()
     {
         return $this->belongsTo(Cart::class, 'carts_id');
     }

}