<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\{
    Authentication,
    User_dashboard,      
    User_management,
};

use App\Http\Controllers\Member\{
    KycController,
};

Route::post('/get-sponsor-name', [Authentication::class, 'get_sponsor_name']);
Route::post('/login', [Authentication::class, 'login_process']);
Route::post('/forget-password', [Authentication::class, 'password_reset_process']);
Route::post('/register', [Authentication::class, 'process_signup']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user-dashboard', [User_dashboard::class, 'member_dashboard_api']);

    Route::get('/direct', [User_management::class, 'direct']);
    Route::get('/all-team', [User_management::class, 'all_members']);
    Route::get('/left-members', [User_management::class, 'left_side_members']);
    Route::get('/right-members', [User_management::class, 'right_side_members']);

    Route::get('/kyc-details', [KycController::class, 'index']);
    Route::post('/upload-kyc-data', [KycController::class, 'upload_kyc_data_api']);
});
