<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Public catalog
Route::get('/', function () {
    return view('home');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Auth routes
Route::get('register', [RegisteredUserController::class,'create'])->name('register');
Route::post('register', [RegisteredUserController::class,'store']);
Route::get('login', [AuthenticatedSessionController::class,'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class,'store']);
Route::post('logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');

// Admin product CRUD (protected by admin middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/', function(){ return redirect()->route('admin.products.index'); })->name('dashboard');
});

// Invoice (checkout)
Route::middleware('auth')->group(function(){
    Route::get('checkout', [InvoiceController::class,'create'])->name('invoices.create');
    Route::post('checkout', [InvoiceController::class,'store'])->name('invoices.store');
    Route::get('invoices/{invoice}', [InvoiceController::class,'show'])->name('invoices.show');
});
