<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\{
    Authentication,
    User_dashboard,      
    User_management,
    Product,
};

use App\Http\Controllers\Member\{
    KycController,
    PayoutController,
    ReportController,
    BusinessReport,
    Documents,
};

use App\Http\Controllers\LocationController;

Route::post('/get-sponsor-name', [Authentication::class, 'get_sponsor_name']);
Route::post('/login', [Authentication::class, 'login_process']);
Route::post('/forget-password', [Authentication::class, 'password_reset_process']);
Route::post('/register', [Authentication::class, 'process_signup']);

Route::get('/get-countries',[LocationController::class, 'get_countries_api']);
Route::get('/get-states/{country_id?}',[LocationController::class, 'get_state_api']);
Route::get('/get-citys/{state_id?}',[LocationController::class, 'get_city_api']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user-dashboard', [User_dashboard::class, 'member_dashboard_api']);

    Route::get('/direct', [User_management::class, 'direct']);
    Route::get('/all-team', [User_management::class, 'all_members']);
    Route::get('/left-members', [User_management::class, 'left_side_members']);
    Route::get('/right-members', [User_management::class, 'right_side_members']);
    Route::get('/tree-view/{q_user_id?}', [User_management::class, 'tree_view_array']);
    Route::get('/level-view', [User_management::class, 'level_view_api']);

    Route::get('/kyc-details', [KycController::class, 'index']);
    Route::post('/upload-kyc-data', [KycController::class, 'upload_kyc_data_api']);

    Route::get('/get-profile', [User_dashboard::class, 'get_profile_api']);
    Route::post('/update-profile-picture', [User_dashboard::class, 'process_update_profile_api']);
    Route::post('/update-profile-details', [User_dashboard::class, 'update_profile_details']);
    Route::post('/update-nominee-details', [User_dashboard::class, 'update_nominee_details']);
    Route::post('/update-bank-details', [User_dashboard::class, 'update_bank_details']);
    Route::post('/process-change-password', [User_dashboard::class, 'process_change_password']);

    Route::get('/payouts', [PayoutController::class, 'all_payouts']);
    Route::get('/payout-details/{id}', [PayoutController::class, 'payout_details']);
    Route::get('/payout-history', [PayoutController::class, 'payout_history']);

    Route::get('/topup-report', [ReportController::class, 'topup_report']);
    Route::get('/remuneration-report', [ReportController::class, 'remuneration_report']);
    

    Route::get('/products',[Product::class, 'index']);
    Route::get('/orders',[Product::class, 'show_all_order']);

    Route::get('/welcome-letter',[Documents::class, 'welcome_letter']);
    Route::get('/id-card',[Documents::class, 'id_card']);

    Route::get('/level-wise',[BusinessReport::class, 'level_wise_api']);
    Route::post('/generate-date-wise-level-report',[BusinessReport::class, 'generate_date_wise_level_report_api']);
    
    Route::get('/tree-wise/{user_id?}',[BusinessReport::class, 'tree_wise_api']);
});
