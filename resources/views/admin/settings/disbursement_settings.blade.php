<!-- adding header -->
@include("admin.dash.header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin.dash.left_side_bar")
            <!-- Left Sidebar End -->

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Settings</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Game Settings</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{ url('/process-game-settings') }}" class=" g-3 needs-validation" novalidate>
                                            @csrf
                                            <div class="col-md-4 mb-2">
                                                <label for="validationCustom02" class="form-label">Game Price</label>
                                                <input type="text" class="form-control" name="game_price" id="validationCustom02" placeholder="" value="{{ $game_settings->game_price }}" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername" class="form-label">Agent Commission</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-percent"></i></span>
                                                    <input type="text" class="form-control" id="validationCustomUsername" name="agent_commision" value="{{ $game_settings->agent_commision }}"
                                                        aria-describedby="inputGroupPrepend" required>
                                                    <div class="invalid-feedback">
                                                        Please choose a persentage.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Submit form</button>
                                                <b>Last Updated At - {!! format_datetime($game_settings->updated_at) !!}</b>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- row end -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                @include("admin.dash.footer")