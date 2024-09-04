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
                                        <li class="breadcrumb-item"><a href="{{ route('users') }}">{{ $title }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New {{ $title }}</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{ route('users') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                                <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- register -->
                        <div class="account-pages">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New {{ $title }}</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{ route('users.add.process') }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="form-label" for="input-email">Email address::</label>
                                                        <input id="input-email" name="email" class="form-control input-mask" data-inputmask="'alias': 'email'">
                                                        <span class="text-muted">_@_._</span>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="phone">Phone No.</label>
                                                        <div>
                                                            <input data-parsley-type="number" type="text" name="mobile" id="phone" class="form-control" required placeholder="Enter phone number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="pass">Password</label>
                                                        <div>
                                                            <input type="password" name="password" id="pass" class="form-control" required placeholder="Enter Password">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="select-role">Select Role</label>
                                                        <div>
                                                            <select name="roles" id="select-role" class="form-select">
                                                                <option value selected disabled>Choose...</option>
                                                                @foreach($roles as $role)
                                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label mb-3 d-flex">Status</label>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="customRadioInline1" name="status" class="form-check-input" value="1" checked>
                                                            <label class="form-check-label" for="customRadioInline1">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="customRadioInline2" name="status" class="form-check-input" value="0">
                                                            <label class="form-check-label" for="customRadioInline2">Inactive</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 mt-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Customer</button>
                                                            <!-- <button type="reset" class="btn btn-secondary waves-effect">Cancel</button> -->
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
                </div>

                @include("admin/dash/footer")