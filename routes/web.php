<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
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
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categories', [FrontendCategoryController::class, 'show'])->name('categories.index');
Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
Route::get('/resersvation/step-one', [ReservationController::class, 'stepOne'])->name('resersvation.step.one');
Route::post('/resersvation/step-one', [ReservationController::class, 'storeStepOne'])->name('resersvation.store.step.one');
Route::get('/resersvation/step-two', [ReservationController::class, 'stepTwo'])->name('resersvation.step.two');
Route::post('/resersvation/step-two', [ReservationController::class, 'storeStepTwo'])->name('resersvation.store.step.two');
// Route::post('/login', [WelcomeController::class, 'login'])->name('login');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin', 'web'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::post('/categories/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::resource('/menus', MenuController::class);
    Route::post('/menus/export', [MenuController::class, 'export'])->name('menus.export');
    Route::resource('/tables', TableController::class);
    Route::post('/tables/export', [TableController::class, 'export'])->name('tables.export');
    Route::resource('/resersvation', ResersvationController::class);
    Route::post('/resersvation/export', [ResersvationController::class, 'export'])->name('resersvation.export');
    Route::resource('/stocks', StockController::class);
    Route::post('/stocks/export', [StockController::class, 'export'])->name('stocks.export');
    Route::resource('/employees', EmployeeController::class);
    Route::post('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');


});



require __DIR__.'/auth.php';
