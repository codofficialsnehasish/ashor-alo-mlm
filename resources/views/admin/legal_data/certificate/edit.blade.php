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
                        <h6 class="page-title">{{ $title }}</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('certificate.index') }}">{{ $title }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('certificate.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form class="custom-validation" action="{{ route('certificate.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Edit {{ $title }}
                            </div>
                            <div class="card-body row">
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Certificate Name</label>
                                    <div>
                                        <input data-parsley-type="text" type="text" class="form-control" id="rank" placeholder="" name="title" value="{{ $item->title }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Certificate Image
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200" src="{{ asset($item->image) }}" data-holder-rendered="true" style="display: {{ is_have_image($item->image) }};">
                                </div>
                                <div class="mb-0">
                                    <input type="file" name="certificate_image" class="filestyle" id="imgInp" data-input="false" data-buttonname="btn-secondary">
                                </div> 
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Publish
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label mb-3 d-flex">Visiblity</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline1" name="visiblity" class="form-check-input" value="1" {{ check_uncheck($item->is_visiable,1) }}>
                                        <label class="form-check-label" for="customRadioInline1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="visiblity" class="form-check-input" value="0" {{ check_uncheck($item->is_visiable,0) }}>
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