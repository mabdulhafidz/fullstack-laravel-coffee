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

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::resource('/menus', MenuController::class);
    Route::get('/menus/export', [MenuController::class, 'export']);
    Route::resource('/tables', TableController::class);
    Route::get('/tables/export', [TableController::class, 'export']);
    Route::resource('/resersvation', ResersvationController::class);
    Route::get('/resersvation/export', [ResersvationController::class, 'export']);
    Route::resource('/stocks', StockController::class);
    Route::get('/stocks/export', [StockController::class, 'export']);
    Route::resource('/employees', EmployeeController::class);
    Route::get('/employees/export', [EmployeeController::class, 'export']);  
});



require __DIR__.'/auth.php';
