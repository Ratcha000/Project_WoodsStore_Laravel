<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\WoodController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\CarpenterController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ShowController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/products', [ProductController::class, 'index']);


Route::get('/stocks/create', [StockController::class, 'create'])->name('stock.create');
Route::post('/stocks', [StockController::class, 'store'])->name('stock.store');

Route::get('/stocks/view', [StockController::class, 'view'])->name('stock.view');



Route::get('/custom_orders', [CustomOrderController::class, 'index'])->name('custom_orders.index');
Route::get('/custom_orders/create', [CustomOrderController::class, 'create'])->name('custom_orders.create');
Route::post('/custom_orders/store', [CustomOrderController::class, 'store'])->name('custom_orders.store');
Route::get('/custom_orders/{id}/edit', [CustomOrderController::class, 'edit'])->name('custom_orders.edit');
Route::put('/custom_orders/{id}', [CustomOrderController::class, 'update'])->name('custom_orders.update');

Route::post('/custom-orders/{id}/add-to-product', [CustomOrderController::class, 'addToProduct'])->name('custom_orders.addToProduct');




Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/from-stock', [ProductController::class, 'createFromStock'])->name('product.from_stock');
Route::post('/product/from-order/{Cusor_ID}', [ProductController::class, 'createFromCustomOrder'])->name('product.from_order');


//Route::get('/products', [ProductController::class, 'index']);


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/add-from-stock', [ProductController::class, 'showAddStockToProduct'])->name('products.showAddFromStock');
Route::post('/products/add-from-stock/{SID}', [ProductController::class, 'addStockToProduct'])->name('products.addFromStock');
Route::get('/products/add-from-completed-orders', [ProductController::class, 'addCompletedOrdersToProducts'])->name('products.addFromCompletedOrders');



//  หน้า Checkout
Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');





// ดำเนินการสั่งซื้อ (บันทึกลงฐานข้อมูล)

Route::get('/order-summary', [OrderController::class, 'orderSummary'])->name('order.summary');
Route::post('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');


//Route::get('/order/success', [OrderController::class, 'orderSuccess'])->name('order.success');



Route::get('/order/success/{bill_id}', function ($bill_id) {
    return view('order_success', compact('bill_id'));
})->name('order.success');



Route::get('/bill/create/{order_id}', [BillController::class, 'createBill'])->name('bill.create');
Route::get('/bill/view/{bill_id}', [BillController::class, 'viewBill'])->name('bill.view');
Route::get('/bill/download/{bill_id}', [BillController::class, 'downloadBillPDF'])->name('bill.download');

Route::resource('costs', CostController::class);



Route::resource('accounts', AccountController::class);




Route::get('/woods/create', [WoodController::class, 'create'])->name('woods.create');
Route::post('/woods/store', [WoodController::class, 'store'])->name('woods.store');



Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');



Route::get('/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
Route::post('/salaries/store', [SalaryController::class, 'store'])->name('salaries.store');



Route::get('/carpenters/create', [CarpenterController::class, 'create'])->name('carpenters.create');
Route::post('/carpenters/store', [CarpenterController::class, 'store'])->name('carpenters.store');


// หน้า Login
Route::get('/home', function () {
    return view('home');
})->name('home');

// Login Routes
Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);

// Register Routes
Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register']);

// Logout Route
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/account', [AccountController::class, 'index'])->name('account.index');
Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
Route::post('/costs', [CostController::class, 'storeCost'])->name('costs.store');



Route::get('/account/show', [AccountController::class, 'show'])->name('account.show');


//show

Route::get('/deliveries', [ShowController::class, 'showDeliveries'])->name('deliveries.show');
Route::post('/deliveries/update/{id}', [ShowController::class, 'updateDeliveryStatus'])->name('deliveries.update');


Route::get('/bills/show', [ShowController::class, 'showBills'])->name('bills.show');
Route::post('/bills/update/{id}', [ShowController::class, 'updatePaymentStatus'])->name('bills.update');


Route::get('/customers/show', [ShowController::class, 'showCustomers'])->name('customers.show');
Route::post('/customers/update/{id}', [ShowController::class, 'updateCustomer'])->name('customers.update'); // ✅ ใช้ updateCustomer

Route::get('/orders/show', [ShowController::class, 'showOrders'])->name('orders.show');
Route::post('/orders/update/{id}', [ShowController::class, 'updateOrderStatus'])->name('orders.update');
