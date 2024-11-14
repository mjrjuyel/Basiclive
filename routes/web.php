<?php

use Illuminate\Support\Facades\Route;

// Chat COntroller
use App\Http\Controllers\Admin\ChatController;

// Live Wire Counter
use App\Livewire\Counter;
// use Session;

Route::view('/', 'welcome');

Route::get('/chat',[ChatController::class,'index'])->middleware('auth');


// Normal Coupon Add in Session
Route::get('/wishlist/add',function(){
    Session::put('coupon',[
        'name'=>'Juyel',
        'price'=>1000,
        'date'=>'2023-2-1',
    ]);
    return Session::get('coupon')['name'];
});

Route::get('wishlist',function(){
    $coupon = Session::get('coupon');
    dd($coupon);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/counter',Counter::class);

require __DIR__.'/auth.php';
