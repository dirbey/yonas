<?php

use App\Http\Controllers\API\Admin\ActivityLogController;
use App\Http\Controllers\API\Admin\AuthController;
use App\Http\Controllers\API\Admin\CustomerController;
use App\Http\Controllers\API\Admin\FileUploadController;
use App\Http\Controllers\API\Admin\PermissionController;
use App\Http\Controllers\API\Admin\PlanController;
use App\Http\Controllers\API\Admin\PushNotificationController;
use App\Http\Controllers\API\Admin\RoleController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'validate.user']], function () {
    Route::post('plans', [PlanController::class, 'store'])
        ->name('plan.store')
        ->middleware(['permission:create_plan']);
    Route::get('plans', [PlanController::class, 'index'])
        ->name('plans.index')
        ->middleware(['permission:read_plan']);
    Route::get('plans/{plan}', [PlanController::class, 'show'])
        ->name('plan.show')
        ->middleware(['permission:read_plan']);
    Route::put('plans/{plan}', [PlanController::class, 'update'])
        ->name('plan.update')
        ->middleware(['permission:update_plan']);
    Route::delete('plans/{plan}', [PlanController::class, 'delete'])
        ->name('plan.delete')
        ->middleware(['permission:delete_plan']);
    Route::post('plans/bulk-create', [PlanController::class, 'bulkStore'])
        ->name('plan.store.bulk')
        ->middleware(['permission:create_plan']);
    Route::post('plans/bulk-update', [PlanController::class, 'bulkUpdate'])
        ->name('plan.update.bulk')
        ->middleware(['permission:update_plan']);

    Route::post('customers', [CustomerController::class, 'store'])
        ->name('customer.store')
        ->middleware(['permission:create_customer']);
    Route::get('customers', [CustomerController::class, 'index'])
        ->name('customers.index')
        ->middleware(['permission:read_customer']);
    Route::get('customers/{customer}', [CustomerController::class, 'show'])
        ->name('customer.show')
        ->middleware(['permission:read_customer']);
    Route::put('customers/{customer}', [CustomerController::class, 'update'])
        ->name('customer.update')
        ->middleware(['permission:update_customer']);
    Route::delete('customers/{customer}', [CustomerController::class, 'delete'])
        ->name('customer.delete')
        ->middleware(['permission:delete_customer']);
    Route::post('customers/bulk-create', [CustomerController::class, 'bulkStore'])
        ->name('customer.store.bulk')
        ->middleware(['permission:create_customer']);
    Route::post('customers/bulk-update', [CustomerController::class, 'bulkUpdate'])
        ->name('customer.update.bulk')
        ->middleware(['permission:update_customer']);

    Route::get('roles', [RoleController::class, 'index'])
        ->name('role.index')
        ->middleware(['permission:manage_roles']);
    Route::get('roles/{role}', [RoleController::class, 'show'])
        ->name('role.show')
        ->middleware(['permission:manage_roles']);
    Route::post('roles', [RoleController::class, 'store'])
        ->name('role.store')
        ->middleware(['permission:manage_roles']);
    Route::put('roles/{role}', [RoleController::class, 'update'])
        ->name('role.update')
        ->middleware(['permission:manage_roles']);
    Route::delete('roles/{role}', [RoleController::class, 'delete'])
        ->name('role.delete')
        ->middleware(['permission:manage_roles']);
    Route::post('roles/bulk-create', [RoleController::class, 'bulkStore'])
        ->name('role.store.bulk')
        ->middleware(['permission:manage_roles']);
    Route::post('roles/bulk-update', [RoleController::class, 'bulkUpdate'])
        ->name('role.update.bulk')
        ->middleware(['permission:manage_roles']);

    Route::get('permissions', [PermissionController::class, 'index'])
        ->name('permission.index')
        ->middleware(['permission:manage_roles']);
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])
        ->name('permission.show')
        ->middleware(['permission:manage_roles']);

    Route::post('users/assign-role', [UserRoleController::class, 'assignRole'])
        ->name('users.role.assign')
        ->middleware(['permission:manage_roles']);
    Route::get('users/{user}/roles', [UserRoleController::class, 'getAssignedRoles'])
        ->name('get.assigned.roles')
        ->middleware(['permission:manage_roles']);
    Route::put('users/{user}/update-role', [UserRoleController::class, 'updateUserRole'])
        ->name('users.role.update')
        ->middleware(['permission:manage_roles']);
    Route::post('users/bulk-assign-role', [UserRoleController::class, 'bulkAssignRole'])
        ->name('users.bulk.assign.roles')
        ->middleware(['permission:manage_roles']);

    Route::get('activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');
});

Route::get('users', [UserController::class, 'index'])
    ->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])
    ->name('user.show');
Route::post('users', [UserController::class, 'store'])
    ->name('user.store');
Route::put('users/{user}', [UserController::class, 'update'])
    ->name('user.update');
Route::delete('users/{user}', [UserController::class, 'delete'])
    ->name('user.delete');
Route::post('users/bulk-create', [UserController::class, 'bulkStore'])
    ->name('user.store.bulk');
Route::post('users/bulk-update', [UserController::class, 'bulkUpdate'])
    ->name('user.update.bulk');

Route::post('file-upload', [FileUploadController::class, 'upload'])
    ->name('file.upload');

Route::post('push-notifications/add-device-id', [PushNotificationController::class, 'store'])
    ->name('pushNotification.add-device');
Route::post('push-notifications/remove-device-id', [PushNotificationController::class, 'removeDeviceId'])
    ->name('pushNotification.remove-device');

Route::post('register', [AuthController::class, 'register'])
    ->name('register');
Route::post('login', [AuthController::class, 'login'])
    ->name('login');
Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:sanctum');
Route::put('change-password', [AuthController::class, 'changePassword'])
    ->name('change.password')
    ->middleware(['auth:sanctum', 'validate.user']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');
Route::post('validate-otp', [AuthController::class, 'validateResetPasswordOtp'])
    ->name('reset.password.validate.otp');
Route::put('reset-password', [AuthController::class, 'resetPassword'])
    ->name('reset.password');
