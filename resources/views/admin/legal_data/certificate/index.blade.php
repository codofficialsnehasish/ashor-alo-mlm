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
                            <h6 class="page-title">Order</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('certificate.create') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                            <td class="text-wrap">Date</td>
                                            <th class="text-wrap">Title</th>
                                            <th class="text-wrap">Image</th>
                                            <th class="text-wrap">Visiblity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($certificates as $certificate)
                                        <tr>
                                            <td class="text-wrap">{{ format_datetime($certificate->created_at) }}</td>
                                            <td>{{ $certificate->title }}</td>
                                            <td><img src="{{ asset($certificate->image) }}" width="40px" alt=""></td>
                                            <td>{!! check_visibility($certificate->is_visiable) !!}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('certificate.edit',$certificate->id)}}" alt="edit"><i class="ti-check-box"></i></a>
                                                <form action="{{ route('certificate.destroy', $certificate->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"><i class="ti-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include("admin/dash/footer")