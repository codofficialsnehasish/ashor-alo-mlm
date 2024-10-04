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
                        <h6 class="page-title">Remuneration Benefit</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Master Data</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Remuneration Benefit</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('remuneration-benefit.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form class="custom-validation" action="{{ route('remuneration-benefit.update',$item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Add New Lavel
                            </div>
                            <div class="card-body row">
                                <div class="mb-3 col-md-4">
                                    <label for="rank" class="form-label">Rank</label>
                                    <div>
                                        <input data-parsley-type="text" type="text"
                                            class="form-control" id="rank"
                                            placeholder="" name="rank" value="{{ $item->rank }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="target" class="form-label">Target</label>
                                    <div>
                                        <input data-parsley-type="number" type="number"
                                            class="form-control" id="target"
                                            placeholder="" name="target" value="{{ $item->target }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="bonus" class="form-label">Bonus</label>
                                    <div>
                                        <input data-parsley-type="number" type="number"
                                            class="form-control" id="bonus"
                                            placeholder="" name="bonus" value="{{ $item->bonus }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="month_validity" class="form-label">Month Validity</label>
                                    <div>
                                        <input data-parsley-type="number" type="number"
                                            class="form-control" id="month_validity"
                                            placeholder="" name="month_validity" value="{{ $item->month_validity }}" required>
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
                                        <input type="radio" id="customRadioInline1" name="visiblity" class="form-check-input" value="1" {{ check_uncheck($item->visiblity,1) }}>
                                        <label class="form-check-label" for="customRadioInline1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="visiblity" class="form-check-input" value="0" {{ check_uncheck($item->visiblity,0) }}>
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