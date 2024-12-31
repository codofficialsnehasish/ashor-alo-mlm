<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\{
    Authentication,
    User_dashboard,
    User_management,
};


Route::post('/login', [Authentication::class, 'login_process']);
Route::post('/forget-password', [Authentication::class, 'password_reset_process']);
Route::post('/register', [Authentication::class, 'process_signup']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user-dashboard', [User_dashboard::class, 'member_dashboard_api']);

    Route::get('/direct', [User_management::class, 'direct']);
    Route::get('/all-team', [User_management::class, 'all_members']);
    Route::get('/left-members', [User_management::class, 'left_side_members']);
    Route::get('/right-members', [User_management::class, 'right_side_members']);
});
