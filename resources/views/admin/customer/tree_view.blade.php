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
                            <h6 class="page-title">Tree View</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tree View</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                
                <!-- show data -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive" style="/*display:flex;justify-content:center;*/">
                                <div class="text-end">
                                    <button onclick="history.back()" class="btn btn-outline-success">
                                        <img src="{{ asset('dashboard_assets/images/back.png') }}" width="36px" height="26px" alt="">Back
                                    </button>
                                </div>
                                <div class="body genealogy-body genealogy-scroll">
                                    <div class="genealogy-tree">
                                        <ul id="tree-container">
                                            {!! $html !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end show data -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
        @include("admin/dash/footer")