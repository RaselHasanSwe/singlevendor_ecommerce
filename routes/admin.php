<?php

use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InnerCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HappyCustomerController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('inner-category', InnerCategoryController::class);
    Route::resource('size', SizeController::class);
    Route::resource('color', ColorController::class);
    Route::resource('shipping', ShippingController::class);
    Route::resource('coupon', CouponController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('product', ProductController::class);
    Route::post('product/active',[ProductController::class, 'active'])->name('product.active');
    Route::post('product/image/delete',[ProductController::class, 'deleteAditionlImage'])->name('product.image.delete');
    Route::get('admin-setting', [AdminSettingController::class, 'index'])->name('admin-setting');
    Route::get('website-setting', [WebsiteSettingController::class, 'index'])->name('website-setting');
    Route::post('website-setting', [WebsiteSettingController::class, 'store'])->name('website-setting');
    Route::get('website-policy', [WebsiteSettingController::class, 'policies'])->name('website-policy');
    Route::post('website-policy', [WebsiteSettingController::class, 'policyStore'])->name('website-policy');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
    Route::resource('faq',FaqController::class);
    Route::resource('team',TeamController::class);
    Route::resource('happy-customer',HappyCustomerController::class);

});
