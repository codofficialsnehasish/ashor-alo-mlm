<style>
    .wizard>.actions {
        display:none;
    }
    form#form-horizontal .actions ul li:nth-child(3) {
        display: none !important;  
    }
    /* .form-horizontal .actions ul li:nth-child(3) {
        display: none;  
    } */
</style>
<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin/dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Settings</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="form-horizontal" class="form-horizontal form-wizard-wrapper classcatchadad" action="{{ route('settings.add-contents') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h3>General Settings</h3>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                                <div class="card-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Application Name</label>
                                                                        <div>
                                                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Title" name="application_name" value="{{ $general_settings->application_name }}">
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="mb-3">
                                                                        <label class="form-label">Home Page Title</label>
                                                                        <div>
                                                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Home Page Title" name="homepage_title" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Keywords</label>
                                                                        <div>
                                                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Keywords" name="keywords" value="">
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Site Description</label>
                                                                        <div>
                                                                            <textarea name="site_description" id="" class="form-control" rows="5" placeholder="Site Description">{{ $general_settings->site_description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Copyright</label>
                                                                        <div>
                                                                        <input data-parsley-type="text" type="text" class="form-control" required placeholder="Copyright" name="copyright" value="{{ $general_settings->copyright }}">
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="mb-0">
                                                                        <div>
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Save Changes</button>
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                                <div class="card-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Logo</label>
                                                                        <div>
                                                                            <div class="mb-0">
                                                                                <img class="img-thumbnail rounded me-2" id="blahlogo" alt="" width="200" src="{{ asset('site_data_images')}}/{{$general_settings->logo}}" data-holder-rendered="true" >
                                                                            </div>
                                                                            <div class="mb-3 mt-3">
                                                                                <input type="file" name="logo" class="filestyle" id="imgInplogo" data-input="false" data-buttonname="btn-secondary">
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Favicon (16x16)</label>
                                                                        <div class="mb-0">
                                                                            <img class="img-thumbnail rounded me-2" id="blahFav" alt="" width="50" src="{{ asset('site_data_images')}}/{{$general_settings->fabicon}}" data-holder-rendered="true" >
                                                                        </div>
                                                                        <div class="mb-3 mt-3">
                                                                            <input type="file" name="favicon" class="filestyle" id="imgInpfav" data-input="false" data-buttonname="btn-secondary">
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="mb-0">
                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                                        Save Changes
                                                                        </button>
                                                                    </div>
                                                                </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3>Contact Details</h3>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtFirstNameShipping" class="col-lg-3 col-form-label">Phone</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtFirstNameShipping" data-parsley-type="digits" value="{{ $general_settings->contact_phone }}" name="phone" type="text" class="form-control" required placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtLastNameShipping" class="col-lg-3 col-form-label">Phone (Optional)</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtLastNameShipping" data-parsley-type="digits" value="{{ $general_settings->contact_phone_opt }}"  name="phoneopt" type="text" class="form-control" required placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtCompanyShipping" class="col-lg-3 col-form-label">Email</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtCompanyShipping" type="email" class="form-control" value="{{ $general_settings->contact_email }}"  name="email" required parsley-type="email" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-3">
                                                            <label for="txtEmailAddressShipping" class="col-lg-3 col-form-label">Email (Optional)</label>
                                                            <div class="col-lg-9">
                                                                <input id="txtEmailAddressShipping" type="email" class="form-control" value="{{ $general_settings->contact_email_opt }}"  name="emailopt" required parsley-type="email" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-12">
                                                        <label class="form-label">Address</label>
                                                        <div>
                                                            <textarea required class="form-control" name="address" rows="5"> {{ $general_settings->contact_address }} </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="endbtn" style="position: relative;display: block;text-align: right;width: 100%;">
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row end -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <script>
                    document.getElementById("#finish").addEventListener("click", function () {
                        alert("ok");
                        form.submit();
                    });
                </script>

                
                @include("admin/dash/footer")