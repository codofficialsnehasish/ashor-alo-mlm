<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->
<style>
    .label {
        display: inline-block;
        width: 120px; /* Adjust as needed */
        text-align: right;
        margin-right: 10px; /* Adjust as needed for spacing */
    }

    .value {
        display: inline-block;
        width: 120px; /* Adjust as needed */
        text-align: left;
        margin-left: 10px; /* Adjust as needed for spacing */
    }
</style>

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
                                        <li class="breadcrumb-item active" aria-current="page">All {{ $title }}</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{ route('categories.create') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-wrap">Sl. No.</th>
                                                    <th>Title</th>
                                                    <th>Visiblity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $categorie)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $categorie->name }}</td>
                                                    <td>{!! check_visibility($categorie->visibility) !!}</td>
                                                    <td>
                                                        <a class="btn btn-primary" href="{{ route('categories.edit',$categorie->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are You sure?')" href="{{ route('categories.destroy',$categorie->id) }}"><i class="ti-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end show data -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                @include("admin/dash/footer")