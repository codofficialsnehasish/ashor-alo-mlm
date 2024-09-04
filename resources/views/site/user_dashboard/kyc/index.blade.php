@include('site.user_dashboard.partials.head')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('site.user_dashboard.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('site.user_dashboard.partials.top_bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }} {!! check_kyc_status(Auth::id()) !!}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kyc.upload-kyc-data') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="identityProof">Choose Identity Proof Type</label>
                                        <select class="form-control" id="identityProof" name="identy_proof_type" required>
                                            <option value="" selected disabled>Choose...</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->identy_proof_type == 'Aadhar_Card') selected @endif value="Aadhar_Card">Aadhar Card</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->identy_proof_type == 'Voter_Card') selected @endif value="Voter_Card">Voter Card</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->identy_proof_type == 'Pan_Card') selected @endif value="Pan_Card">Pan Card</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->identy_proof_type == 'Passport') selected @endif value="Passport">Passport</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->identy_proof_type == 'Driving_Licence') selected @endif value="Driving_Licence">Driving Licence</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addressProof">Choose Address Proof Type</label>
                                        <select class="form-control" id="addressProof" name="address_proof_type" required>
                                            <option value="" selected disabled>Choose...</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->address_proof_type == 'Aadhar_Card') selected @endif value="Aadhar_Card">Aadhar Card</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->address_proof_type == 'Voter_Card') selected @endif value="Voter_Card">Voter Card</option>
                                            <!-- <option @if(is_kyc_exists($kyc) && $kyc->address_proof_type == 'Pan_Card') selected @endif value="Pan_Card">Pan Card</option> -->
                                            <option @if(is_kyc_exists($kyc) && $kyc->address_proof_type == 'Passport') selected @endif value="Passport">Passport</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->address_proof_type == 'Driving_Licence') selected @endif value="Driving_Licence">Driving Licence</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="bankProof">Choose Bank A/C Proof Type</label>
                                        <select class="form-control" name="bank_proof_type" id="bankProof" required>
                                            <option value="" selected disabled>Choose...</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->bank_ac_proof_type == 'Passbook') selected @endif value="Passbook">Passbook</option>
                                            <option @if(is_kyc_exists($kyc) && $kyc->bank_ac_proof_type == 'Cheque') selected @endif value="Cheque">Cheque</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="d-flex justify-content-center">
                                            <img src="@if(is_kyc_exists($kyc)) {{ asset($kyc->identy_proof) }} @endif" class="img-thumbnail m-3" id="identityFileShow" alt="@if(is_kyc_exists($kyc)) {{ $kyc->identy_proof_type }} @endif" width="104" height="36" style="display:@if(is_kyc_exists($kyc)){{is_have_image($kyc->identy_proof)}}@else none @endif;"> 
                                            {!! check_identy_proof_status($kyc) !!}
                                        </div>
                                        @if(!is_kyc_exists($kyc) || $kyc->identy_proof_status == 2)
                                        <div class="custom-file identity-file-upload">
                                            <input type="file" class="custom-file-input" name="identityFile" id="identityFile" required>
                                            <label class="custom-file-label" for="identityFile">Bank Proof</label>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-4 mt-3">
                                        <div class="d-flex justify-content-center">
                                            <img src="@if(is_kyc_exists($kyc)){{ asset($kyc->address_proof) }}@endif" class="img-thumbnail m-3" id="addressFileShow" alt="@if(is_kyc_exists($kyc)){{ $kyc->address_proof_type }}@endif" width="104" height="36" style="display:@if(is_kyc_exists($kyc)){{is_have_image($kyc->address_proof)}}@else none @endif;"> 
                                            {!! check_address_proof_status($kyc) !!}
                                        </div>
                                        @if(!is_kyc_exists($kyc) || $kyc->address_proof_status == 2)
                                        <div class="custom-file address-file-upload">
                                            <input type="file" class="custom-file-input" name="addressFile" id="addressFile" required>
                                            <label class="custom-file-label" for="addressFile">Bank Proof</label>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-4 mt-3">
                                        <div class="d-flex justify-content-center">
                                            <img src="@if(is_kyc_exists($kyc)){{ asset($kyc->bank_ac_proof) }}@endif" class="img-thumbnail m-3" id="bankFileShow" alt="@if(is_kyc_exists($kyc)){{ $kyc->bank_ac_proof_type }}@endif" width="104" height="36" style="display:@if(is_kyc_exists($kyc)){{is_have_image($kyc->bank_ac_proof)}}@else none @endif;">
                                            {!! check_bank_proof_status($kyc) !!} 
                                        </div>
                                        @if(!is_kyc_exists($kyc) || $kyc->bank_ac_proof_status == 2)
                                        <div class="custom-file bank-file-upload">
                                            <input type="file" class="custom-file-input" name="bankFile" id="bankFile" required>
                                            <label class="custom-file-label" for="bankFile">Bank Proof</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="d-flex justify-content-center">
                                            <img src="@if(is_kyc_exists($kyc)){{ asset($kyc->pan_card_proof) }}@endif" class="img-thumbnail m-3" id="pancardFileShow" alt="Pan Card" width="104" height="36" style="display:@if(is_kyc_exists($kyc)){{is_have_image($kyc->pan_card_proof)}}@else none @endif;"> 
                                            {!! check_pan_proof_status($kyc) !!}
                                        </div>
                                        @if(!is_kyc_exists($kyc) || $kyc->pan_card_proof_status == 2)
                                        <div class="custom-file pancard-file-upload">
                                            <input type="file" class="custom-file-input" name="panProofFile" id="pancardFile" required>
                                            <label class="custom-file-label" for="customFile">Upload Pan Card Proof</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button class="btn btn-primary" {{ check_kyc_submit_button(Auth::id()) }} type="submit">Submit KYC</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @section('script')
            <script>
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('.custom-file').hide(); // Hide all file inputs initially
                    $('.pancard-file-upload').show();
                    function updateFileUploaders() {
                        var identityValue = $('#identityProof').val();
                        var addressValue = $('#addressProof').val();
                        var bankValue = $('#bankProof').val();

                        if (identityValue) {
                            $('.identity-file-upload').show();
                            $('.identity-file-upload label').text(identityValue.replace('_', ' ') + " Proof");
                        } else {
                            $('.identity-file-upload').hide();
                        }

                        if (addressValue) {
                            $('.address-file-upload').show();
                            $('.address-file-upload label').text(addressValue.replace('_', ' ') + " Proof");
                        } else {
                            $('.address-file-upload').hide();
                        }

                        if (bankValue) {
                            $('.bank-file-upload').show();
                            $('.bank-file-upload label').text(bankValue.replace('_', ' ') + " Proof");
                        } else {
                            $('.bank-file-upload').hide();
                        }
                    }

                    // Run updateFileUploaders on page load
                    updateFileUploaders();

                    // Run updateFileUploaders when a select element changes
                    $('#identityProof').change(updateFileUploaders);
                    $('#addressProof').change(updateFileUploaders);
                    $('#bankProof').change(updateFileUploaders);
                });
            </script>
            <script>
                $('#identityFile').on('change', function() {
                    var input = this;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#identityFileShow').attr('src', e.target.result).css('display', 'block');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });

                $('#addressFile').on('change', function() {
                    var input = this;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#addressFileShow').attr('src', e.target.result).css('display', 'block');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });

                $('#bankFile').on('change', function() {
                    var input = this;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#bankFileShow').attr('src', e.target.result).css('display', 'block');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });

                $('#pancardFile').on('change', function() {
                    var input = this;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#pancardFileShow').attr('src', e.target.result).css('display', 'block');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });
            </script>
            @endsection

            @include('site.user_dashboard.partials.footer')