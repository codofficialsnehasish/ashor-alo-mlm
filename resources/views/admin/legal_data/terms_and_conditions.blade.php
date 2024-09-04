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
                        <h6 class="page-title">{{$title}}</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <!-- show data -->
            <div class="row">
                <div class="col-12">
                    <!-- Right Sidebar -->
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <form action="{{ route('process-policy')}}"  method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Terms & Conditions</label>
                                        <textarea class="form-control editor" name="trams_and_conditions">{{ $item }}</textarea>
                                    </div>
                                    <div class="btn-toolbar mb-0">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"> <span>Submit</span> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include("admin/dash/footer")