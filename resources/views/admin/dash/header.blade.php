<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{$title}} | {{ app_name() }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{description()}}" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ get_icon() }}">
    
        <link href="{{ asset('dashboard_assets/libs/chartist/chartist.min.css') }}" rel="stylesheet">
    
        <!-- Bootstrap Css -->
        <link href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}" id="bootstrap-ssstyle" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dashboard_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dashboard_assets/css/app.min.css') }}" id="app-ddstyle" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{ asset('dashboard_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dashboard_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        
        <!-- Responsive datatable examples -->
        <link href="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('dashboard_assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('dashboard_assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dashboard_assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">

        <!-- Sweet Alert-->
        <link href="{{ asset('dashboard_assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Toast message -->
        <link href="{{ asset('dashboard_assets/libs/toast/toastr.css') }}" rel="stylesheet" type="text/css" />
        <!-- Toast message -->

        <!-- Click Lavel show -->
        <style>

            .n-ppost-name{
                top: 0;
                left: 66%;
                margin-top: 10px;
                width: 460px;
                opacity: 0;
                -webkit-transform: translate3d(0, -15px, 0);
                transform: translate3d(0, -15px, 0);
                -webkit-transition: all 150ms linear;
                -o-transition: all 150ms linear;
                transition: all 150ms linear;
                font-size: 12px;
                font-weight: 500;
                line-height: 1.4;
                visibility: hidden;
                pointer-events: none;
                position: absolute;
                background: #79cf3ed1;
                color: #000;
                padding: 10px;
                z-index: 999999999999;
            }

            .n-ppost:hover + .n-ppost-name {
                opacity: 1;
                visibility: visible;
                -webkit-transform: translate3d(0, 0, 0);
                        transform: translate3d(0, 0, 0);
            }

            .left {
                float: left;
                width: 50%;
            }

            .left .element {
                float: left;
                width: 100%;
                text-align: left;
            }

            .right {
                float: left;
                width: 50%;
            }
            .right .element {
                float: left;
                width: 100%;
                text-align: left;
            }
            .left .element label {
                float: left;
                width: 43%;
            }
            .right .element label {
                float: left;
                width: 43%;
            }

            .n-ppost-name .element {
                text-align: left;
            }
            /*----------------genealogy-scroll----------*/

            .genealogy-scroll::-webkit-scrollbar {
                width: 5px;
                height: 8px;
            }
            .genealogy-scroll::-webkit-scrollbar-track {
                border-radius: 10px;
                background-color: #e4e4e4;
            }
            .genealogy-scroll::-webkit-scrollbar-thumb {
                background: #212121;
                border-radius: 10px;
                transition: 0.5s;
            }
            .genealogy-scroll::-webkit-scrollbar-thumb:hover {
                background: #d5b14c;
                transition: 0.5s;
            }


            /*----------------genealogy-tree----------*/
            .genealogy-body{
                white-space: nowrap;
                overflow-y: visible;
                padding: 50px;
                min-height: 500px;
                padding-top: 10px;
                text-align: center;
            }
            .genealogy-tree{
                display: inline-block;
            }
            .genealogy-tree ul {
                padding-top: 20px; 
                position: relative;
                padding-left: 0px;
                display: flex;
                justify-content: center;
            }
            .genealogy-tree li {
                float: left; text-align: center;
                list-style-type: none;
                position: relative;
                padding: 20px 5px 0 5px;
            }
            .genealogy-tree li::before, .genealogy-tree li::after{
                content: '';
                position: absolute; 
                top: 0; 
                right: 50%;
                border-top: 2px solid #ccc;
                width: 50%; 
                height: 18px;
            }
            .genealogy-tree li::after{
                right: auto; left: 50%;
                border-left: 2px solid #ccc;
            }
            .genealogy-tree li:only-child::after, .genealogy-tree li:only-child::before {
                display: none;
            }
            .genealogy-tree li:only-child{ 
                padding-top: 0;
            }
            .genealogy-tree li:first-child::before, .genealogy-tree li:last-child::after{
                border: 0 none;
            }
            .genealogy-tree li:last-child::before{
                border-right: 2px solid #ccc;
                border-radius: 0 5px 0 0;
                -webkit-border-radius: 0 5px 0 0;
                -moz-border-radius: 0 5px 0 0;
            }
            .genealogy-tree li:first-child::after{
                border-radius: 5px 0 0 0;
                -webkit-border-radius: 5px 0 0 0;
                -moz-border-radius: 5px 0 0 0;
            }
            .genealogy-tree ul ul::before{
                content: '';
                position: absolute; top: 0; left: 50%;
                border-left: 2px solid #ccc;
                width: 0; height: 20px;
            }
            .genealogy-tree li a{
                text-decoration: none;
                color: #666;
                font-family: arial, verdana, tahoma;
                font-size: 11px;
                display: inline-block;
                border-radius: 5px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
            }

            .genealogy-tree li a:hover, 
            .genealogy-tree li a:hover+ul li a {
                background: #c8e4f8;
                color: #000;
            }

            .genealogy-tree li a:hover+ul li::after, 
            .genealogy-tree li a:hover+ul li::before, 
            .genealogy-tree li a:hover+ul::before, 
            .genealogy-tree li a:hover+ul ul::before{
                border-color:  #fbba00;
            }

            /*--------------memeber-card-design----------*/

            .member-view-box{
                /* padding-bottom: 10px; */
                text-align: center;
                /* border-radius: 4px; */
                position: relative;
                /* border: 1px; */
                /* border-color: #e4e4e4; */
                /* border-style: solid; */
            }
            .member-image{
                padding:10px;
                width: 100%;
                position: relative;
            }
            .member-image img{
                width: 100px;
                height: 100px;
                border-radius: 6px;
                background-color :#fff;
                z-index: 1;
            }
            .member-header-active {
                padding: 5px 0;
                text-align: center;
                background: #02a499;
                color: #fff;
                font-size: 14px;
                border-radius: 4px 4px 0 0;
            }
            .member-header-inactive {
                padding: 5px 0;
                text-align: center;
                background: #ec4561;
                color: #fff;
                font-size: 14px;
                border-radius: 4px 4px 0 0;
            }
            .member-footer {
                text-align: center;
            }
            .member-footer div.name {
                color: #000;
                /* font-size: 14px; */
                font-size: 12px;
                text-transform: uppercase;
                margin-bottom: 5px;
            }
            .member-footer div.downline {
                color: #000;
                font-size: 12px;
                font-weight: bold;
                margin-bottom: 5px;
            }
        </style>
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="display:flex;justify-content: center;align-items: center;">
                            <a href="{{ route('dashboard') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <!-- WVS -->
                                    <img src="{{ get_logo() }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <!-- WVS -->
                                    <img src="{{ get_logo() }}" alt="" height="17">
                                </span>
                            </a>

                            <a href="{{ route('dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <!-- WVS -->
                                    <img src="{{ get_logo() }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <!-- <h1>WVS</h1> -->
                                    <img src="{{ get_icon() }}" alt="" height="70" style="padding-top: 5px;">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>

                        <!-- <div class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Create <i class="mdi mdi-chevron-down"></i>
                                    </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="d-flex">
                        <button type="button" onclick="javascript:window.location.href='{{url('/')}}'" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-eye"></i>
                        </button>
                          <!-- App Search-->
                          <!-- <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </form> -->

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <!-- <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button> -->
                            <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>-->
                        </div> 

                        

                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('dashboard_assets/images/users/user-11.jpg') }}"
                                    alt="Header Avatar">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a> -->
                                <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-17 align-middle me-1"></i> My Wallet</a>
                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="mdi mdi-cog font-size-17 align-middle me-1"></i> Settings<span class="badge bg-success ms-auto">11</span></a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-17 align-middle me-1"></i> Lock screen</a> -->
                                <a class="dropdown-item" href="{{url('/changepass')}}"><i class="mdi mdi-lock-plus-outline font-size-17 align-middle me-1"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" id="sa-warning"><i class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</a>
                                <!-- <a href="{{url('/logout')}}" class="btn btn-primary waves-effect waves-light" id="sa-title">Logout</a> -->
                            </div>
                        </div>

                        <!-- <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="mdi mdi-cog-outline"></i>
                            </button>
                        </div> -->
            
                    </div>
                </div>
            </header>