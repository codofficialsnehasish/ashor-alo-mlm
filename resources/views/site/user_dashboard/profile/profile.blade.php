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

                <section style="background-color: #eee;">
                    <div class="container py-2">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="{{!empty(Auth::user()->user_image) ? asset(Auth::user()->user_image) : asset('dashboard_assets/images/users/user-13.jpg')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 220px;height: 220px;object-fit: contain;">
                                        <div class="d-flex justify-content-center mb-2">
                                            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn @if(Auth::user()->status == 1) btn-success @else btn-danger @endif">@if(Auth::user()->status == 1) Active @else Inactive @endif</button>
                                            <!-- <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button> -->
                                        </div>
                                        <h5 class="my-3">{{ Auth::user()->name }}</h5>
                                        current amount : {{ get_user_current_week_commision(21) }}
                                        <p class="text-muted mb-1">ID - {{ Auth::user()->user_id }}</p>
                                        <p class="text-muted mb-2">Sponsor - {{ Auth::user()->agent_id }}</p>
                                        {{-- <p class="text-muted">Sponsor ID - {{ Auth::user()->agent_id }}</p> --}}
                                        <!-- <div class="d-flex justify-content-center mb-2">
                                            <a href="{{ route('member.update-profile',Auth::id()) }}" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger">Edit Profile</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 py-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ Auth::user()->phone }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Alternate Number</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ Auth::user()->alternate_mobile_number }}</p>
                                            </div>
                                        </div>
                                        <hr> -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')