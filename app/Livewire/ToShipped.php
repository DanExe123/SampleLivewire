<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\CustomerPurchase;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class ToShipped extends Component
{

    public $purchases;

    public function mount()
    {
        //$this->loadPurchases();
    }
/*
    public function getAddress($latitude, $longitude)
    {
        if (empty($latitude) || empty($longitude)) {
            Log::warning('Invalid coordinates received:', ['lat' => $latitude, 'lng' => $longitude]);
            return 'Invalid coordinates';
        }
    
        $apiKey = env('AlzaSyYMFug6t6ZXTwrH4nH6CxIwjisa2NLHILs');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";
    
        $response = Http::get($url);
        $data = $response->json();
    
        if (isset($data['results'][0]['formatted_address'])) {
            return $data['results'][0]['formatted_address'];
        }
    
        Log::warning('Google API response did not return an address:', ['response' => $data]);
        return 'Unknown location';
    }
*/

    


    public function render()
    {
        $customerPurchases = CustomerPurchase::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('cart.product')->orderBy('created_at', 'desc')->get();

        return view('livewire.to-shipped', [
            'customerPurchases' => $customerPurchases,
        ]);
    }
}
