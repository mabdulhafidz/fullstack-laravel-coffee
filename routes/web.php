<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ResersvationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
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
    Route::post('/categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::post('/categories/exportpdf', [CategoryController::class, 'exportPdf'])->name('categories.exportpdf');
    Route::resource('/menus', MenuController::class);
    Route::post('/menus/export', [MenuController::class, 'export'])->name('menus.export');
    Route::post('/menus/exportpdf', [MenuController::class, 'exportPdf'])->name('menus.exportpdf');
    Route::post('/menus/import', [MenuController::class, 'import'])->name('menus.import');
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
    Route::resource('/employees', EmployeeController::class);
    Route::post('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/employees/exportpdf', [EmployeeController::class, 'exportPdf'])->name('employees.exportpdf');
    Route::resource('/transaction', AdminTransactionController::class);

});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/show/{id?}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');




});



require __DIR__.'/auth.php';
