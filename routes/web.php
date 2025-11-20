<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ------------------------------
// Public Route
// ------------------------------
Route::get('/', function () {
    return view('welcome');
});

// ------------------------------
// User Routes (Authenticated)
// ------------------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Products
    Route::get('/product', [UserController::class, 'userProductIndex'])->name('user.product');
    Route::get('/product/{product}', [UserController::class, 'userProductShow'])->name('user.product.show');

    // Orders & Cart
    Route::post('/order', [UserController::class, 'userStoreOrder'])->name('user.order.store');
    Route::post('/cart/add', [UserController::class, 'userAddToCart'])->name('user.cart.add');
    Route::get('/cart', [UserController::class, 'userViewCart'])->name('user.cart.index');
    Route::delete('/cart/remove/{productId}', [UserController::class, 'userRemoveFromCart'])->name('user.cart.remove');
});

// ------------------------------
// Admin Routes (Authenticated + Admin)
// ------------------------------
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

    // Categories CRUD
    Route::get('/categories', [AdminController::class, 'adminCategoryIndex'])->name('admin.category.index');
    Route::get('/categories/create', [AdminController::class, 'adminCategoryCreate'])->name('admin.category.create');
    Route::post('/categories', [AdminController::class, 'adminCategoryStore'])->name('admin.category.store');
    Route::get('/categories/{category}', [AdminController::class, 'adminCategoryShow'])->name('admin.category.show');
    Route::get('/categories/{category}/edit', [AdminController::class, 'adminCategoryEdit'])->name('admin.category.edit');
    Route::put('/categories/{category}', [AdminController::class, 'adminCategoryUpdate'])->name('admin.category.update');
    Route::delete('/categories/{category}', [AdminController::class, 'adminCategoryDelete'])->name('admin.category.delete');

    // Products CRUD
    Route::get('/products/create', [AdminController::class, 'adminCreateProduct'])->name('admin.product.create');
    Route::post('/products', [AdminController::class, 'adminStoreProduct'])->name('admin.product.store');
    Route::get('/products/{product}', [AdminController::class, 'adminViewProduct'])->name('admin.product.show');
    Route::get('/products/{product}/edit', [AdminController::class, 'adminEditProduct'])->name('admin.product.edit');
    Route::put('/products/{product}', [AdminController::class, 'adminUpdateProduct'])->name('admin.product.update');
    Route::delete('/products/{product}', [AdminController::class, 'adminDeleteProduct'])->name('admin.product.delete');

    // Suppliers CRUD
    Route::get('/suppliers', [AdminController::class, 'adminSupplierIndex'])->name('admin.supplier.index');
    Route::get('/suppliers/create', [AdminController::class, 'adminCreateSupplier'])->name('admin.supplier.create');
    Route::post('/suppliers', [AdminController::class, 'adminStoreSupplier'])->name('admin.supplier.store');
    Route::get('/suppliers/{supplier}', [AdminController::class, 'adminSupplierView'])->name('admin.supplier.show');
    Route::get('/suppliers/{supplier}/edit', [AdminController::class, 'adminEditSupplier'])->name('admin.supplier.edit');
    Route::put('/suppliers/{supplier}', [AdminController::class, 'adminUpdateSupplier'])->name('admin.supplier.update');
    Route::delete('/suppliers/{supplier}', [AdminController::class, 'adminDeleteSupplier'])->name('admin.supplier.delete');

    // Orders CRUD (Admin)
    Route::get('/orders', [AdminController::class, 'adminOrderIndex'])->name('admin.order.index');
    Route::get('/orders/{order}', [AdminController::class, 'adminOrderShow'])->name('admin.order.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'adminOrderUpdateStatus'])->name('admin.order.update.status');
});

// ------------------------------
// Profile Routes (Authenticated)
// ------------------------------
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------------------
// Auth Routes
// ------------------------------
require __DIR__.'/auth.php';
