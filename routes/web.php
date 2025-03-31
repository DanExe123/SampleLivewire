<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\ContactUs;
use App\Livewire\CreateItem;
use App\Livewire\AddProduct;
use App\Livewire\CloneFieldGrade;
//use App\Livewire\CartView;
// data tables buttons
use App\Livewire\Login;
use App\Livewire\EditProduct;
use App\Livewire\WelcomeChromehearts;
use App\Livewire\Cartpage;
use App\Livewire\ProductManagement;
use App\Livewire\CustomerAccount;
//use App\Livewire\OrdersManagement;
use App\Livewire\Shipped;
use App\Livewire\MyOrders;
use App\Livewire\ToShipped;
use App\Livewire\Orders;


 /* Customer side */
 Route::middleware(['auth', 'verified'
 ])->prefix('customer')->group(function () {
            Route::get('/edit-product/{id}', EditProduct::class)->name('edit-product');
           
            Route::get('/cartpage', Cartpage::class)->name('cartpage');
            Route::get('/welcome-chromehearts', WelcomeChromehearts::class)->name('WelcomeChromehearts');
            Route::get('/login', Login::class)->name('login');
            Route::get('/add-product', AddProduct::class)->name('add-product');
            Route::get('/contact-us', ContactUs::class)->name('contact-us');
            Route::get('/create-item', CreateItem::class)->name('create-item');
            Route::get('/CloneFieldGrade', CloneFieldGrade::class)->name('clone-field-grade');
            Route::get('/my-orders', MyOrders::class)->name('my-orders');


            // My purchase Pages
            Route::get('/to-shipped', ToShipped::class)->name('to-shipped');

    });





        /* Admin Side */
Route::middleware(['auth', 'verified'])->group(function(){
   // Route::prefix('admin')->group(function () {
            Route::get('/product-management', ProductManagement::class)->name('product-management');
            Route::get('/customer-account', CustomerAccount::class)->name('customer-account');
           // Route::get('/orders-management', OrdersManagement::class)->name('orders-management');
            Route::get('/shipped', Shipped::class)->name('shipped');
            Route::get('/orders', Orders::class)->name('orders');
   // });
});






Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';



