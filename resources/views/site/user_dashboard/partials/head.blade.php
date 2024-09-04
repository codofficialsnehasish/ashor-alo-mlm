<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/site_data_images') }}/{{ get_icon() }}">

    <title>{{ $title }} | {{ app_name() }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('site_assets/user_dashboard_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('site_assets/user_dashboard_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('site_assets/user_dashboard_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Toast message -->
    <link href="{{ asset('dashboard_assets/libs/toast/toastr.css') }}" rel="stylesheet" type="text/css" />
    <!-- Toast message -->

    <!-- DataTables -->
    <link href="{{ asset('dashboard_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Responsive datatable examples -->
    <link href="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">

    @yield('style')

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
    <!-- Click Lavel show -->

    
</head>

<body id="page-top">