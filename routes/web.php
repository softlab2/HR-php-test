<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::bind('order', function($id){
    return \App\Order::findOrFail($id);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', function () {
    return view('weather');
})->name('weather');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/orders/{order}/edit', function ( Request $request, \App\Order $order) {
    return view('order_form', ['order'=>$order]);
})->name('order.edit');

Route::post('/orders/{order}/edit', '\App\Http\Controllers\OrderController@storeOrder')->name('order.update');

// Route::post('/orders/{order}/edit', function ( Request $request, \App\Order $order) {
//     Request::flash();
//     return view('order_form', ['order'=>$order]);
// })->name('order.update');

Auth::routes();

Route::get('mail', function () {
    $order = App\Order::find(1);
    
    return (new App\Notifications\OrderSuccess($order))
                    ->toMail($order);
 });


Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
