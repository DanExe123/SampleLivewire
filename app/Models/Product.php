<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        //'category',
        'price',
        'stock',
        'description',
        'image',
        'status',
        'category_id',
        'size',
        
    ];

      // Move scopeSearch() outside of casts()
      public function scopeSearch($query, $value) {
        return $query->where('name', 'like', "%{$value}%")
                     ->orWhere('email', 'like', "%{$value}%");
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
