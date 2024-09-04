@section('style')
<style>
    .id-card-holder {
		width: 225px;
		padding: 4px;
		margin: 0 auto;
		/* background-color: #1f1f1f; */
		border-radius: 5px;
		position: relative;
		box-shadow: 0px 0px 5px 0px #00000047;
        margin: 5px;
        height: 414px;
	}

	.id-card {	
		background-color: #fff;
		padding: 10px;
		border-radius: 10px;
		text-align: center;
		/* box-shadow: 0 0 1.5px 0px #b9b9b9; */
	}
	.id-card img {
		margin: 0 auto;
	}
	.header img {
		width: 75px;
		margin-top: 15px;
	}
	.photo img {
		width: 120px;
		margin-top: 15px;
		height: 120px;
		border-radius: 100%;
		border: 2px solid #71cf2c;
		margin-bottom: 20px;
	}
	h2 {
		font-size: 14px;
		margin: 5px 0;
		color: black;
	}
	h3 {
		font-size: 12px;
		margin: 2.5px 0;
		font-weight: 300;
		color: black;
	}
	.qr-code img {
		width: 50px;
	}
	p {
		font-size: 5px;
		margin: 2px;
	}

	.id-card-tag{
		width: 0;
		height: 0;
		border-left: 100px solid transparent;
		border-right: 100px solid transparent;
		border-top: 100px solid #d9300f;
		margin: -10px auto -30px auto;
	}

	.id-card-tag:after {
		content: '';
		display: block;
		width: 0;
		height: 0;
		border-left: 50px solid transparent;
		border-right: 50px solid transparent;
		border-top: 100px solid white;
		margin: -10px auto -30px auto;
		position: relative;
		top: -130px;
		left: -50px;
	}

    .id-card h4 {
        font-size: 12px;
        color: black;
    }

    h3.id-back-address {
        padding: 69px 0;
    }
</style>
@endsection

@include('site.user_dashboard.partials.head')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('site.user_dashboard.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('site.user_dashboard.partials.top_bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">ID Card</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ID Card</h6>
                        </div>
                        <div class="card-body">
                        <a id="btn_print" type="button" value="print" class="btn btn-success mt-3 mb-3" onclick="">Print ID Card</a>
                            <div id="printableArea" class="table-responsive">
                                <div class="d-flex align-items-center justify-content-center text-center" id="PrintMe">
                                    {{--<div class="id_card mr-3">
                                        <div class="id_card_header">
                                            <div class="header_left">
                                                <img src="{{ get_logo() }}" alt="">
                                            </div>
                                        </div>
                                        <div class="dr_profile">
                                            <img src="{{!empty(Auth::user()->user_image) ? asset(Auth::user()->user_image) : asset('dashboard_assets/images/users/user-13.jpg')}}" alt="" height="100" width="60">
                                        </div>
                                        <div class="card_information">
                                            <h3 class="dr_name">{{ Auth::user()->name }}</h3>
                                            <h4>ID : <span>{{ Auth::user()->user_id }}</span></h4>
                                            <h6>Mobile : <span>{{ Auth::user()->phone }}</span></h6>
                                            <h6>Address : <span>{{ Auth::user()->address }}</span></h6>
                                        </div>
                                    </div>

                                    <div class="id_card_back_side">
                                        <div class="content_wraper">
                                            <h2>{{ app_name() }}</h2>
                                            <p>{{ get_address() }}</p>
                                            <img src="https://codeofdolphins.com/backup/hospital/assets/images/cards/d89ec4041dc4180be6fdc3ba625b5994.png" alt="">
                                            <h4>Authorized Signature</h4>
                                        </div>
                                    </div>--}}
                                    <div class="id-card-holder">
                                        <div class="id-card">
                                            <div class="header">
                                                <img src="{{ get_logo() }}">
                                            </div>
                                            <div class="photo">
                                                <img src="{{!empty(Auth::user()->user_image) ? asset(Auth::user()->user_image) : asset('dashboard_assets/images/users/user-13.jpg')}}">
                                            </div>
                                            <h2>{{ Auth::user()->name }}</h2>
                                            <!-- <div class="qr-code">
                                                
                                            </div> -->
                                            <h3>ID : {{ Auth::user()->user_id }}</h3>
                                            <h3>Mobile : {{ Auth::user()->phone }}</h3>
                                            <h3>Address: {{ Auth::user()->address }}</h3>
                                            <hr>
                                            <p><strong>{{ app_name() }}</strong><p>
                                            <p>{{ get_address() }}</p>
                                        </div>
                                    </div>
                                    <div class="id-card-holder">
                                        <div class="id-card">
                                            <div class="header">
                                                <img src="{{ get_logo() }}">
                                            </div>
                                            <!-- <div class="qr-code">
                                                
                                            </div> -->
                                            <h3 class="id-back-address">{{ get_address() }}</h3>
                                            <img src="https://codeofdolphins.com/backup/hospital/assets/images/cards/d89ec4041dc4180be6fdc3ba625b5994.png" alt="">
                                            <hr>
                                            <h4>Authorized Signature</h4>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @section('script')
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
            @endsection
            @include('site.user_dashboard.partials.footer')