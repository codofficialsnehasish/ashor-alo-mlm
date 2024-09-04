<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!--favicon icon-->
   <link rel="shortcut icon" href="{{ get_icon() }}">
   <meta content="{{description()}}" name="description">
   <!--title-->
   <title>{{$title}} | {{ app_name() }}</title>

   <!--build:css-->
   <link rel="stylesheet" href="{{ asset('site_assets/css/main.css') }}">
   <!-- endbuild -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Toast message -->
   <link href="{{ asset('dashboard_assets/libs/toast/toastr.css') }}" rel="stylesheet" type="text/css" />
   <!-- Toast message -->

   <!-- Sweet Alert-->
   <link href="{{ asset('dashboard_assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
</head>