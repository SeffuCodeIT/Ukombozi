<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('main.home');
});


Route::get('/shop', [\App\Http\Controllers\IndexController::class, 'shop'])->name('shop');
Route::get('/about', [\App\Http\Controllers\IndexController::class, 'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\IndexController::class, 'contact'])->name('contact');
Route::get('/products/{id}', [\App\Http\Controllers\IndexController::class, 'products'])->name('products');
Route::any('/addCart/{id}', [\App\Http\Controllers\BooksController::class, 'addCart'])->name('addCart');
Route::get('/showCart', [\App\Http\Controllers\BooksController::class, 'showCart'])->name('showCart');
Route::delete('removeItem/{id}', [\App\Http\Controllers\BooksController::class, 'removeItem'])->name('removeItem');
Route::any('cart/update', [\App\Http\Controllers\BooksController::class, 'updateCart'])->name('cart.update');
Route::any('/checkout', [\App\Http\Controllers\BooksController::class, 'checkout'])->name('checkout');
//Route::post('/payment', [\App\Http\Controllers\BooksController::class, 'payment'])->name('payment');
Route::any('/payment', [\App\Http\Controllers\PaymentController::class, 'stkPush'])->name('stkPush');
//Route::any('/mpesa/callback', [\App\Http\Controllers\PaymentController::class, 'checkStkPushStatus'])->name('checkStkPushStatus');
// routes/web.php

//Route::get('/mpesa/check-status', [\App\Http\Controllers\PaymentController::class, 'checkStkPushStatus']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache cleared!";
});

Route::get('/pesapalAccessToken', [\App\Http\Controllers\PaymentController::class, 'pesapalAccessToken'])->name('pesapalAccessToken');
Route::get('/registerPesapalIPN', [\App\Http\Controllers\PaymentController::class, 'registerPesapalIPN'])->name('registerPesapalIPN');
Route::get('/getRegisteredIPNs', [\App\Http\Controllers\PaymentController::class, 'getRegisteredIPNs'])->name('getRegisteredIPNs');
Route::any('/submitOrderRequest', [\App\Http\Controllers\PaymentController::class, 'submitOrderRequest'])->name('submitOrderRequest');
Route::any('/success', [\App\Http\Controllers\PaymentController::class, 'paymentSuccess'])->name('paymentSuccess');
Route::get('/refundRequest', [\App\Http\Controllers\PaymentController::class, 'refundRequest'])->name('refundRequest');
Route::get('/orderCancellation', [\App\Http\Controllers\PaymentController::class, 'orderCancellation'])->name('orderCancellation');


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\IndexController::class, 'admin'])->name('admin');
    Route::post('/category', [\App\Http\Controllers\BooksController::class, 'category'])->name('category');
    Route::post('/save-book', [\App\Http\Controllers\BooksController::class, 'store'])->name('store');
});
//Auth::routes();
