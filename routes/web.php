<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\Auth\AdminLoginController;



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
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/userlogin', [App\Http\Controllers\Auth\UserLoginController::class, 'showLoginForm'])->name('userlogin');
Route::post('/userlogin', [App\Http\Controllers\Auth\UserLoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\UserLoginController::class, 'logout'])->name('logout');

Route::get('/adminlogin', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('adminlogin');
Route::post('/adminlogin', [AdminLoginController::class, 'login']);
 // shop routes
 Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop');
    Route::post('/', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/show/{id}', [ShopController::class, 'show'])->name('shop.show');

});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('biodata', BiodataController::class);
    Route::get('/overview/{id}', [OverviewController::class, 'show'])->name('user.overview');
    Route::get('/settings/{id}', [BiodataController::class, 'show'])->name('user.settings');
    Route::post('ajaxemailupdate', [BiodataController::class, 'ajaxemailupdate']);
    Route::post('ajaxpasswordupdate', [BiodataController::class, 'ajaxpasswordupdate']);
    Route::resource('permissions', PermissionController::class);
    Route::get('/adduser/{id}', [RoleController::class, 'adduser'])->name('roles.adduser');
    Route::get('/updateuserrole', [RoleController::class, 'updateuserrole'])->name('roles.updateuserrole');
    Route::get('/userid/{userid}/roleid/{roleid}', [RoleController::class, 'removeuserrole'])->name('roles.removeuserrole');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/userdashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    // Dashboard Routes
    Route::get('/userdashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/userdashboard/update', [UserDashboardController::class, 'update'])->name('user.update');

    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::post('/billing/update', [BillingAddressController::class, 'update'])->name('billing.update');

    Route::resource('category', CategoryController::class);
    Route::delete('/deletecategory/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::resource('brand', BrandController::class);
    Route::delete('/deletebrand/{id}', [CategoryController::class, 'destroy'])->name('brand.destroy');

    Route::resource('customer', CustomerController::class);
    Route::resource('invoice', InvoiceController::class);


    Route::resource('product', ProductController::class);
    // Route::get('/deleteproduct/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/upload-images', [ProductController::class, 'uploadImages'])->name('upload.images');
    //Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


    Route::resource('report', ReportController::class);
    Route::resource('return', ReturnController::class);


    Route::resource('store', WarehouseController::class);
    Route::delete('/deletestore/{id}', [WarehouseController::class, 'destroy'])->name('store.destroy');

    Route::resource('tag', TagController::class);
    Route::delete('/deletetag/{id}', [TagController::class, 'destroy'])->name('tag.destroy');

    Route::resource('unit', UnitController::class);
    Route::delete('/deleteunit/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');

    Route::resource('variant', VariantController::class);
    Route::delete('/deletevariant/{id}', [VariantController::class, 'destroy'])->name('variant.destroy');

    Route::resource('pos', PosController::class);

    Route::resource('stocks', StockController::class);



    Route::resource('sales', SaleController::class);



    Route::resource('customers', CustomerController::class);


    Route::resource('payments', PaymentController::class);


    //Route::resource('orders', OrderController::class);
    Route::post('/saveorders', [OrderController::class, 'store'])->name('orders.saveorders');

    Route::prefix('cart')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('cart.index');
            Route::post('/', [CartController::class, 'store'])->name('cart.store');
            Route::put('/{cartItem}', [CartController::class, 'update'])->name('cart.update');
            Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
            // Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');


            // Checkout routes – now directly under /checkout
            Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('/checkout/payment-intent', [CheckoutController::class, 'createPaymentIntent'])->name('checkout.payment.intent');
            Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
            Route::get('/order/success', function () {
                return view('frontend.order-success');
            })->name('order.success');

    });


   // Wishlist routes
    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::delete('/{wishlistItem}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

        // New route: Clear entire wishlist
        Route::post('/clear-all', [WishlistController::class, 'clearAll'])->name('wishlist.destroy.all');
    });

    // Compare routes
    Route::post('/compare/{product}', [CompareController::class, 'add'])->name('compare.add');
    Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');
    Route::delete('/compare/{product}', [CompareController::class, 'remove'])->name('compare.remove');

    Route::prefix('reviews')->group(function (){
            Route::post('/{productId}', [ReviewController::class, 'store'])->name('reviews.store');
            Route::put('/{review}', [ReviewController::class, 'update'])->name('reviews.update');
            Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });





    //billing address
    Route::get('/billingaddress/edit', [BillingAddressController::class, 'edit'])->name('user.address.edit');
    Route::post('/billingaddress/update', [BillingAddressController::class, 'update'])->name('user.address.update');


});
