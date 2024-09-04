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
                                <a href="{{ route('roles') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="custom-validation" action="{{ route('role.give-permissions', ['roleId' => $role->id]) }}" method="post">
                            @csrf
                            <div class="">
                                <h4 class="mb-3">Permissions Name</h4>
                                @foreach ($permissions as $item)
                                <div class="form-check form-check-inline">
                                    <input 
                                        class="form-check-input" 
                                        name="permission[]" 
                                        id="" 
                                        type="checkbox" 
                                        value="{{ $item->name}}" 
                                        {{ in_array($item->id, $rolePermissions) ? 'checked': '' }}
                                    />
                                    <label class="form-check-label" for="">{{ $item->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.dash.footer")