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
                            <li class="breadcrumb-item active" aria-current="page">MLM Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('process-mlm-settings') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Marketing Settings</div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="validationCustom02" class="form-label">Minimum Purchase Amount</label>
                                <input type="number" class="form-control" name="minimum_parchase_amount" id="validationCustom02" placeholder="" value="{{ $mlm_settings->minimum_purchase_amount }}" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="mb-3">
                                <label for="validationCustomUsername" class="form-label">Agent Direct Bonus</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-percent"></i></span>
                                    <input type="number" class="form-control" id="validationCustomUsername" name="agent_direct_bonus" value="{{ $mlm_settings->agent_direct_bonus }}" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">Please choose a persentage.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Deduction Settings</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="validationCustomUsername" class="form-label">TDS</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-percent"></i></span>
                                    <input type="number" class="form-control" id="validationCustomUsername" name="tds" value="{{ $mlm_settings->tds }}" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">Please choose a persentage.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="validationCustomUsername" class="form-label">Repurchase</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-percent"></i></span>
                                    <input type="number" class="form-control" id="validationCustomUsername" name="repurchase" value="{{ $mlm_settings->repurchase }}" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">Please choose a persentage.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">Submit Changes</button>
                </div>
            </div> <!-- row end -->
            </form>
            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    
    @include("admin.dash.footer")