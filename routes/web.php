<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\CustomLoginController;

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


Route::get('/',[SiteController::class, 'home'])->name('getHome');

Route::get('search',[SiteController::class, 'search']);

Route::get('/contactUs',[SiteController::class, 'contactUs'])->name('getContactUs');

Route::get('/AboutUs',[SiteController::class, 'aboutUs'])->name('getAboutUs');

Route::get('/shop',[SiteController::class, 'shop'])->name('getShop');

Route::get('/shop/category/{id}',[SiteController::class, 'cateShop'])->name('getCateShop');

Route::get('/product/details/{slug}',[SiteController::class, 'productDetails'])->name('getProductDetails');

Route::get('/review/Product/{id}', [SiteController::class, 'reviewProduct'])->name('getReviewProduct');


Route::middleware('auth')->middleware(['auth','verified'])->group(function () {
    
    Route::get('/account/password/show', [AccountController::class, 'showPasswordForm'])->name('account.showPasswordForm');
    
    Route::post('/account/password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
    
    Route::get('/myAccount',[SiteController::class, 'getAccDashboard'])->name('getAccDashboard');
    
    Route::get('/your-Orders',[SiteController::class, 'getYourOrder'])->name('getYourOrder');
    
    // Carts
    Route::get('/carts', [SiteController::class, 'getCart'])->name('getCart');

    Route::post('/cart/{slug}/add', [SiteController::class, 'postAddToCart'])->name('postAddToCart');

    Route::post('/cart/{id}/update', [SiteController::class, 'getUpdateCart'])->name('getUpdateCart');

    Route::get('/cart/{id}/delete', [SiteController::class, 'getDeleteCart'])->name('getDeleteCart');

    Route::get('/cart/delete/all', [SiteController::class, 'getDeleteAllCart'])->name('getDeleteAllCart');

    Route::get('/checkout', [SiteController::class, 'getProceedToCheckout'])->name('getProceedToCheckout');
    
    Route::post('/direct/checkout/{slug}', [SiteController::class, 'postAddToCartAndDirectProceedToCheckOut'])->name('postAddToCartAndDirectProceedToCheckOut');
    
    Route::post('/checkout', [SiteController::class, 'postCheckout'])->name('postCheckout');

    Route::get('/profile', [AccountController::class, 'edit'])->name('profile.edit');
    
    Route::put('/profile', [AccountController::class, 'update'])->name('profile.update');

    Route::post('/post/review/{id}', [ShopController::class, 'review'])->name('postRatingAndReview');

});


// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'checkUserRole'], function () {

    Route::get('',[AdminController::class,'dashboard'])->name('Dashboard');

    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('getDashboard');
    
    
    Route::get('/manageContactUs',[AdminController::class,'manageContactUs'])->name('getManageContactUs');
    
    
    
    Route::prefix('category')->group (function (){

        Route::get('/manageCategory',[AdminController::class,'manageCategory'])->name('getManageCategory');

        Route::post('add', [ShopController::class, 'postAddCategory'])->name('postAddCategory');
        
        Route::get('delete/{slug}', [ShopController::class, 'getDeleteCategory'])->name('getDeleteCategory');
        
        Route::get('edit/{slug}', [AdminController::class, 'getEditCategory'])->name('getEditCategory');
        
        Route::post('edit/{slug}', [ShopController::class, 'postEditCategory'])->name('postEditCategory');

    
    });

    Route::prefix('product')->group (function (){

        Route::get('/manageProducts',[AdminController::class,'manageProducts'])->name('getManageProducts');

        // admin Product routes
        Route::post('add', [ShopController::class, 'postAddProduct'])->name('postAddProduct');
        
        // admin Product Delete Garne
        Route::get('delete/{slug}', [ShopController::class, 'getDeleteProduct'])->name('getDeleteProduct');
        
        // admin Product Edit Garne
        Route::get('edit/{slug}', [AdminController::class, 'getEditProduct'])->name('getEditProduct');
        
        Route::post('edit/{slug}', [ShopController::class, 'postEditProduct'])->name('postEditProduct');

        
    });

    Route::prefix('aboutUs')->group(function(){
        Route::get('/manageAboutUs',[AdminController::class,'manageAboutUs'])->name('getManageAboutUs');

        Route::post('add/member', [AdminController::class, 'postAddMember'])->name('postAddMember');
        
        Route::post('edit/post/{slug}', [AdminController::class, 'postEditMember'])->name('postEditMember');
        
        Route::get('delete-member/{slug}', [AdminController::class, 'deleteMember'])->name('getDeleteMember');
        
        Route::post('add/post', [AdminController::class, 'postAddPosition'])->name('postAddPosition');

        Route::post('edit/{id}', [AdminController::class, 'postEditMemberPosition'])->name('postEditMemberPosition');

        Route::get('delete-position/{slug}', [AdminController::class, 'getDeleteMemberPosition'])->name('getDeleteMemberPosition');

        

    });

    Route::prefix('orders')->group (function (){
        Route::get('/manageOrders',[AdminController::class,'manageOrders'])->name('getManageOrders');
        Route::get('payment/complete/{id}',[AdminController::class,'makePaymentComplete'])->name('makePaymentComplete');
        Route::get('/searchOrder', [AdminController::class, 'searchOrder'])->name('searchOrder');
        
        Route::post('/admin/orders/updateOrder/{id}', [AdminController::class, 'postUpdateOrder'])->name('updateOrder');


    });



    
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('login', [CustomLoginController::class, 'showLoginForm'])->name('login');

Route::get('register', [CustomLoginController::class, 'showRegisterForm'])->name('register');