<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Admin\Customers;
use App\Http\Controllers\Admin\Game;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth.apikey')->group(function () {

    //============================ Customer Register And Show ==============================

    Route::post("/addcustomer",[Customers::class,"addcustomer"])->middleware('auth.apikey');
    Route::get("/showcustomer",[Customers::class,"showcustomer"])->middleware('auth.apikey');

    //============================ Customer App Login ==============================

    Route::post("/login",[Customers::class,"login"]);

    //============================ Verify Customer Email & Phone ==============================
    
    Route::post("/verify-customer-email-and-phone",[Customers::class,"verify_email_and_phone_number"]);

    Route::post("/login-with-otp",[Customers::class,"login_with_otp"]);
    Route::post("/verify-login-with-otp",[Customers::class,"verify_login_with_otp"]);
    Route::get("/profile/{id}",[Customers::class,"profile"]);
    Route::post("/update-profile",[Customers::class,"update_profile"]);

    

    Route::get("/get-game-timings",[Game::class,"get_game_timings"]);
    Route::post("/add-game-cart",[Game::class,"add_game_cart"]);

});
