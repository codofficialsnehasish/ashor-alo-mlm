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
                        <h6 class="page-title">Reports</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a onclick="history.back()" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            {{--<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-level-bonus-report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-10">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>--}}

            <!-- show data --> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">Paid / Unpaid</th>
                                        <th class="text-wrap">Name</th>
                                        <th class="text-wrap">ID</th>
                                        <th class="text-wrap">Total Payout Amount</th>
                                        <th class="text-wrap">Account Name (As Per Bank)</th>
                                        <th class="text-wrap">Bank Name</th>
                                        <th class="text-wrap">Account Number</th>
                                        <th class="text-wrap">IFSC</th>
                                        <th class="text-wrap">Account Type</th>
                                        <th class="text-wrap">UPI Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $amount = 0 @endphp
                                    @foreach($items as $item)
                                    @php $amount += $item->total_payout @endphp
                                    @php $user = get_user_details($item->user_id) @endphp
                                    <tr>
                                        <td><input type="checkbox" class="status-toggle" id="" data-item-id="{{ $item->id }}" {{ $item->paid_unpaid == 1 ? 'checked' : '' }}></td>
                                        <td class="text-wrap"><a href="{{ route('report.view-payout-statement',$item->id) }}">{{ get_name($item->user_id) }}</a></td>
                                        <td class="text-wrap">{{ get_user_id($item->user_id) }}</td>
                                        <td class="text-wrap">{{ $item->total_payout }}</td>
                                        <td class="text-wrap">{{ $user->account_name }}</td>
                                        <td class="text-wrap">{{ $user->bank_name }}</td>
                                        <td class="text-wrap">{{ $user->account_number }}</td>
                                        <td class="text-wrap">{{ $user->ifsc_code }}</td>
                                        <td class="text-wrap">{{ $user->account_type }}</td>
                                        <td>
                                            <Strong>UPI Type : </Strong> {{ $user->upi_type }}<br>
                                            <Strong>UPI Number : </Strong> {{ $user->upi_number }}<br>
                                            <Strong>UPI Name : </Strong> {{ $user->upi_name }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Amount - {{ $amount }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="statusModalForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Update Payment Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="modalItemId" name="item_id">
                                <div class="form-group mb-3">
                                    <label for="paymentDate" class="form-label">Payment Date</label>
                                    <input type="date" class="form-control" id="paymentDate" name="payment_date" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="paymentMode" class="form-label">Payment Mode</label>
                                    <select class="form-control" id="paymentMode" name="payment_mode" required>
                                        <option value="Cash">Cash</option>
                                        <option value="NEFT">NEFT</option>
                                        <option value="UPI">UPI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- end show data -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @section('script')
        <script>
            // $(document).on('change', '.status-toggle', function() {
            //     let itemId = $(this).data('item-id');
            //     let isChecked = $(this).is(':checked') ? 1 : 0;

            //     $.ajax({
            //         url: "{{ route('report.update-paid-unpaid-status') }}",
            //         method: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             item_id: itemId,
            //             status: isChecked
            //         },
            //         success: function(response) {
            //             showToast('success', 'Success', response.message);
            //         },
            //         error: function() {
            //             showToast('error', 'Error', 'Error updating status');
            //         }
            //     });
            // });


            $(document).on('change', '.status-toggle', function () {
                let itemId = $(this).data('item-id');
                let isChecked = $(this).is(':checked') ? 1 : 0;

                if (isChecked) {
                    // Open the modal form
                    $('#statusModal').modal('show');

                    // Set the item ID in the modal for reference
                    $('#modalItemId').val(itemId);
                } else {
                    // Handle unchecked state if needed
                    $.ajax({
                        url: "{{ route('report.update-paid-unpaid-status') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            item_id: itemId,
                            status: isChecked
                        },
                        success: function (response) {
                            showToast('success', 'Success', response.message);
                        },
                        error: function () {
                            showToast('error', 'Error', 'Error updating status');
                        }
                    });
                }
            });

            // Submit the modal form
            $('#statusModalForm').on('submit', function (e) {
                e.preventDefault();

                let itemId = $('#modalItemId').val();
                let status = 1; // Status is always '1' when the modal is submitted
                let date = $('#paymentDate').val();
                let paymentMode = $('#paymentMode').val();

                $.ajax({
                    url: "{{ route('report.update-paid-unpaid-status') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        item_id: itemId,
                        status: status,
                        date: date,
                        payment_mode: paymentMode
                    },
                    success: function (response) {
                        $('#statusModal').modal('hide');
                        showToast('success', 'Success', response.message);
                    },
                    error: function () {
                        showToast('error', 'Error', 'Error updating status');
                    }
                });
            });

        </script>
    @endsection

    @include("admin.dash.footer")