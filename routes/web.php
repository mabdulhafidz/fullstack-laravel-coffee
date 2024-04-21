<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProdukTitipanController;
use App\Http\Controllers\Admin\ResersvationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StockController;                                                 
use App\Http\Controllers\Admin\TentangController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\TransactionDetailController;
use App\Http\Controllers\Admin\TransactionListController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Cashier\TransactionController as CashierTransactionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categories', [FrontendCategoryController::class, 'show'])->name('categories.index');
Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
Route::get('/resersvation/step-one', [ReservationController::class, 'stepOne'])->name('resersvation.step.one');
Route::post('/resersvation/step-one', [ReservationController::class, 'storeStepOne'])->name('resersvation.store.step.one');
Route::get('/resersvation/step-two', [ReservationController::class, 'stepTwo'])->name('resersvation.step.two');
Route::post('/resersvation/step-two', [ReservationController::class, 'storeStepTwo'])->name('resersvation.store.step.two');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::post('/categories/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::post('/categories/import', [CategoryController::class, 'import'])->name('categories.import')->middleware('web');
    Route::get('/categories/pdf', [CategoryController::class, 'pdf'])->name('categories.pdf');
    Route::resource('/types', TypeController::class);
    Route::post('/types/export', [TypeController::class, 'export'])->name('types.export');
    Route::post('/types/import', [TypeController::class, 'import'])->name('types.import')->middleware('web');
    Route::resource('/menus', MenuController::class);
    Route::post('/menus/export', [MenuController::class, 'export'])->name('menus.export');
    Route::post('/menus/exportpdf', [MenuController::class, 'exportPdf'])->name('menus.exportpdf');
    Route::post('/menus/import', [MenuController::class, 'import'])->name('menus.import')->middleware('web');
    Route::resource('/tables', TableController::class);
    Route::post('/tables/export', [TableController::class, 'export'])->name('tables.export');
    Route::post('/tables/import', [TableController::class, 'import'])->name('tables.import');
    Route::post('/tables/exportpdf', [TableController::class, 'exportPdf'])->name('tables.exportpdf');
    Route::resource('/resersvation', ResersvationController::class);
    Route::post('/resersvation/export', [ResersvationController::class, 'export'])->name('resersvation.export');
    Route::post('/resersvation/import', [ReservationController::class, 'import'])->name('resersvation.import');
    Route::post('/resersvation/exportpdf', [ReservationController::class, 'exportPdf'])->name('resersvation.exportpdf');
    Route::resource('/stocks', StockController::class);
    Route::post('/stocks/export', [StockController::class, 'export'])->name('stocks.export');
    Route::post('/stocks/import', [StockController::class, 'import'])->name('stocks.import');
    Route::post('/stocks/exportpdf', [StockController::class, 'exportPdf'])->name('stocks.exportpdf');
    Route::resource('/customer', CustomerController::class);
    Route::post('/customer/export', [CustomerController::class, 'export'])->name('customer.export');
    Route::post('/customer/import', [CustomerController::class, 'import'])->name('customer.import');
    Route::resource('/employees', EmployeeController::class);
    Route::post('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/employees/exportpdf', [EmployeeController::class, 'exportPdf'])->name('employees.exportpdf');  
    Route::resource('/absensi', AbsensiController::class);     
    Route::post('/absensi/export', [AbsensiController::class, 'export'])->name('absensi.export');
    Route::post('/absensi/import', [AbsensiController::class, 'import'])->name('absensi.import');
    Route::resource('/transaction', AdminTransactionController::class);
    Route::resource('/transactionlist', TransactionListController::class);
    Route::get('/transactionlist/search', [TransactionListController::class, 'search'])->name('transactionlist.search');
    // Route::get('/transactionlist/{id}', [TransactionListController::class, 'show'])->name('transactionlist.show');
    Route::post('/transactionlist/export', [TransactionListController::class, 'export'])->name('transactionlist.export');

    Route::get('/transaction/invoice/{id}', [AdminTransactionController::class, 'invoice']);
    Route::resource('/transactiondetail', TransactionDetailController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/produktitipan', ProdukTitipanController::class);
    Route::post('/produktitipan/export', [ProdukTitipanController::class, 'export'])->name('produktitipan.export');
    Route::post('/produktitipan/pdf', [ProdukTitipanController::class, 'pdf'])->name('produktitipan.pdf');
    Route::post('/produktitipan/import', [ProdukTitipanController::class, 'import'])->name('produktitipan.import');
    Route::resource('/tentang', TentangController::class);
    Route::resource('/laporan', LaporanController::class);
}); 

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/show/{id?}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
});

Route::middleware(['auth', 'cashier'])->group(function () {
    Route::resource('/transaction', CashierTransactionController::class);

});



require __DIR__.'/auth.php';
