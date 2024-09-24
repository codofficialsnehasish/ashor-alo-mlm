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
                                    <h6 class="page-title">KYC Details</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Kyc Details</li>
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
                        <div class="d-flex justify-content-center mb-3">
                            <button class="btn btn-success">KYC Details of {{ get_name($kyc->user_id) }}</button>
                        </div>
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-light text-center">
                                        Identy Proof
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Proof Type</th>
                                                    <th>Proof</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $kyc->identy_proof_type }}</td>
                                                    <td><img src="{{ asset($kyc->identy_proof) }}" class="img-thumb" style="cursor: pointer;" height="50px" alt=""></td>
                                                    <td>
                                                        <b>Name : {{ $user->name }}</b>
                                                        <select name="identy_proof_status" id="identy_proof_status" class="form-select">
                                                            <option @if($kyc->identy_proof_status == 0) selected @endif value="0">Pending</option>
                                                            <option @if($kyc->identy_proof_status == 1) selected @endif value="1">Completed</option>
                                                            <option @if($kyc->identy_proof_status == 2) selected @endif value="2">Cancelled</option>
                                                        </select>
                                                    </td>
                                                    <td id="identy_remarks">{{ $kyc->identy_proof_remarks }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-light text-center">
                                        Address Proof
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Proof Type</th>
                                                    <th>Proof</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $kyc->address_proof_type }}</td>
                                                    <td><img src="{{ asset($kyc->address_proof) }}" class="img-thumb" style="cursor: pointer;" height="50px" alt=""></td>
                                                    <td>
                                                        <strong>Shipping Address : </strong> {{ $user->shipping_address }}<br>
                                                        <strong>Address : </strong> {{ $user->address }}<br>
                                                        <Strong>Country : </Strong> {{ get_country_name($user->country) }}<br>
                                                        <Strong>State : </Strong> {{ get_state_name($user->state) }}<br>
                                                        <Strong>City : </Strong> {{ get_city_name($user->city) }}<br>
                                                        <Strong>Pin Code : </Strong> {{ $user->pin_code }}
                                                    </td>
                                                    <td>
                                                        <select name="address_proof_status" id="address_proof_status" class="form-select">
                                                            <option @if($kyc->address_proof_status == 0) selected @endif value="0">Pending</option>
                                                            <option @if($kyc->address_proof_status == 1) selected @endif value="1">Completed</option>
                                                            <option @if($kyc->address_proof_status == 2) selected @endif value="2">Cancelled</option>
                                                        </select>
                                                    </td>
                                                    <td id="address_remarks">{{ $kyc->address_proof_remarks }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-light text-center">
                                        Bank A/C Proof
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Proof Type</th>
                                                    <th>Proof</th>
                                                    <th>A/C Details</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $kyc->bank_ac_proof_type }}</td>
                                                    <td><img src="{{ asset($kyc->bank_ac_proof) }}" class="img-thumb" style="cursor: pointer;" height="50px" alt=""></td>
                                                    <td>
                                                        <strong>Account Name : </strong> {{ $user->account_name }}<br>
                                                        <Strong>Bank Name : </Strong> {{ $user->bank_name }}<br>
                                                        <Strong>Account Number : </Strong> {{ $user->account_number }}<br>
                                                        <Strong>Account Type : </Strong> {{ $user->account_type }}<br>
                                                        <Strong>IFSC : </Strong> {{ $user->ifsc_code }}
                                                    </td>
                                                    <td>
                                                        <select name="bank_ac_proof_status" id="bank_ac_proof_status" class="form-select">
                                                            <option @if($kyc->bank_ac_proof_status == 0) selected @endif value="0">Pending</option>
                                                            <option @if($kyc->bank_ac_proof_status == 1) selected @endif value="1">Completed</option>
                                                            <option @if($kyc->bank_ac_proof_status == 2) selected @endif value="2">Cancelled</option>
                                                        </select>
                                                    </td>
                                                    <td id="bank_remarks">{{ $kyc->bank_ac_proof_remarks }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-light text-center">
                                        Pan Card Proof
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Proof</th>
                                                    <th>Pan Number</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="{{ asset($kyc->pan_card_proof) }}" class="img-thumb" style="cursor: pointer;" height="50px" alt=""></td>
                                                    <td>{{ $user->pan_number }}</td>
                                                    <td>
                                                        <select name="pan_card_proof_status" id="pan_card_proof_status" class="form-select">
                                                            <option @if($kyc->pan_card_proof_status == 0) selected @endif value="0">Pending</option>
                                                            <option @if($kyc->pan_card_proof_status == 1) selected @endif value="1">Completed</option>
                                                            <option @if($kyc->pan_card_proof_status == 2) selected @endif value="2">Cancelled</option>
                                                        </select>
                                                    </td>
                                                    <td id="pan_remarks">{{ $kyc->pan_card_proof_remarks }}</td>
                                                </tr>
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
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Remarks</label>
                                            <div>
                                                <textarea required class="form-control" id="remarks" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="submit_remarks" class="btn btn-primary">Submit Remarks</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page-content -->

                @section('script')
                <script>
                    $(document).ready(function() {
                        $('.img-thumb').on('click', function() {
                            var imgSrc = $(this).attr('src');
                            var newWindow = window.open('', '_blank', 'width=800,height=600');
                            newWindow.document.write('<html><head><title>Image</title></head><body style="margin:0;display:flex;justify-content:center;align-items:center;height:100vh;"><img src="' + imgSrc + '" style="max-width:100%;max-height:100%;"></body></html>');
                        });
                    });

                    $('#identy_proof_status').on('change',function(){
                        let id = "{{ request()->segment(3) }}";
                        let status_name = "identy_proof_status";
                        let status = $(this).val();
                        if(status == 2){
                            $('#staticBackdrop').modal('show');
                            $('#staticBackdropLabel').html('Identy Proof Cancelled Remarks');
                            $('#submit_remarks').off('click').on('click',function(){
                                let remarks = $('#remarks').val();
                                $('#remarks').val('');
                                if(remarks != ''){
                                    $('#staticBackdrop').modal('hide');
                                    $('#identy_remarks').html(remarks);
                                    update_kyc_status(id,status_name,status,remarks);
                                }else{
                                    alert('this field is required');
                                }
                            });
                        }else{
                            $('#identy_remarks').html('');
                            update_kyc_status(id,status_name,status);
                        }
                    });

                    $('#address_proof_status').on('change',function(){
                        let id = "{{ request()->segment(3) }}";
                        let status_name = "address_proof_status";
                        let status = $(this).val();
                        if(status == 2){
                            $('#staticBackdrop').modal('show');
                            $('#staticBackdropLabel').html('Address Proof Cancelled Remarks');
                            $('#submit_remarks').off('click').on('click',function(){
                                let remarks = $('#remarks').val();
                                $('#remarks').val('');
                                if(remarks != ''){
                                    $('#staticBackdrop').modal('hide');
                                    $('#address_remarks').html(remarks);
                                    update_kyc_status(id,status_name,status,remarks);
                                }else{
                                    alert('this field is required');
                                }
                            });
                        }else{
                            $('#address_remarks').html('');
                            update_kyc_status(id,status_name,status);
                        }
                    });

                    $('#bank_ac_proof_status').on('change',function(){
                        let id = "{{ request()->segment(3) }}";
                        let status_name = "bank_ac_proof_status";
                        let status = $(this).val();
                        if(status == 2){
                            $('#staticBackdrop').modal('show');
                            $('#staticBackdropLabel').html('Bank A/C Proof Cancelled Remarks');
                            $('#submit_remarks').off('click').on('click',function(){
                                let remarks = $('#remarks').val();
                                $('#remarks').val('');
                                if(remarks != ''){
                                    $('#staticBackdrop').modal('hide');
                                    $('#bank_remarks').html(remarks);
                                    update_kyc_status(id,status_name,status,remarks);
                                }else{
                                    alert('this field is required');
                                }
                            });
                        }else{
                            $('#bank_remarks').html('');
                            update_kyc_status(id,status_name,status);
                        }
                    });

                    $('#pan_card_proof_status').on('change',function(){
                        let id = "{{ request()->segment(3) }}";
                        let status_name = "pan_card_proof_status";
                        let status = $(this).val();
                        if(status == 2){
                            $('#staticBackdrop').modal('show');
                            $('#staticBackdropLabel').html('Pan Card Proof Cancelled Remarks');
                            $('#submit_remarks').off('click').on('click',function(){
                                let remarks = $('#remarks').val();
                                $('#remarks').val('');
                                if(remarks != ''){
                                    $('#staticBackdrop').modal('hide');
                                    $('#pan_remarks').html(remarks);
                                    update_kyc_status(id,status_name,status,remarks);
                                }else{
                                    alert('this field is required');
                                }
                            });
                        }else{
                            $('#pan_remarks').html('');
                            update_kyc_status(id,status_name,status);
                        }
                    });

                    function update_kyc_status(id,status_name,status,remarks=''){
                        $.ajax({
                            url:"{{ route('kyc.update-kyc-status') }}",
                            type:'POST',
                            data:{"id":id,"status_name":status_name,"status":status,"remarks":remarks,"_token":"{{ csrf_token() }}"},
                            success:function(resp){
                                if(resp.status == 1){
                                    showToast('success', 'Success', resp.massage);
                                }else{
                                    showToast('error', 'Error!', resp.massage);
                                }
                            }
                        });
                    }
                </script>
                
                @endsection

                @include("admin.dash.footer")