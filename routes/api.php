<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\AuthApiController;
use App\Http\Controllers\Api\V1\Admin\RolesApiController;
use App\Http\Controllers\Api\V1\Admin\UsersApiController;
use App\Http\Controllers\Api\V1\Admin\ProfileApiController;
use App\Http\Controllers\Api\V1\Admin\PermissionsApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/auth/register', [AuthApiController::class, 'createUser']);
Route::post('/auth/login', [AuthApiController::class, 'loginUser']);
Route::post('/auth/logout', [AuthApiController::class, 'logoutUser']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', PermissionsApiController::class);
    // permissions update route
    Route::put('permissions/{permission}', [PermissionsApiController::class, 'update']);

    // Roles
    Route::apiResource('roles', RolesApiController::class);

    // Users
    Route::apiResource('users', UsersApiController::class);

    // profile resource rotues
    Route::apiResource('/profiles', ProfileApiController::class);
    // PhoneAddressChange
    Route::put('/phone-address-change', [ProfileApiController::class, 'PhoneAddressChange']);
    
});