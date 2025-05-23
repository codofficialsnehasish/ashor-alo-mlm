<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\CornJobs;
use App\Http\Controllers\LocationController;

// Route::get('disburse-product-support',[CornJobs::class,'disburse_product_support']);

Route::get('disburse-roi',[CornJobs::class,'disburse_roi']); //main route for ROI & Direct Bonus

Route::get('forcely-disburse-roi',[CornJobs::class,'forcely_disburse_roi']);

Route::get('process-direct-bonus',[CornJobs::class,'process_direct_bonus']);

Route::get('forcely-process-direct-bonus',[CornJobs::class,'forcely_process_direct_bonus']);

Route::get('level-bonus-in-saturday-to-friday',[CornJobs::class,'level_bonus_in_saturday_to_friday']); //main route for Weekly Level Bonus
Route::get('forcely-level-bonus-in-saturday-to-friday',[CornJobs::class,'forcely_level_bonus_in_saturday_to_friday']);

Route::get('generate-payout-in-saturday-to-friday',[CornJobs::class,'generate_payout_in_saturday_to_friday']); //main route for Weekly Payout Generate
Route::get('forcely-generate-payout',[CornJobs::class,'forcely_generate_payout']);

Route::get('hold-wallet-replace-for-one-time',[CornJobs::class,'hold_wallet_replace_for_one_time']);
Route::get('custom-provide-roi-toa-user',[CornJobs::class,'custom_provide_roi_toa_user']);

Route::get('payout-details-check',[CornJobs::class,'see_payout_details_for_check']);
Route::get('payout-test',[CornJobs::class,'process_to_make_payout_good']);
Route::get('get-user-id-using-id',[CornJobs::class,'get_user_id_using_id']);

Route::post('get-state-list',[LocationController::class,'get_state_list'])->name('get-state-list');
Route::post('get-city-list',[LocationController::class,'get_city_list'])->name('get-city-list');

//============== Admin Routes =================================
use App\Http\Controllers\Admin\{
    Admin,
    UsersController,
    RoleController,
    PermissionController,
    MonthlyReturnMasterController,
    RemunerationBenefitController,
    FranchiseBenefitController,
    AwardMasterController,
    Customers,
    Lavel_master,
    Settings,
    Order,
    Products_controller,
    Categories,
    Top_Up_Requests,
    Product_income,
    Report_Controller,
    AccountSwitchController,
    ContactUsController,
    PhotoGallaryController,
    CertificateController,
    LogActivityController,
};


//============== Site Routes =================================
use App\Http\Controllers\Site\{
    Home,
    About,
    Certificate_Controller,
    Contact_us,
    Authentication,
    User_dashboard,
    User_management,
    Product,
    Cart_Controller,
    Checkout_Controller,
    ProductController,
    Photo_Gallary
};

use App\Http\Controllers\Member\{
    KycController,
    Documents,
    ReportController,
    PayoutController,
    BusinessReport,
};


use Illuminate\Support\Facades\Artisan;

Route::get('/database-backup', function () {
    Artisan::call('backup:run');
    // Artisan::call('backup:daily');
    // return response()->json(['message' => 'Database Backuped successfully']);
dd(Artisan::output());

});

//======================= Site Routes =====================

Route::get("/",[Home::class,"home"])->name('home');
Route::get("/about",[About::class,"about"])->name('about');
Route::get("/certificate",[Certificate_Controller::class,"certificate"])->name('certificate');
Route::get("/photo-gallary",[Photo_Gallary::class,"index"])->name('photo-gallary');
Route::get("/contact-us",[Contact_us::class,"contact_us"])->name('contact_us');
Route::post("/submit-contact-us",[Contact_us::class,"process_contact_us_data"])->name('contact_us.submit');
Route::get("/site-products",[ProductController::class,"index"])->name('site-products');
Route::get("/site-terms-and-conditions",[Home::class,"site_terms_and_conditions"])->name('site-terms-and-conditions');


//======================= Login Routes =====================
Route::get("/login",[Authentication::class,"login"])->name('site-login');
Route::get("/sign-up",[Authentication::class,"signup"]);
Route::get("/site-logout",[Authentication::class,"logout"]);
Route::get("/get-sponsor-name/{sponsorid}",[Authentication::class,"get_sponsor_name"]);
Route::post("/process-signup",[Authentication::class,"process_signup"])->name('process-signup');
Route::post("/login-process",[Authentication::class,"login_process"]);

Route::get("/member-register",[Authentication::class,"member_register"]);

Route::get("/password-reset",[Authentication::class,"password_reset"]);
Route::post("/password-reset-process",[Authentication::class,"password_reset_process"]);
Route::post("/forget-password-process",[Authentication::class,"forget_password_process"]);





Route::get("/invoice/{order_id}",[Order::class,"invoice"])->name('invoice');


Route::get('search-customers',[Customers::class,"search_customers"])->name('search-customers');


//=========================  User Dashboard Routes ==========================
Route::middleware('auth')->group(function () {
    Route::prefix('member-dashboard')->group(function () {

        Route::get("/",[User_dashboard::class,"member_dashboard"])->name('member-dashboard');

        Route::post("/get-total-team-member",[User_dashboard::class,"get_total_team_member"])->name('member-dashboard.get-total-team-member');
        Route::post("/get-total-active-team-member",[User_dashboard::class,"get_total_active_team_member"])->name('member-dashboard.get-total-active-team-member');
        
        Route::post("/get-left-team-member",[User_dashboard::class,"get_left_team_member"])->name('member-dashboard.get-left-team-member');
        Route::post("/get-right-team-member",[User_dashboard::class,"get_right_team_member"])->name('member-dashboard.get-right-team-member');
        Route::post("/get-tree-team-member",[User_dashboard::class,"get_tree_team_member"])->name('member-dashboard.get-tree-team-member');
        Route::post("/get-level-team-member",[User_dashboard::class,"get_level_team_member"])->name('member-dashboard.get-level-team-member');
        Route::post("/get-total-left-business",[User_dashboard::class,"get_total_left_business"])->name('member-dashboard.get-total-left-business');
        Route::post("/get-total-right-business",[User_dashboard::class,"get_total_right_business"])->name('member-dashboard.get-total-right-business');
        Route::post("/get-rank",[User_dashboard::class,"get_rank"])->name('member-dashboard.get-rank');
        Route::post("/get-current-week-business",[User_dashboard::class,"get_current_week_business"])->name('member-dashboard.get-current-week-business');
        
        
        


        


        Route::get("/member-profile",[User_dashboard::class,"member_profile"])->name('member-profile');
        Route::get("/{id}/update-profile",[User_dashboard::class,"update_profile"])->name('member.update-profile');
        Route::post("/process-update-profile",[User_dashboard::class,"process_update_profile"])->name('member.process-update-profile');

        //=========================  User Management Routes ==========================
        Route::get("/member-requests",[User_management::class,"member_requests"]);
        Route::get("/member-requests/approve-in-left/{id}",[User_management::class,"approve_in_left"]);
        Route::get("/member-requests/approve-in-right/{id}",[User_management::class,"approve_in_right"]);
        Route::get("/all-members",[User_management::class,"all_members"]);
        Route::get("/left-side-members",[User_management::class,"left_side_members"]);
        Route::get("/right-side-members",[User_management::class,"right_side_members"]);
        Route::get("/direct",[User_management::class,"direct"]);
        Route::get("/tree-view/{userId?}",[User_management::class,"tree_view"])->name('member.tree-view');
        Route::get("/level-view",[User_management::class,"level_view"]);

        Route::get("/register-member",[User_management::class,"register_member"])->name('register-member');


        Route::get("/add-top-up-requests",[Top_Up_Requests::class,"add_requests"])->name('add.top-up-requests');
        Route::post("/process-top-up-requests",[Top_Up_Requests::class,"process_requests"])->name('process.top-up-requests');
        
        
        
        Route::get("/all-products",[Product::class,"index"])->name('product');
        Route::get("/all-orders",[Product::class,"show_all_order"])->name('member.orders');



        Route::get("/cart",[Cart_Controller::class,"index"])->name('cart');
        Route::post("/add-to-cart",[Cart_Controller::class,"add_to_cart"])->name('cart.add-to-cart');
        Route::get("/fetch-cart-count",[Cart_Controller::class,"fetch_cart_count"])->name('fetchCartCount');
        Route::get("/delete-cart-data/{id}",[Cart_Controller::class,"delete_cart_data"])->name('cart.delete-cart-data');

        Route::post("/process-checkout",[Checkout_Controller::class,"process_checkout"])->name('process-checkout');

        Route::get("/change-password",[User_dashboard::class,"change_password"])->name('member.change-password');
        Route::post("/process-change-password",[User_dashboard::class,"process_change_password"])->name('member.process-change-password');
        Route::post("/update-bank-details",[User_dashboard::class,"update_bank_details"])->name('member.update-bank-details');
        Route::post("/update-nominee-details",[User_dashboard::class,"update_nominee_details"])->name('member.update-nominee-details');
        Route::post("/update-profile-details",[User_dashboard::class,"update_profile_details"])->name('member.update-profile-details');
        

        Route::prefix('kyc')->group(function(){
            Route::get("/",[KycController::class,"index"])->name('kyc.index');
            Route::post("/upload-kyc-data",[KycController::class,"upload_kyc_data"])->name('kyc.upload-kyc-data');
        });

        Route::prefix('my-documents')->group(function(){
            Route::get("/welcome-letter",[Documents::class,"welcome_letter"])->name('my-documents.welcome-letter');
            Route::get("/id-card",[Documents::class,"id_card"])->name('my-documents.id-card');
        });

        Route::prefix('payouts')->group(function () {
            Route::controller(PayoutController::class)->group( function () {
                Route::get('all-payout','all_payouts')->name('payout.all');
                Route::get('/{id}/payout-details','payout_details')->name('payout.payout-details');
                Route::get('/{id}/payout-statement','payout_statement')->name('payout.payout-statement');

                Route::get('payout-history','payout_history')->name('payout.history');
            });
        });

        Route::prefix('reports')->group(function () {
            Route::controller(ReportController::class)->group( function (){
                Route::get("/topup-report","topup_report")->name('userreport.top-report');
                Route::post("/generate-income-report","generate_income_report")->name('report.generate-income-report');

                Route::get("/remuneration-report","remuneration_report")->name('userreport.remuneration-report');
                Route::get("/dilse-plan-report","dilse_plan_report")->name('userreport.dilse-plan-report');
                
            });
        });

        Route::controller(BusinessReport::class)->group( function () {
            Route::get("/level-wise","level_wise")->name('business-report.level');
            Route::post("/level-wise","generate_date_wise_level_report")->name('business-report.generate_date_wise_level_report');
            // Route::get("/level-wise-business-exportPdf/{user_id}/{start_date?}/{end_date?}","level_wise_business_exportPdf")->name('member.business-report.level-wise-business-exportPdf');
            // Route::get("/level-wise-business-exportExcel/{user_id}/{start_date?}/{end_date?}","level_wise_business_exportExcel")->name('member.business-report.level-wise-business-exportExcel');

            Route::get("/tree-wise","tree_wise")->name('business-report.tree');
        });
    });
});

Route::get("/member-dashboard/level-wise-business-exportPdf/{user_id}/{start_date?}/{end_date?}",[BusinessReport::class,"level_wise_business_exportPdf"])->name('member.business-report.level-wise-business-exportPdf');
Route::get("/member-dashboard/level-wise-business-exportExcel/{user_id}/{start_date?}/{end_date?}",[BusinessReport::class,"level_wise_business_exportExcel"])->name('member.business-report.level-wise-business-exportExcel');


Route::get("/web/welcome-letter/{user_id}",[Documents::class,"welcome_letter_app"])->name('my-documents.welcome-letter.app');
Route::get("/web/id-card/{user_id}",[Documents::class,"id_card_app"])->name('my-documents.id-card.app');
Route::get('payout/payout-statement/{id}',[PayoutController::class,'payout_statement_app'])->name('payout.payout-statement.app');







//=============================================================================================================
//=========================== Switch Account =============================
Route::get("{userId}/switch-account",[AccountSwitchController::class,"switch"])->name("switch-account");




//====================== Admin Panel Routes =======================


//======================= Admin Login Routes =====================

Route::get("/admin-login",[Admin::class,"login"])->name("login");
Route::get("/register-user",[Admin::class,"register_user"]);
Route::post("/changep",[Admin::class,"change_pass"]);
Route::post("/checkuser",[Admin::class,"checkuser"]);
Route::get("/logout",[Admin::class,"logout"]);
Route::get("/changepass",[Admin::class,"change_password"]);


Route::middleware('auth.admin')->group(function () {
    
    Route::prefix('admin')->group(function () {



        //======================= Admin Dashboard Routes ======================

        Route::get("/dashboard",[Admin::class,"dashboard"])->name('dashboard');


        //======================= Settings Routes ======================

        Route::controller(Settings::class)->group(function () {
            Route::get("/settings-contents","content")->name('settings-contents');
            Route::post("/add-content","add_content")->name('settings.add-contents');
            Route::get("/mlm-settings","mlm_settings")->name('mlm-settings');
            Route::post("/process-mlm-settings","process_mlm_settings")->name('process-mlm-settings');
        });

        Route::get('terms-and-conditions',[Settings::class,"terms_and_conditions"])->name('terms-and-conditions');
        Route::post('process-policy',[Settings::class,"process_policy"])->name('process-policy');

        //========================= Roles & Permission =======================

        Route::controller(RoleController::class)->group(function () {
            Route::prefix('role')->group(function () {
                Route::get("/",'roles')->name('roles');
                Route::post("/create-role",'create_role')->name('role.create');
                Route::post("{roleId}/update-role",'update_role')->name('role.update');
                Route::put("/{roleId}/destroy-role",'destroy_role')->name('role.destroy');
                Route::get("/{roleId}/add-permission-to-role",'addPermissionToRole')->name('role.addPermissionToRole');
                Route::post("/{roleId}/give-permissions",'givePermissionToRole')->name('role.give-permissions');
            });
        });

        Route::controller(PermissionController::class)->group(function () {
            Route::prefix('permission')->group(function () {
                Route::get("/",'permission')->name('permission');
                Route::post("/create-permission",'create_permission')->name('permission.create');
                Route::post("{permissionId}/update-permission",'update_permission')->name('permission.update');
                Route::put("/{permissionId}/destroy-permission",'destroy_permission')->name('permission.destroy');
            });
        });

        //============================== Master Data Routes ===================
        
        Route::prefix('master-data')->group(function () {
            Route::resource('monthly-return', MonthlyReturnMasterController::class);
            Route::post('monthly-return/get-products-by-category',[MonthlyReturnMasterController::class,'get_products_by_category'])->name('monthly-return.get-products-by-category');
            Route::resource('remuneration-benefit', RemunerationBenefitController::class);
            Route::resource('franchise-benefit', FranchiseBenefitController::class);
            Route::resource('award-reword', AwardMasterController::class);

            //============================ Lavel Master Routes ========================
            Route::prefix('lavel-master')->group(function () {
                Route::get("/",[Lavel_master::class,"index"])->name('lavel-master');
                Route::get("add-new",[Lavel_master::class,"add_new"])->name('lavel-master.add-new');
                Route::post("process",[Lavel_master::class,"process"])->name('lavel-master.process');
                Route::get("edit/{id}",[Lavel_master::class,"edit"])->name('lavel-master.edit');
                Route::post("process-edit",[Lavel_master::class,"process_edit"])->name('lavel-master.update');
                Route::get("delete/{id}",[Lavel_master::class,"delete"])->name('lavel-master.delete');
            });
        });


        //========================= Users Routes =======================

        Route::controller(UsersController::class)->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('/','index')->name('users');
                Route::get('/add-new','add_new')->name('users.add');
                Route::post('/add-new/process','process')->name('users.add.process');
                Route::get('/edit/{id}','edit')->name('users.edit');
                Route::post('/update','update_process')->name('users.update');
                Route::get('/delete/{id}','delete')->name('users.delete');
            });
        });

        //============================ Customer Routes ==============================

        Route::prefix('customer')->group(function () {
            Route::get("/",[Customers::class,"customer"])->name('customer');
            Route::post("/add-customer",[Customers::class,"addcustomer"])->name('customer.add');
            Route::get("/show-customer",[Customers::class,"showcustomer"])->name('customer.show');
            Route::get("/delete-customer/{id}",[Customers::class,"customerdel"])->name('customer.delete');
            Route::get("/reset-customer/{id}",[Customers::class,"reset_profile"])->name('customer.reset');
            Route::get("/edit-customer/{id}",[Customers::class,"edit_customer"])->name('customer.edit');
            Route::post("/update-customer",[Customers::class,"update_customer"])->name('customer.update');
            
            Route::get("/tree-view/{userId?}",[Customers::class,"tree_view"])->name('customer.tree-view');
            Route::post("/get-member-details-on-hover",[Customers::class,"get_member_details_on_hover"])->name('customer.get-member-details-on-hover');
            
            Route::post("/make-id-green",[Customers::class,"make_it_green"])->name('customer.make-id-green');
            
            Route::get("/{id}/block-user",[Customers::class,"block_user"])->name('customer.block');
            
            Route::get("/user-of-leaders",[Customers::class,"user_of_leaders"])->name('customer.user-of-leaders');
            Route::post("/get-user-of-leaders",[Customers::class,"get_users_of_leaders"])->name('customer.get-user-of-leaders');

            Route::get("/exportPdf",[Customers::class,"exportPdf"])->name('customer.exportPdf');
            Route::get("/exportExcel",[Customers::class,"exportExcel"])->name('customer.exportExcel');
        });

        //=========================== KYC Admin Part ========================
        Route::prefix('kyc')->group(function(){
            Route::get("/pendings",[KycController::class,"pending_kycs"])->name('kyc.pendings');
            Route::get("/all",[KycController::class,"all_kycs"])->name('kyc.all');
            Route::get("/cancelled",[KycController::class,"cancelled_kycs"])->name('kyc.cancelled');
            Route::get("/completed",[KycController::class,"completed_kycs"])->name('kyc.completed');
            Route::get("/{id}/kyc-details",[KycController::class,"kyc_details"])->name('kyc.kyc-details');
            Route::post("update-identy-proof-status",[KycController::class,"update_identy_proof_status"])->name('kyc.update-identy-proof-status');
            Route::post("update-address-proof-status",[KycController::class,"update_address_proof_status"])->name('kyc.update-address-proof-status');
            Route::post("update-bank-ac-proof-status",[KycController::class,"update_bank_ac_proof_status"])->name('kyc.update-bank-ac-proof-status');
            Route::post("update-pan-card-proof-status",[KycController::class,"update_pan_card_proof_status"])->name('kyc.update-pan-card-proof-status');

            Route::post("update-kyc-status",[KycController::class,"update_kyc_status"])->name('kyc.update-kyc-status');

            Route::get('/{id}/activity', [KycController::class, 'activity'])->name('kyc.activity');
        });

        //=========================== Top Up Requests ==============================
        
        Route::get("/top-up-requests",[Top_Up_Requests::class,"top_up_requests"])->name('top-up-requests');


        //============================ Product Routes =========================

        Route::prefix('products')->group(function () {
            Route::get("/",[Products_controller::class,"index"])->name('products');
            Route::get("/add-new",[Products_controller::class,"add_new"])->name('products.add-new');
            Route::post("/process",[Products_controller::class,"process"])->name('products.process');
            Route::get("/edit-product/{id}",[Products_controller::class,"edit"])->name('products.edit');
            Route::post("/update-process",[Products_controller::class,"update_process"])->name('products.update-process');
            Route::get("/delete/{id}",[Products_controller::class,"delete"])->name('products.delete');
        });

        //============================ Categories Routes =========================

        Route::prefix('categories')->group(function () {
            Route::get("/",[Categories::class,"index"])->name('categories.index');
            Route::get("/create",[Categories::class,"create"])->name('categories.create');
            Route::post("/store",[Categories::class,"store"])->name('categories.store');
            Route::get("/{id}/edit",[Categories::class,"edit"])->name('categories.edit');
            Route::post("/update",[Categories::class,"update"])->name('categories.update');
            Route::get("/{id}/destroy",[Categories::class,"destroy"])->name('categories.destroy');
        });


        //============================ Order Routes ========================

        Route::prefix('orders')->group(function () {
            Route::get("/",[Order::class,"index"])->name('orders');
            Route::get("/{id}/order-details",[Order::class,"order_details"])->name('orders.order-details');
            Route::get("/add-new/{id?}",[Order::class,"add_new"])->name('orders.add');
            Route::get("/get-product-price",[Order::class,"get_product_price"])->name('get-produc-price');
            Route::post("/process",[Order::class,"process"])->name('orders.process');
            Route::get("/edit/{id}",[Order::class,"edit"])->name('orders.edit');
            Route::post("/update-process",[Order::class,"update_process"])->name('orders.update');
            Route::get("/delete/{id}",[Order::class,"delete"])->name('orders.delete');

            Route::post("/update-payment-status",[Order::class,"update_payment_status"])->name('orders.update-payment-status');
            Route::post("/update-order-status",[Order::class,"update_order_status"])->name('orders.update-order-status');
        });

        //============================ Report Routes ========================

        Route::prefix('reports')->group(function () {
            // Sell Report
            Route::get("/income-report",[Report_Controller::class,"income_report"])->name('report.income-report');
            Route::post("/generate-income-report",[Report_Controller::class,"generate_income_report"])->name('report.generate-income-report');

            Route::get("/investor-return-report",[Report_Controller::class,"investor_return_report"])->name('report.investor-return-report');
            Route::post("/generate-investor-return-report",[Report_Controller::class,"generate_investor_return_report"])->name('report.generate-investor-return-report');

            // Direct Bonus
            Route::get("/direct-bonus-report",[Report_Controller::class,"direct_bonus_report"])->name('report.direct-bonus-report');
            Route::post("/generate-direct-bonus-report",[Report_Controller::class,"generate_direct_bonus_report"])->name('report.generate-direct-bonus-report');
            Route::get("/{userid}/direct-bonus-full-details",[Report_Controller::class,"direct_bonus_full_details"])->name('report.direct-bonus-full-details');
            Route::post("/{userid}/generate-direct-bonus-full-details",[Report_Controller::class,"generate_direct_bonus_full_details"])->name('report.generate-direct-bonus-full-details');
            

            // Level Bonus
            Route::get("/level-bonus-report",[Report_Controller::class,"level_bonus_report"])->name('report.level-bonus-report');
            Route::post("/generate-level-bonus-report",[Report_Controller::class,"generate_level_bonus_report"])->name('report.generate-level-bonus-report');
            Route::get("/{userid}/level-bonus-full-details",[Report_Controller::class,"level_bonus_full_details"])->name('report.level-bonus-full-details');
            Route::post("/{userid}/generate-level-bonus-full-details",[Report_Controller::class,"generate_level_bonus_full_details"])->name('report.generate-level-bonus-full-details');
            

            Route::get("/tds-report",[Report_Controller::class,"tds_report"])->name('report.tds-report');
            Route::post("/generate-tds-report",[Report_Controller::class,"generate_tds_report"])->name('report.generate-tds-report');
            Route::get("/{userid}/tds-deduction-full-details",[Report_Controller::class,"tds_deduction_full_details"])->name('report.tds-deduction-full-details');
            Route::post("/{userid}/generate-tds-deduction-full-details",[Report_Controller::class,"generate_tds_deduction_full_details"])->name('report.generate-tds-deduction-full-details');

            Route::get("/repurchase-report",[Report_Controller::class,"repurchase_report"])->name('report.repurchase-report');
            Route::post("/generate-repurchase-report",[Report_Controller::class,"generate_repurchase_report"])->name('report.generate-repurchase-report');

            // Product Return Report
            Route::get("/product-return-report",[Report_Controller::class,"product_return_report"])->name('report.product-return-report');
            Route::post("/generate-product-return-report",[Report_Controller::class,"generate_product_return_report"])->name('report.generate-product-return-report');
            Route::get("/{userid}/product-return-full-details",[Report_Controller::class,"product_return_full_details"])->name('report.product-return-full-details');
            Route::post("/{userid}/generate-product-return-full-details",[Report_Controller::class,"generate_product_return_full_details"])->name('report.generate-product-return-full-details');

            // ID Activation Report
            Route::get("/id-activation-report",[Report_Controller::class,"id_activation_report"])->name('report.id-activation-report');
            Route::post("/generate-id-activation-report",[Report_Controller::class,"generate_id_activation_report"])->name('report.generate-id-activation-report');

            // Payout Report
            Route::get("/payout-report",[Report_Controller::class,"payout_report"])->name('report.payout-report');
            Route::get("/payout-report-details/{start_date}/{end_date}",[Report_Controller::class,"payout_report_details"])->name('report.payout-report-details');
            Route::get("/payout-export-excel/{start_date?}/{end_date?}",[Report_Controller::class,"payoutExportExcel"])->name('report.payout-export-excel');
            Route::get("/{id}/payout-statement",[Report_Controller::class,"view_payout_statement"])->name('report.view-payout-statement');

            Route::post("/update-paid-unpaid-status",[Report_Controller::class,"update_paid_unpaid_status"])->name('report.update-paid-unpaid-status');

            Route::get("/payout-history",[Report_Controller::class,"payout_history"])->name('report.payout-history');
            Route::get("/payout-history-details/{id}",[Report_Controller::class,"payout_history_details"])->name('report.payout-history-details');

            Route::get("/paid-unpaid-payment-report",[Report_Controller::class,"paid_unpaid_payment_report"])->name('report.paid-unpaid-payment-report');
            Route::post("/generate-paid-unpaid-payment-report",[Report_Controller::class,"generate_paid_unpaid_payment_report"])->name('report.generate-paid-unpaid-payment-report');
            Route::get("/generate-paid-unpaid-payment-report",[Report_Controller::class,"generate_paid_unpaid_payment_report"])->name('report.generate-paid-unpaid-payment-report');

            Route::get("/less-than-two-hundred-commission-repoet",[Report_Controller::class,"less_than_two_hundred_commission_repoet"])->name('report.less-than-two-hundred-commission-repoet');

            // Remuneration Report
            Route::get("/remuneration-report",[Report_Controller::class,"remuneration_report"])->name('report.remuneration-report');
            Route::post("/generate-remuneration-report",[Report_Controller::class,"generate_remuneration_report"])->name('report.generate-remuneration-report');

            // Hold Amount Report
            Route::get("/hold-amount-report",[Report_Controller::class,"hold_amount_report"])->name('report.hold-amount-report');

            // Remuneration Transaction Report
            Route::get("/remuneration-transaction-report",[Report_Controller::class,"remuneration_transaction_report"])->name('report.remuneration-transaction-report');
            Route::post("/generate-remuneration-transaction-report",[Report_Controller::class,"generate_remuneration_transaction_report"])->name('report.generate-remuneration-transaction-report');

            Route::get("/level-wise",[Report_Controller::class,"level_wise"])->name('report.business-report.level');
            Route::post("/level-wise",[Report_Controller::class,"generate_date_wise_level_report"])->name('report.business-report.generate_date_wise_level_report');
            Route::get("/level-wise-business-exportPdf/{user_id}/{start_date?}/{end_date?}/{position?}",[Report_Controller::class,"level_wise_business_exportPdf"])->name('report.business-report.level-wise-business-exportPdf');
            Route::get("/level-wise-business-exportExcel/{user_id}/{start_date?}/{end_date?}/{position?}",[Report_Controller::class,"level_wise_business_exportExcel"])->name('report.business-report.level-wise-business-exportExcel');
            
            Route::get("/tree-wise",[Report_Controller::class,"tree_wise"])->name('report.business-report.tree');
        
            // Dilse Report
            Route::get("/dilse-plan-report",[Report_Controller::class,"dilse_plan_report"])->name('report.dilse-plan-report');
            Route::post("/generate-dilse-plan-report",[Report_Controller::class,"generate_dilse_plan_report"])->name('report.generate-dilse-plan-report');
        
            // Add On Report
            Route::get("/addon-report",[Report_Controller::class,"addon_report"])->name('report.addon-report');
            Route::post("/generate-addon-report",[Report_Controller::class,"generate_addon_report"])->name('report.generate-addon-report');

            // Product Delevery Report
            Route::get("/product-delevery-report",[Report_Controller::class,"product_delevery_report"])->name('report.product-delevery-report');
            Route::get("/generate-product-delevery-report",[Report_Controller::class,"generate_product_delevery_report"])->name('report.generate-product-delevery-report');

            // Export Routes of Product Delevery Report
            Route::get("/export-product-delivery-excel", [Report_Controller::class, "exportExcel"])->name('report.exportExcel');
            Route::get("/export-product-delivery-pdf", [Report_Controller::class, "exportPdf"])->name('report.exportPdf');
        });

        Route::get('/contact-us-massages',[ContactUsController::class,'index'])->name('admin.contact-us');
        Route::get('{id}/delete-contact-us-massages',[ContactUsController::class,'destroy'])->name('admin.contact-us.delete');


        Route::resource('photo-gallary', PhotoGallaryController::class);
        Route::resource('certificate', CertificateController::class);

        Route::get('/activity-report', [LogActivityController::class, 'activityReport'])->name('activity.report');

    });
});






Route::get('/clear-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    
    return 'All caches cleared!';
});

Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link has been created successfully!';
});



//=========================== Corn Job =============================

Route::get("/provide-payment",[Product_income::class,"provide_payment"])->name('provide-payment');