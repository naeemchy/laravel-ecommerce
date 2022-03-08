<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Frontend Route
Route::get('/', [App\Http\Controllers\Frontend\DashboardController::class, 'index'])->name('user.dashboard');
Route::get('/profile', [App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('user.profile');
Route::get('/profile/update', [App\Http\Controllers\Frontend\ProfileController::class, 'UpdatePage'])->name('update.profile.page');
Route::put('/profile/bio', [App\Http\Controllers\Frontend\ProfileController::class, 'UpdateBio'])->name('update.bio');
Route::put('/profile/credential', [App\Http\Controllers\Frontend\ProfileController::class, 'updateCredential'])->name('update.credential');
Route::post('/user/newsletter', [App\Http\Controllers\NewslaterController::class, 'store'])->name('user.newsletter.store');
Route::get('/category/{id}', [App\Http\Controllers\Frontend\DashboardController::class, 'productFilterByCategory'])->name('user.product.filterbycategory');
Route::get('/sub-category/{id}', [App\Http\Controllers\Frontend\DashboardController::class, 'productFilterBySubCategory'])->name('user.product.filterbysubcategory');
Route::get('/add/to/wishlist/{id}', [App\Http\Controllers\Frontend\WishlistsController::class, 'AddToWishlist']);
Route::get('/all/product', [App\Http\Controllers\Frontend\DashboardController::class, 'allProductList'])->name('all.product.list');
Route::get('/add/to/cart/{id}', [App\Http\Controllers\Frontend\CartController::class, 'Addcart']);
Route::post('/add/to/cart/from/product/details/{id}', [App\Http\Controllers\Frontend\CartController::class, 'addCartFromProductDetails']);
Route::post('/add/to/cart/from/buyone/getone/product/details/{id}', [App\Http\Controllers\Frontend\CartController::class, 'addCartFromBuyoneGetoneProductDetails']);
Route::get('check', [App\Http\Controllers\Frontend\CartController::class, 'check']);
Route::get('/show/cart', [App\Http\Controllers\Frontend\CartController::class, 'showCart'])->name('show.cart');
Route::put('update/cart/item', [App\Http\Controllers\Frontend\CartController::class, 'UpdateCart'])->name('update.cartitem');
Route::put('update/getone/cart/item', [App\Http\Controllers\Frontend\CartController::class, 'UpdateGetoneCart'])->name('update.getone.cartitem');
Route::delete('/cart/product/delete/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'removeCart'])->name('cart.product.delete');
Route::get('/cart/product/update/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'singelCartProductUpdate'])->name('cart.product.update');

Route::get('/cancel/cart/item', [App\Http\Controllers\Frontend\CartController::class, 'cancelCartItem'])->name('allcancel.cart.item');

Route::post('user/apply/coupon', [App\Http\Controllers\Frontend\CartController::class, 'Coupon'])->name('apply.coupon');
Route::get('coupon/remove', [App\Http\Controllers\Frontend\CartController::class, 'CouponRemove'])->name('coupon.remove');
Route::get('checkout', [App\Http\Controllers\Frontend\CartController::class, 'Checkout'])->name('checkout');

Route::get('/product/details/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'singelProduct'])->name('product.view');
Route::get('/product/buyone/getone/details/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'singelProductBuyoneGetone'])->name('product_buyone_getone.view');

Route::post('payment/process', [App\Http\Controllers\Frontend\PaymentController::class, 'Payment'])->name('user.payment.process');
Route::post('user/stripe/charge', [App\Http\Controllers\Frontend\PaymentController::class, 'stripeCharge'])->name('stripe.charge');

Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth', 'user']], function () {

});

// Backend Route
Route::get('get/subcategory/{category_id}', [App\Http\Controllers\Backend\ProductController::class, 'getSubCategory']);

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\Backend\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/bio', [App\Http\Controllers\Backend\ProfileController::class, 'UpdateBio'])->name('update.bio');
    Route::put('/profile/credential', [App\Http\Controllers\Backend\ProfileController::class, 'updateCredential'])->name('update.credential');
    Route::get('/website/setting', [App\Http\Controllers\Backend\WebsiteSettingController::class, 'index'])->name('website.setting');
    Route::put('/website/setting', [App\Http\Controllers\Backend\WebsiteSettingController::class, 'updateWebsiteSetting'])->name('update.website.setting');
    Route::get('/newslater', [App\Http\Controllers\NewslaterController::class, 'index'])->name('newslater.index');
    Route::delete('newslater/destroy/{id}', [App\Http\Controllers\NewslaterController::class, 'destroy'])->name('newslater.destroy');

    Route::resource('category', App\Http\Controllers\Backend\CategoryController::class);
    Route::resource('sub-category', App\Http\Controllers\Backend\SubCategoryController::class);
    Route::resource('brand', App\Http\Controllers\Backend\BrandController::class);
    Route::resource('coupon', App\Http\Controllers\Backend\CouponController::class);
    Route::resource('product', App\Http\Controllers\Backend\ProductController::class);

    Route::get('order/pending', [App\Http\Controllers\Backend\OrderController::class, 'orderPending'])->name('order.pending');
    Route::get('view/order/{id}', [App\Http\Controllers\Backend\OrderController::class, 'viewOrder'])->name('view.order');
    Route::put('order/cancel/{id}', [App\Http\Controllers\Backend\OrderController::class, 'orderCancel'])->name('order.cancel');
    Route::get('order/accept/{id}', [App\Http\Controllers\Backend\OrderController::class, 'orderAccept'])->name('order.accept');
    Route::get('order/accept/list', [App\Http\Controllers\Backend\OrderController::class, 'acceptPaymentOrder'])->name('payment.accept');
    Route::get('order/delevery/progress/{id}', [App\Http\Controllers\Backend\OrderController::class, 'orderDeleveryProgress'])->name('order.delevery.progress');
    Route::get('order/progress/list', [App\Http\Controllers\Backend\OrderController::class, 'orderProgress'])->name('order.progress');
    Route::get('order/delevery/done/{id}', [App\Http\Controllers\Backend\OrderController::class, 'deleveryDone'])->name('order.delevery.done');
    Route::get('order/success/list', [App\Http\Controllers\Backend\OrderController::class, 'SuccessPaymentOrder'])->name('order.success');
    Route::get('order/cancel/list', [App\Http\Controllers\Backend\OrderController::class, 'CancelPaymentOrder'])->name('all.order.cancel');

    Route::get('stock/product', [App\Http\Controllers\Backend\ProductStockController::class, 'stock'])->name('all.product.stock');
    Route::get('stock/product/qty/update/{id}', [App\Http\Controllers\Backend\ProductStockController::class, 'stockUpdate'])->name('update.stock');
    Route::put('stock/product/qty/update/{id}', [App\Http\Controllers\Backend\ProductStockController::class, 'productStockUpdate'])->name('product.stock.update');

    Route::get('report/today/order', [App\Http\Controllers\Backend\ReportController::class, 'todayOrder'])->name('today.order');
    Route::get('report/today/delevered', [App\Http\Controllers\Backend\ReportController::class, 'todayDelevered'])->name('today.delevered');
    Route::get('report/this/month', [App\Http\Controllers\Backend\ReportController::class, 'thisMonthDelevered'])->name('this.month');
    Route::get('report/search', [App\Http\Controllers\Backend\ReportController::class, 'search'])->name('search.report');
    Route::post('search/by/date', [App\Http\Controllers\Backend\ReportController::class, 'searchByDate'])->name('search.by.date');
    Route::post('search/by/month', [App\Http\Controllers\Backend\ReportController::class, 'searchByMonth'])->name('search.by.month');
    Route::post('search/by/year', [App\Http\Controllers\Backend\ReportController::class, 'searchByYear'])->name('search.by.year');

});
