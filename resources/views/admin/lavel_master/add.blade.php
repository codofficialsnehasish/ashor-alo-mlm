<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin/dash/left_side_bar")
            <!-- Left Sidebar End -->     

<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Lavel Master</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('lavel-master') }}">Lavel Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add new Lavel</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <a href="{{ route('lavel-master') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form class="custom-validation" action="{{ route('lavel-master.process') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            Add New Lavel
                        </div>
                        <div class="card-body row">
                            <div class="mb-3 col-md-6">
                                <label for="lavel_name" class="form-label">Lavel Name</label>
                                <div>
                                    <input data-parsley-type="text" type="text"
                                        class="form-control" required id="lavel_name"
                                        placeholder="1st" name="lavel_name" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="security_deposite" class="form-label">Lavel Persentage</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    <input type="number" class="form-control" placeholder="0.36" value="" id="security_deposite" aria-describedby="inputGroupPrepend" name="lavel_persentage">
                                    <div class="invalid-feedback">
                                        This field is required
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            Publish
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label mb-3 d-flex">Visiblity</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadioInline1" name="is_visible" class="form-check-input" value="1" checked>
                                    <label class="form-check-label" for="customRadioInline1">Show</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadioInline2" name="is_visible" class="form-check-input" value="0">
                                    <label class="form-check-label" for="customRadioInline2">Hide</label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Save & Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </form>
    </div>
    <!-- container-fluid -->
</div>
</div>

@include("admin/dash/footer")