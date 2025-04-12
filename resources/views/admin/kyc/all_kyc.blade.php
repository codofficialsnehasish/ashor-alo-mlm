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
                                    <h6 class="page-title">KYC</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Kyc</li>
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
                                                    <th>Sl No</th>
                                                    <th>User Name</th>
                                                    <th>User ID</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kycs as $kyc)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ get_name($kyc->user_id) }}</td>
                                                    <td>{{ get_user_id($kyc->user_id) }}</td>
                                                    <td>
                                                        @if($kyc->is_confirmed == 0) Pending
                                                        @elseif($kyc->is_confirmed == 1) Completed at {{ format_datetime($kyc->confirmed_date) }}
                                                        @else Cancelled @endif
                                                    </td>
                                                    <td>{{ format_datetime($kyc->created_at) }}</td>
                                                    <td>
                                                        <a class="btn btn-info" href="{{ route('kyc.kyc-details',$kyc->id) }}">Details</a>
                                                        @if($kyc->activities->count())
                                                        <button 
                                                            class="btn btn-warning view-history-btn" 
                                                            data-kyc-id="{{ $kyc->id }}" 
                                                            data-user-name="{{ get_name($kyc->user_id) }}" 
                                                            data-url="{{ route('kyc.activity', $kyc->id) }}">
                                                            View Activity
                                                        </button>

                                                        @endif

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

                <div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="activityModalLabel">Change History</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="activityModalContent">
                                <div class="text-center">
                                    <span class="spinner-border"></span> Loading...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @section('script')
                <script>
                    $(document).on('click', '.view-history-btn', function () {
                        let url = $(this).data('url');
                        let userName = $(this).data('user-name');

                        $('#activityModalLabel').text('Change History of - ' + userName + ' KYC');
                        $('#activityModalContent').html('<div class="text-center"><span class="spinner-border"></span> Loading...</div>');

                        // Show modal
                        $('#activityModal').modal('show');

                        // Load data
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function (response) {
                                $('#activityModalContent').html(response);
                            },
                            error: function () {
                                $('#activityModalContent').html('<div class="text-danger">Failed to load activity log.</div>');
                            }
                        });
                    });


                </script>
                @endsection
                
                @include("admin/dash/footer")