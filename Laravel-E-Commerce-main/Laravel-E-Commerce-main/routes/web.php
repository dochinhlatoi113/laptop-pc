<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    route::get('/dashboard', [HomeController::class, 'Home'])->name('dashboard');
});


/* Admin Routes */

/* category*/
route::get('/view_category', [App\Http\Controllers\CategoryController::class, 'ViewCategory'])->name('admin.category');
route::post('/add_category', [App\Http\Controllers\CategoryController::class, 'AddCategory'])->name('admin.add_category');
route::get('/delete_category/{id}', [App\Http\Controllers\CategoryController::class, 'DeleteCategory']);
route::get('/edit_category/{id}', [App\Http\Controllers\CategoryController::class, 'EditCategory']);
route::post('/update_category/{id}', [App\Http\Controllers\CategoryController::class, 'UpdateCategory'])->name('admin.update_category');

route::get('/create_category_option', [App\Http\Controllers\CategoryOptionController::class, 'CreateCategoryOption'])->name('admin.create_category_option');
route::post('/add_category_option', [App\Http\Controllers\CategoryOptionController::class, 'AddCategoryOption'])->name('admin.add_category_option');
route::get('/view_category_option', [App\Http\Controllers\CategoryOptionController::class, 'ViewCategoryOption'])->name('admin.view_category_option');
route::post('/update_category_option/{id}', [App\Http\Controllers\CategoryOptionController::class, 'UpdateCategoryOption'])->name('admin.update_category_option');
route::get('/delete_category_option/{id}', [App\Http\Controllers\CategoryOptionController::class, 'DeleteCategoryOption'])->name('admin.delete_category_option');



/* product*/
route::get('/view_product', [App\Http\Controllers\ProductController::class, 'ViewProduct'])->name('admin.view_product');
route::post('/add_product', [App\Http\Controllers\ProductController::class, 'AddProduct'])->name('admin.add_product');
route::get('/show_product', [App\Http\Controllers\ProductController::class, 'ShowProduct'])->name('admin.show_product');
route::get('/delete_product/{id}', [App\Http\Controllers\ProductController::class, 'DeleteProduct'])->name('admin.delete_product');
route::get('/edit_product/{id}', [App\Http\Controllers\ProductController::class, 'EditProduct'])->name('admin.edit_product');
route::post('/update_product/{id}', [App\Http\Controllers\ProductController::class, 'UpdateProduct']);
Route::get('/search-product', [App\Http\Controllers\ProductController::class, 'SearchProduct']);
route::get('/view_product_category_option_json/{id}', [App\Http\Controllers\ProductController::class, 'ViewProductCategoryOptionJson'])->name('admin.view_product_category_option_json');


/* order*/
Route::get('/search-order', [App\Http\Controllers\OrderController::class, 'SearchOrder']);
route::get('/user-orders', [App\Http\Controllers\OrderController::class, 'UserOrders'])->name('admin.user_orders');
route::get('/update-order/{user_id}/{order_id}/{delivery_status}', [App\Http\Controllers\OrderController::class, 'UpdateOrder']);
route::get('/print-bill/{order_id}', [App\Http\Controllers\OrderController::class, 'PrintBill']);

/* customer*/
route::get('/customers', [App\Http\Controllers\Customer::class, 'Customers']);
route::get('/delete-user/{id}', [App\Http\Controllers\Customer::class, 'DeleteUser']);
Route::get('/search-user', [App\Http\Controllers\Customer::class, 'SearchUser']);

/** brand */
/* customer*/
route::get('/create_brand', [App\Http\Controllers\BrandController::class, 'CreateBrand'])->name('admin.create_brand');
route::post('/add_brand', [App\Http\Controllers\BranchController::class, 'AddBrand']);
route::get('/delete_brand/{id}', [App\Http\Controllers\BrandController::class, 'DeleteBrand']);
Route::get('/search_brand', [App\Http\Controllers\BrandController::class, 'SearchBrand']);
Route::get('/edit_brand', [App\Http\Controllers\BrandController::class, 'EditBrand']);
Route::post('/update_brand/{id}', [App\Http\Controllers\BrandController::class, 'UpdateBrand']);

/************************************************************ */
/* User routes */

route::get('/', [HomeController::class, 'index']);
route::get('/home', [HomeController::class, 'Home'])->name('home')->middleware('auth','verified');
route::get('/my-account', [HomeController::class, 'UserAccount'])->name('user.account');
route::get('/user/logout', [HomeController::class, 'UserLogout'])->name('user.logout');
Route::get('/product_details/{id}',[HomeController::class, 'ProductDetails']);
Route::get('/shop', [HomeController::class, 'ShopPage'])->name('user.shop');
Route::get('/contact', [HomeController::class, 'ContactPage'])->name('user.contact');
Route::post('/add-to-cart/{id}', [HomeController::class, 'AddToCart']);
Route::get('/my-cart',[HomeController::class, 'CartPage'])->name('user.cart');
Route::get('/remove-product-from-cart/{id}',[HomeController::class, 'RemoveProductFromCart']);
Route::get('/clear-cart', [HomeController::class, 'ClearCart'])->name('user.clear_cart');
Route::get('/checkout', [HomeController::class,'Checkout'])->name('user.checkout');
Route::get('/orders', [HomeController::class, 'UserOrders'])->name('user.orders');
Route::get('/order-received/{id}', [HomeController::class, 'OrderReceived']);
Route::get('/cancel-order/{id}', [HomeController::class, 'CancelOrder']);
Route::get('/search-a-product', [HomeController::class, 'SearchProduct']);
Route::get('/update-password', [HomeController::class, 'UpdatePassword']);
Route::get('/technology-news', [HomeController::class, 'GetTechnologyNews'])->name('news');


Route::get('/cash-order', [HomeController::class, 'CashOrder']);
Route::get('/stripe/{totalPrice}', [HomeController::class, 'Stripe']);
Route::post('/stripe/{totalPrice}', [HomeController::class, 'StripePost'])->name('stripe.post');
