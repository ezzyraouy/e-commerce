<?php

use App\Http\Controllers\BackOffice\CategoriesController;
use App\Http\Controllers\BackOffice\ProductController;
use App\Http\Controllers\BackOffice\UnitController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontOffice\AuthController;
use App\Http\Controllers\FrontOffice\ProductController as FrontProductController;
use App\Http\Controllers\FrontOffice\CartController;
use App\Http\Controllers\FrontOffice\OrderController;
use App\Http\Controllers\FrontOffice\WishlistController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackOffice\OrderController as BackOfficeOrderController;
use App\Http\Controllers\ContactController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');


// Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart']);

// routes/web.php
// Route::get('/get-cart-wishlist-counts', [CartController::class, 'getCartWishlistCounts']);

// Route to add product to cart
// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// Route::post('/cart/toggle/{product}', [CartController::class, 'toggle'])->name('cart.toggle');

//Front Office
Route::get('/', function () {
    $products = Product::with('category') 
        ->take(12)
        ->get();
    return view('front-office.index', compact('products'));
});
Route::post('/get-cart-items', [CartController::class, 'getCart']);
Route::post('/get-wishlist-items', [WishlistController::class, 'getWishlist']);
Route::get('/product-detail/{slug}', [FrontProductController::class,'show']);
Route::get('/shop', [FrontProductController::class,'index']);
Route::get('/shop/{categorySlug}', [FrontProductController::class,'indexCategorie']);
Route::post('/orders', [OrderController::class,'store'])->name('orders');
Route::get('/wishlist', function(){
    return view('front-office.wishlist');
});
Route::get('/cart', function(){
    return view('front-office.cart');

});
Route::get('/checkout', [CheckoutController::class,'index']);
Route::post('/checkout', [CheckoutController::class,'store']);

Route::get('/products/search', [FrontProductController::class, 'search'])->name('products.search');
Route::get('/products/search1', [FrontProductController::class, 'search1'])->name('products.search1');
Route::get('/products/AllProducts', [FrontProductController::class, 'AllProducts'])->name('products.all');

//Back Office
Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('back-office.index');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/units', UnitController::class);
    Route::resource('/orders', BackOfficeOrderController::class);
    Route::post('/orderItems', [BackOfficeOrderController::class, 'OrderItems'])->name('orders.OrderItems');
    Route::post('/orderuser', [BackOfficeOrderController::class, 'OrderUser'])->name('orders.user');
});

Auth::routes();
Route::post('/registerFront', [AuthController::class, 'register'])->name('registerFront');
Route::post('/loginFront', [AuthController::class, 'login'])->name('loginFront');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', function(){
    return view('front-office.contact');
});

Route::post('/contact/store', [ContactController::class, 'store'])->name('store.contact');