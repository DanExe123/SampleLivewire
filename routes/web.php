<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\ContactUs;




<<<<<<< HEAD
Route::get('/contact-us', ContactUs::class)->name('contact-us');


=======

//Route::get('/', LandingPage::class);

//Route::get('/userpage', UserPage::class);
>>>>>>> ac0b52d5c9c2a3990e724e2f3a71e632e1ae840f


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



