<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'status','selected_size','latitude','longitude','address'];


      // Automatically fetch address when latitude and longitude are set
      protected static function boot()
      {
          parent::boot();
  
          static::saving(function ($cart) {
              if ($cart->latitude && $cart->longitude && empty($cart->address)) {
                  $cart->setAddress(); // Auto-fetch address if it's missing
              }
          });
      }

      
    public function setAddress()
    {
        if ($this->latitude && $this->longitude) {
            $this->address = $this->reverseGeocode($this->latitude, $this->longitude);
            $this->save();
        }
    }

    private function reverseGeocode($latitude, $longitude)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY'); // Make sure your .env file has the correct API key
        $url = "https://maps.gomaps.pro/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";
        
        $response = Http::get($url);
        $data = $response->json();
        
        return $data['results'][0]['formatted_address'] ?? 'Unknown location';
    }





    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
    public function customerPurchase()
    {
        return $this->hasOne(CustomerPurchase::class, 'carts_id');
    }

    
}