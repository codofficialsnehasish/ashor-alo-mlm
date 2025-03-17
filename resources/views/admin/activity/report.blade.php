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

            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <h2 class="mb-4">Activity Log Report</h2>
                    
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('activity.report') }}" class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="user_id" class="form-label">User</label>
                                <select name="user_id" id="user_id" class="form-select">
                                    <option value="">All Users</option>
                                    @foreach($users as $id => $name)
                                        <option value="{{ $id }}" {{ request('user_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                    
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                    
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </form>
                    
                        <!-- Activity Log Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Log Name</th>
                                        <th>Description</th>
                                        <th>User</th>
                                        <th>Properties</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activities as $activity)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $activity->log_name }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->causer ? $activity->causer->name : 'System' }}</td>
                                            <td><pre>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre></td>
                                            <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No activity found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">
                                    Showing {{ $activities->firstItem() }} to {{ $activities->lastItem() }} of {{ $activities->total() }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate">
                                    <!-- Laravel pagination links -->
                                    {{ $activities->links('vendor.pagination.custom-pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    @include("admin/dash/footer")