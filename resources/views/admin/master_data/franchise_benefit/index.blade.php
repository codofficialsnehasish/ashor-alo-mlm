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
                                    <h6 class="page-title">Franchise Benefit</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item">Settings</li>
                                        <li class="breadcrumb-item" aria-current="page">Master Data</li>
                                        <li class="breadcrumb-item active" aria-current="page">Franchise Benefit</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{ route('franchise-benefit.create') }}" class="btn btn-primary dropdown-toggle" aria-expanded="false">
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
                                                    <th>Sl No</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Income</th>
                                                    <th>Visiblity</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($contents as $c)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $c->name }}</td>
                                                    <td>{{ $c->amount }}</td>
                                                    <td>{{ $c->income }}</td>
                                                    <td>{!! check_visibility($c->visiblity) !!}</td>
                                                    <td>{!! format_datetime($c->created_at) !!}</td>
                                                    <td>
                                                        <a class="btn btn-primary" href="{{ route('franchise-benefit.edit',$c->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <!-- <a class="btn btn-danger" onclick="return confirm('Are You Sure?')" href="{{ route('lavel-master.delete',$c->id) }}"><i class="ti-trash"></i></a> -->
                                                        <form action="{{ route('franchise-benefit.destroy', $c->id) }}" method="POST" style="display:inline;">
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
                        <!-- end show data -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                @include("admin/dash/footer")