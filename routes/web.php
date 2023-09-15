<?php


use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\HomeController as UserHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('/cart/coupon', [CartController::class, 'addCoupon'])->name('coupon.add');
    Route::match(['GET', 'POST'],'/shop/{cat?}/{sub_cat?}/{inner_cat?}', [ShopController::class, 'index'])->name('shop');
    Route::post('product/variation/check', [ProductController::class, 'getVariationPrice'])->name('product.variation.check');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'order'])->name('checkout');
    Route::post('/checkout/shipping', [CheckoutController::class, 'shipping'])->name('checkout.shipping');
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us');
    Route::post('/contact-us', [PageController::class, 'saveContactMsg'])->name('contact-us');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/terms-conditions', [PageController::class, 'termsCondition'])->name('terms-conditions');
    Route::get('/cookies-policy', [PageController::class, 'cookiePolicy'])->name('cookies-policy');
    Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('return-policy');
    Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');
    Route::post('/subscribe', [PageController::class, 'subscribe'])->name('subscribe');

    Route::get('payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment/cancel', [CheckoutController::class, 'paymentCancel'])->name('payment.cancel');
});


Auth::routes();
Route::get('/home', [UserHomeController::class, 'index'])->name('home');
Route::post('change-password',[UserHomeController::class, 'changePassword'])->name('user.change-password');
Route::post('update-account',[UserHomeController::class, 'updateProfile'])->name('user.update-account');
Route::post('update-shipping',[UserHomeController::class, 'updateShipping'])->name('user.update-shipping');
Route::get('orders/{id}/view',[UserHomeController::class, 'userOrder'])->name('user.order.view');
Route::get('orders/{id}/download',[UserHomeController::class, 'invoice'])->name('user.order.download');
Route::get('orders/{id}/print',[UserHomeController::class, 'printInvoice'])->name('user.order.print');
Route::get('wishlist',[WishlistController::class, 'index'])->name('wishlist');
Route::post('wishlist',[WishlistController::class, 'store'])->name('wishlist');
Route::post('wishlist/remove',[WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/{slug1}/{slug2?}/{slug3?}', [ProductController::class, 'products']);
