<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ProductsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [HomeController::class, 'landingPage'])->name('landingPage');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/view', [HomeController::class, 'view'])->name('view');
Route::get('/view2', [HomeController::class, 'view2'])->name('view2');
Route::get('/view3', [HomeController::class, 'view3'])->name('view3');
Route::get('/view4', [HomeController::class, 'view4'])->name('view4');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart');

Route::post('/cart/{itemId}/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/{itemId}/update', [CartController::class, 'updateQuantity'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/proses-checkout', [CheckoutController::class, 'prosesCheckout'])->name('proses-checkout');


Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/order', [HomeController::class, 'order'])->name('order');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
    Route::resource('product', ProductController::class);
    Route::resource('transaction', TransactionController::class);

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('detail-product/{slug}', [ProductsController::class, 'show'])->name('detail-product.show');
Route::get('/add-to-cart/{productId}', [CartController::class, 'addToCart'])
    ->name('add.to.cart')
    ->middleware('role:customer');

Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');
