@section('style')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f4f7;
        color: #333;
    }
    .container {
        width: 80%;
        max-width: 600px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
        color: #007bff;
        margin-top: 0;
    }
    p {
        line-height: 1.6;
    }
    .footer {
        margin-top: 20px;
        font-size: 0.9em;
        color: #666;
    }
    .footer a {
        color: #007bff;
        text-decoration: none;
    }
</style>
@endsection
@include('site.user_dashboard.partials.head')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Welcome Letter</h6>
                        </div>
                        <div class="card-body">
                            <a id="btn_print" type="button" value="print" class="btn btn-success mt-3 mb-3" onclick="">Print Letter</a>
                            <div id="printableArea" class="table-responsive" style="line-height:1.9;border: 6px solid #979696;padding:20px;border-radius: 15px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ get_logo() }}" height="190px" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <div style="padding: 5px;text-align:right;">
                                            <span style="font-size: 22px;color: blue;font-weight: bold;"><span>{{ app_name() }}</span></span>
                                            <br>
                                            <span style="font-weight: bold;"><span>{{ get_address() }}</span></span>
                                            <br>
                                            <!-- <span style="font-weight: bold;">Phone No &nbsp;:&nbsp;</span><span>03348106029</span>
                                            <span>, Mobile No &nbsp;:&nbsp; </span>
                                            <span>7439763048</span>
                                            <br> -->
                                            <span style="font-weight: bold;">Email ID &nbsp;:&nbsp; </span><a href="#"><span>{{ optional(general_settings())->contact_email ?? '' }}</span></a><br>
                                            <span style="font-weight: bold;">Website &nbsp;:&nbsp; </span><a href="#"><span>https://ashoralo.in/</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3 mb-3">
                                    <h1 class="text-center">Welcome Letter</h1>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Aheartly Welcome To {{ $user->name }}</b>
                                        <p>Dear,Mr./Miss/Mrs./Ms : {{ $user->name }},</p>
                                        <p>ID : {{ $user->user_id }},</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="padding: 5px;text-align:right;">
                                            <b>DATE : {{ formated_date($user->created_at) }}</b>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" style="padding:14px;">
                                    <p>It is great pleasure welcome you to {{ app_name() }}</p>
                                    <p>We sincerely believe that you’re joining to this company as an “INDIVIDUAL DISTRIBUTOR” helps and supports the company to reach the sky high goals in no time. We also appreciate your decision and spontaneous action implementing attitude which has always been found to the great people of the world. You have wisely and rightly chosen this company which speaks itself about wittiness and understanding and your trust and confidence in companies policies plans & products, management capability and off course company’s prospective growth. “If you grow definitely the company will and that’s the motto of the company. And the more completely give of yourself, the more completely the company will give back to you”.</p>
                                    <p>We as company promise you that your Belo vent services will surely be looked forward to a step ahead. We are determine that your life package in terms of mental,physical,social and financial must be preserved as a priceless diamond and that will be our good will for you. Last but not least, we once again welcome you and take you as our one of the best prospective “DISTRIBUTOR” with wide open sky opportunities. “With Best Wishes fly high with us as a family member” Thanks and regards.</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script src="{{ asset('site_assets/user_dashboard_assets/vendor/jquery/jquery.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('#btn_print').click(function() {
                        var printContents = $('#printableArea').html();
                        var originalContents = $('body').html();

                        $('body').html(printContents);
                        window.print();
                        $('body').html(originalContents);
                    });
                });
            </script>