<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserLogActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {
    //Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);
    // profile resource rotues
    Route::resource('profiles', ProfileController::class);
    //Route::post('/profiles/update/', [ProfileController::class, 'profileChange']);
    // brand_categories resource rotues
    // change password route with auth id 
    Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    // PhoneAddressChange route with auth id route with put method
    Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
    // user log activities route
    Route::get('add-to-log', [App\Http\Controllers\Admin\UserLogActivityController::class, 'store'])->name('logActivity.store');
    Route::get('logActivity', [App\Http\Controllers\Admin\UserLogActivityController::class, 'index'])->name('logActivity');
    Route::delete('/admin/logActivity/{id}', [UserLogActivityController::class, 'destroy'])->name('logActivity.destroy');
    Route::get('/admin/logActivity/{id}', [UserLogActivityController::class, 'show'])->name('logActivity.show');

    });