<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ResellerController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ActivityLogController;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        // Route::get('/', function () {
        //     return view('welcome');
        // });

        // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->middleware(['auth'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


        Route::get('/users', [UsersController::class, 'index'])->name('index_users');
        
        Route::get('/unconfirmedusers', [UsersController::class, 'show_unconfirmed_users'])->name('unconfirmed_users');
        
        Route::get('/activeusers', [UsersController::class, 'show_active_users'])->name('active_users');
        
        Route::get('/disabledusers', [UsersController::class, 'show_disabled_users'])->name('disabled_users');


        Route::get('/users/create', [UsersController::class, 'create'])->name('create_user');

        Route::post('/users/store', [UsersController::class, 'store'])->name('store_user');

        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('edit_user');

        Route::patch('/users/{id}/update', [UsersController::class, 'update'])->name('update_user');

        Route::put('/users/{id}/status', [UsersController::class, 'activeOrDisable'])->name('active_disable');

        Route::delete('/users/{id}/delete', [UsersController::class, 'destroy'])->name('delete_user');


        Route::get('/admins', [UsersController::class, 'showAdmins'])->name('index_admins');


        Route::resource('roles',RoleController::class);



        Route::get('/products', [ProductController::class, 'index'])->name('index_products');

        Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');

        Route::post('/product/store', [ProductController::class, 'store'])->name('store_product');

        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit_product');

        Route::patch('/product/{id}/update', [ProductController::class, 'update'])->name('update_product');

        Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->name('delete_product');




        Route::get('/logs', [ActivityLogController::class, 'index'])->name('admin_logs');

        Route::delete('/logs/{id}/delete', [ActivityLogController::class, 'destroy'])->name('delete_log');


        Route::get('/agents', [AgentController::class, 'index'])->name('index_agents');

        Route::get('/agent/create', [AgentController::class, 'create'])->name('create_agent');

        Route::post('/agent/store', [AgentController::class, 'store'])->name('store_agent');

        Route::get('/agent/{id}/edit', [AgentController::class, 'edit'])->name('edit_agent');

        Route::patch('/agent/{id}/update', [AgentController::class, 'update'])->name('update_agent');

        Route::delete('/agent/{id}/delete', [AgentController::class, 'destroy'])->name('delete_agent');




        Route::get('/resellers', [ResellerController::class, 'index'])->name('index_resellers');

        Route::get('/reseller/create', [ResellerController::class, 'create'])->name('create_reseller');

        Route::post('/reseller/store', [ResellerController::class, 'store'])->name('store_reseller');

        Route::get('/reseller/{id}/edit', [ResellerController::class, 'edit'])->name('edit_reseller');

        Route::patch('/reseller/{id}/update', [ResellerController::class, 'update'])->name('update_reseller');

        Route::delete('/reseller/{id}/delete', [ResellerController::class, 'destroy'])->name('delete_reseller');



        Route::get('/payments', [PaymentController::class, 'index'])->name('index_payments');

        Route::get('/payment/create', [PaymentController::class, 'create'])->name('create_payment');

        Route::post('/payment/store', [PaymentController::class, 'store'])->name('store_payment');

        Route::get('/payment/{id}/edit', [PaymentController::class, 'edit'])->name('edit_payment');

        Route::patch('/payment/{id}/update', [PaymentController::class, 'update'])->name('update_payment');

        Route::delete('/payment/{id}/delete', [PaymentController::class, 'destroy'])->name('delete_payment');


        Route::get('/settings', [SettingsController::class, 'index'])->name('index_settings');

        Route::post('/app_image/store', [SettingsController::class, 'store_app_image'])->name('store_app_image');

        Route::post('/admin_image/store', [SettingsController::class, 'store_admin_image'])->name('store_admin_image');


    });




require __DIR__.'/auth.php';
