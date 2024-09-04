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
                        <h6 class="page-title">{{ $title }}</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles') }}">{{ $title }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> 
                                    <i class="fas fa-plus me-2"></i> Add New 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">Name</th>
                                        <th class="text-wrap">Asign Permission to Role</th>
                                        <th class="text-wrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <!-- <a href="{{ route('role.give-permissions', ['roleId' => $role->id]) }}" class="btn btn-outline-success">Asign Permission</a> -->
                                            <a href="{{ route('role.addPermissionToRole', ['roleId' => $role->id]) }}" class="btn btn-outline-success">Asign Permission</a>
                                            <!-- <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop_assign_permission{{ $role->id }}"> 
                                                View & Asign Permission
                                            </button> -->
                                        </td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropedit{{ $role->id }}" style="margin-right: 10px;"> 
                                                <i class="ti-check-box"></i>
                                            </button>
                                            <form action="{{ route('role.destroy', ['roleId' => $role->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
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

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('role.create') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="position-relative">
                                <label for="role-name" class="form-label">Role Name</label>
                                <input type="text" name="name" class="form-control" id="role-name" placeholder="Write Role name here..." required="">
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

            @foreach($roles as $role)
            <div class="modal fade" id="staticBackdropedit{{ $role->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('role.update', ['roleId' => $role->id]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="position-relative">
                                <label for="role-name" class="form-label">Role Name</label>
                                <input type="text" name="name" class="form-control" id="role-name" placeholder="Write role name here..." value="{{ $role->name }}" required="">
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($roles as $role)
            <div class="modal fade" id="staticBackdrop_assign_permission{{ $role->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Role: {{ $role->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('role.give-permissions', ['roleId' => $role->id]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <h4 class="mb-3">Permissions Name</h4>
                            @foreach ($permissions as $item)
                            <div class="form-check form-check-inline">
                                <input 
                                    class="form-check-input" 
                                    name="permission[]" 
                                    id="" 
                                    type="checkbox" 
                                    value="{{ $item->name}}" 
                                    {{-- in_array($item->id, $rolePermissions) ? 'checked': '' --}}
                                />
                                <label class="form-check-label" for="">{{ $item->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include("admin.dash.footer")