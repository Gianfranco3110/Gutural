<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Middleware\CheckMaintenanceMode;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

// ─── Public Routes ────────────────────────────────────────────
Route::middleware(CheckMaintenanceMode::class)->group(function () {
    Route::get('/', [HomeController::class, 'show'])->name('home');
    Route::get('/tienda', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/tienda/{product:slug}', [ShopController::class, 'show'])->name('shop.show');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

// ─── API Routes ───────────────────────────────────────────────
Route::get('/api/search-products', function () {
    $query = request('q');
    
    if (strlen($query) < 2) {
        return response()->json([]);
    }
    
    $products = Product::where('is_active', true)
        ->where(function($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('description', 'like', '%' . $query . '%');
        })
        ->with('images')
        ->limit(5)
        ->get(['id', 'name', 'slug', 'price']);
    
    return response()->json($products);
});

// ─── Admin Auth ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // ─── Admin Protected Routes ───────────────────────────────
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('productos')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('crear', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('{product}/editar', [ProductController::class, 'edit'])->name('edit');
            Route::put('{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('{product}', [ProductController::class, 'destroy'])->name('destroy');
            Route::patch('{product}/toggle', [ProductController::class, 'toggleActive'])->name('toggle');
        });

        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('crear', [PostController::class, 'create'])->name('create');
            Route::post('/', [PostController::class, 'store'])->name('store');
            Route::get('{post}/editar', [PostController::class, 'edit'])->name('edit');
            Route::put('{post}', [PostController::class, 'update'])->name('update');
            Route::delete('{post}', [PostController::class, 'destroy'])->name('destroy');
            Route::patch('{post}/toggle', [PostController::class, 'togglePublished'])->name('toggle');
        });

        Route::get('mantenimiento', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::put('mantenimiento', [MaintenanceController::class, 'update'])->name('maintenance.update');
    });
});

