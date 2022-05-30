<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\LcController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgetPasswordController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductbookingController;
use App\Http\Controllers\ServicesaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExpensetypeController;
use App\Http\Controllers\MenuMappingController;
use App\Http\Controllers\RoleController;


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

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('layout.erp.home');
});

// login
Route::post("auth",[AuthController::class,'auth'])->name('auth');
// forgot password
Route::get('forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['admin']], function(){
    // categories
    Route::resource('categories',CategoryController::class);
    // suppliers 
    Route::resource('suppliers',SupplierController::class);
    // users
    Route::match(['get', 'post'], 'changepassword', [AuthController::class, 'changePassword'])->name('changePassword');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('get/boooking', [BookingController::class,'getBoooking'])->name('get.booking');
    Route::get('get/productboooking', [ProductbookingController::class,'getBoooking'])->name('get.productboooking');
    Route::get('get/boooking/date', [BookingController::class,'getBoookingByDate'])->name('get.booking.bydate');
    Route::resource('bookings',BookingController::class);

    Route::resource('menus',MenuController::class);
    Route::get('get-menu', [MenuMappingController::class,'getMenu'])->name('getmenu');
    Route::resource('menumapping',MenuMappingController::class);
    Route::post('menumapping/update', [MenuMappingController::class,'menumappingUpdate'])->name('update.menumapping');
    Route::resource('stocks',StockController::class);
    // cate
    Route::resource('services',ServiceController::class);
    Route::get('email', [MailerController::class,'email']);
    Route::post('send-email', [MailerController::class,'composeEmail'])->name('send-mail');
    Route::get('reports',[ReportController::class,'index']);
    //Route::get('search-customer', [CustomerController::class,'searchCustomer'])->name('search-customer');

    //Route::get("user/create",[UserController::class,'create']);
    Route::get("stock-report",[StockController::class,'stockReport'])->name('stock.report');
    //stock reports
    Route::post("stock-list",[StockController::class,'stockListpdf'])->name('stocklist.pdf');
    Route::get("stocks/receive/create",[StockController::class,'stocksReceiveCreate'])->name('stock.receivecerate');
    Route::post("stocksave",[StockController::class,'save'])->name('stock.save');
    Route::get("price",[PriceController::class,'get_price'])->name('price');
    Route::get("get-customer",[CustomerController::class,'get_customer'])->name('get-customer');
    Route::get("get-customer-booking",[CustomerController::class,'get_customer_booking'])->name('get.customer.booking');
    Route::get("print-booking",[BookingController::class,'printBooking'])->name('print.booking');
    Route::get("print-productbooking",[ProductbookingController::class,'printBooking'])->name('print.productbooking');

    Route::get("get-supplier",[SupplierController::class,'get_supplier'])->name('get-supplier');
    Route::get("getproduct",[ProductController::class,'get_product'])->name('getproduct');
    Route::get("getservice",[ServiceController::class,'get_service'])->name('getservice');
    Route::get("getservice",[ServiceController::class,'get_service'])->name('getservice');

    Route::get("add-exptype",[ExpensetypeController::class,'addExptype'])->name('add.exptype');
    Route::get("add-designation",[DesignationController::class,'addDesignation'])->name('add.designation');
    Route::get("add-transaction",[TransactionController::class,'addTransaction'])->name('add.transaction');
    Route::get("productsale-invoice/{id}",[CustomerController::class,'invoice'])->name('productsale-invoice');
    Route::get("servicesale-invoice/{id}",[CustomerController::class,'serviceInvoice'])->name('servicesale-invoice');
    Route::get("dob/today",[CustomerController::class,'todayDob'])->name('today.dob');
    Route::get("dob/tomorrow",[CustomerController::class,'tomorrowDob'])->name('tomorrow.dob');

    Route::resource('productbookings',ProductbookingController::class);
    Route::resource('expenses',ExpenseController::class);
    Route::resource('settings',SettingController::class);
    Route::resource('payments',PaymentController::class);
    Route::resource('products',ProductController::class);

    Route::resource('productsale', OrderController::class);
    Route::post('print', [OrderController::class, 'orderPrint'])->name('order.print');
    Route::post('sale-print', [ServicesaleController::class, 'servicesalePrint'])->name('servicesale.print');
    Route::post('expenselist-print', [ExpenseController::class, 'expenselistPrint'])->name('expenselist.print');
    Route::post('salesreport-print', [ReportController::class, 'salesreportPrint'])->name('salesreport.print');
    Route::post('servicesale-pdf', [ReportController::class, 'servicesalePdf'])->name('servicesale.pdf');
    Route::post('dailyreport-pdf', [ReportController::class, 'dailyReportPrint'])->name('dailyreport.pdf');
    Route::post('purchase-pdf', [ReportController::class, 'purchasePdf'])->name('purchase.pdf');
    Route::post('payment-report', [ReportController::class, 'paymentReport'])->name('payment.report');
    Route::post('expense-report', [ReportController::class, 'expenseReport'])->name('expense.report');
    Route::get('daily-report', [ReportController::class, 'dailyReport'])->name('daily.report');
    Route::resource('servicesale', ServicesaleController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bank', BankController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('lc', LcController::class);
    // dashboard
    Route::get('home',[HomeController::class,'index'])->name('home');
    // logout
    Route::get("logout",[AuthController::class,'logout'])->name('logout');


    // Route::get('customers', [CustomerController::class,'index'])->name('customer.index');

    Route::post('customers/store', [CustomerController::class,'store'])->name('customers.store');

    // Route::get('/customer/{id}', [CustomerController::class,'show']);

    // Route::put('/customer/{id}', [CustomerController::class,'update'])->name('customer.update');


    Route::post('/customers', [CustomerController::class,'update'])->name('update.customer');
    Route::post('/update/bank', [BankController::class,'update'])->name('update.bank');
    Route::get('/get-invoice', [LcController::class,'getInvoice'])->name('get-invoice');
    Route::get('update-status', [LcController::class,'updateStatus'])->name('update.status');
    Route::get('update-order_status', [OrderController::class,'updateStatus'])->name('update.order_status');
    Route::get('update-booking-status', [BookingController::class,'updateStatus'])->name('update.booking_status');
    Route::get('get-payment', [PaymentController::class,'getPayment'])->name('get.payment');
    Route::get('supplier/delete', [SupplierController::class,'supplierDelete'])->name('supplier.delete');
    Route::get('customer/delete', [CustomerController::class,'customerDelete'])->name('customer.delete');
    Route::get('category/delete', [CategoryController::class,'categoryDelete'])->name('category.delete');
    Route::get('service/delete', [ServiceController::class,'serviceDelete'])->name('service.delete');
    Route::get('product/delete', [ProductController::class,'productDelete'])->name('product.delete');
    Route::get('booking/delete', [BookingController::class,'bookingDelete'])->name('booking.delete');
    Route::get('productbooking/delete', [ProductbookingController::class,'bookingDelete'])->name('productbooking.delete');
    Route::get('expense/delete', [ExpenseController::class,'expenseDelete'])->name('expense.delete');
    Route::get('user/delete', [UserController::class,'userDelete'])->name('user.delete');
    Route::get('payment/delete', [PaymentController::class,'paymentDelete'])->name('payment.delete');
    Route::get('purch/delete', [PurchaseController::class,'purchDelete'])->name('purchase.delete');
    Route::get('menu/delete', [PurchaseController::class,'menuDelete'])->name('menu.delete');
    Route::get('check-invoice', [OrderController::class,'checkInvoice'])->name('check.invoice');
    Route::get('check-service-invoice', [ServicesaleController::class,'checkInvoice'])->name('check.service.invoice');
});
