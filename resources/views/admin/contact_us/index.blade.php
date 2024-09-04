@include("admin/dash/header")
@include("admin/dash/left_side_bar")  

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">{{ $title }}</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All {{ $title }}</li>
                        </ol>
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
                                        <th>Name</th>
                                        <th>Email or Phone</th>
                                        <th>Massage</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name  }}</td>
                                        <td>{{ $contact->email_or_phone  }}</td>
                                        <td class="text-wrap">{{ $contact->massage  }}</td>
                                        <td>
                                            <a class="btn btn-danger" onclick="return confirm('Are You sure?')" href="{{ route('admin.contact-us.delete',$contact->id) }}"><i class="ti-trash"></i></a>
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
    
    @include("admin/dash/footer")