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
                            <h6 class="page-title">Business Report</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Business Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tree Wise</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                
                <!-- show data -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive" style="/*display:flex;justify-content:center;*/">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Back Button -->
                                    <div>
                                        <button onclick="history.back()" class="btn btn-outline-success">
                                            <img src="{{ asset('dashboard_assets/images/back.png') }}" width="36px" height="26px" alt=""> Back
                                        </button>
                                    </div>
                                
                                    <!-- Search Form -->
                                    <div>
                                        <form action="{{ route('report.business-report.tree') }}" method="get" class="d-flex" id="search-form">
                                            <input type="search" id="search-query" class="form-control form-control-sm me-2" placeholder="Search by name or ID" name="query" aria-controls="datatable-buttons" minlength="3" autocomplete="off">
                                            {{-- <input type="submit" class="btn btn-primary" value="Search"> --}}
                                        </form>
                                        
                                        <!-- Suggestions Dropdown -->
                                        <div id="suggestions" class="list-group position-absolute" style="display: none; z-index: 999;"></div>
                                        
                                    </div>
                                </div>
                                
                                <div class="body genealogy-body genealogy-scroll">
                                    <div class="genealogy-tree">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="member-view-box n-ppost">
                                                        <div class="member-header">
                                                            <span></span>
                                                        </div>
                                                        <div class="member-image">
                                                            <img src="{{ !empty($rootUser->user_image) ? asset($rootUser->user_image) : asset('dashboard_assets/images/users/user-14.png') }}" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;border: 3px solid {{ $rootUser && $rootUser->status == 1 ? 'green' : 'red' }};" alt="Member" class="rounded-circle">
                                                        </div>
                                                        <div class="member-footer">
                                                            <div class="name"><span>{{ $rootUser->name }}</span></div>
                                                            <div class="downline"><span>({{ $rootUser->user_id }})</span></div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <ul class="active">
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <div class="member-view-box n-ppost">
                                                                <div class="member-footer">
                                                                    <div class="name"><span>Left Business</span></div>
                                                                    <div class="downline"><span>{{ calculate_left_business($rootUser->id) }}</span></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0) ">
                                                            <div class="member-view-box n-ppost">
                                                                <div class="member-footer">
                                                                    <div class="name"><span>Right Business</span></div>
                                                                    <div class="downline"><span>{{ calculate_right_business($rootUser->id) }}</span></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end show data -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        

        @section('script')
        <script>
            $(document).ready(function() {
                $('#search-query').on('keyup', function() {
                    var query = $(this).val();

                    var suggestionList = $('#suggestions');
                    // suggestionList.empty();
                    suggestionList.html('');
            
                    if(query.length >= 3) {
                        // Send AJAX request to fetch suggestions
                        $.ajax({
                            url: "{{ route('search-customers') }}",
                            method: 'GET',
                            data: { query: query },
                            success: function(data) {
                                suggestionList.html('');
                                var suggestions = data.suggestions;
                                // var suggestionList = $('#suggestions');
                                // suggestionList.empty(); // Clear previous suggestions
            
                                if(suggestions.length > 0) {
                                    suggestionList.show(); // Show suggestions

                                    var uniqueSuggestions = [];
                                    var seenIds = new Set();

                                    $.each(suggestions, function(index, customer) {
                                        if (!seenIds.has(customer.user_id)) {
                                            seenIds.add(customer.user_id);
                                            uniqueSuggestions.push(customer);
                                        }
                                    });
                                    $.each(uniqueSuggestions, function(index, customer) {
                                        var item = $('<a>')
                                            .addClass('list-group-item list-group-item-action')
                                            .attr('href', '#')
                                            .html(customer.name + ' ( ' + customer.user_id + ')')
                                            .on('click', function() {
                                                $('#search-query').val(customer.user_id); // Set input to customer name
                                                $('#search-form').submit(); // Submit the form
                                            });
                                        suggestionList.append(item);
                                    });
                                } else {
                                    // suggestionList.hide(); // Hide suggestions if no results
                                    suggestionList.show(); // Show the suggestion list even if empty
                                    suggestionList.append('<a class="list-group-item">No results found</a>');
                                }
                            },
                            error: function() {
                                // In case of an error in the AJAX request, hide suggestions
                                suggestionList.hide();
                            }
                        });
                    } else {
                        // $('#suggestions').hide(); // Hide suggestions when query length is less than 3
                        suggestionList.show();
                        suggestionList.append('<a class="list-group-item">Please enter at least 3 characters to search</a>');
                    }
                });
            });
        </script>
        @endsection



        @include("admin/dash/footer")