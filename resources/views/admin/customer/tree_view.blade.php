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
                            <h6 class="page-title">Tree View</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tree View</li>
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
                                {{-- <div class="text-end">
                                    <button onclick="history.back()" class="btn btn-outline-success">
                                        <img src="{{ asset('dashboard_assets/images/back.png') }}" width="36px" height="26px" alt="">Back
                                    </button>
                                </div> --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Search Form -->
                                    <div>
                                        <form action="{{ route('report.business-report.tree') }}" method="get" class="d-flex" id="search-form">
                                            <input type="search" id="search-query" class="form-control form-control-sm me-2" placeholder="Search by name or ID" name="query" aria-controls="datatable-buttons" minlength="3" autocomplete="off">
                                            {{-- <input type="submit" class="btn btn-primary" value="Search"> --}}
                                        </form>
                                        
                                        <!-- Suggestions Dropdown -->
                                        <div id="suggestions" class="list-group position-absolute" style="display: none; z-index: 999;"></div>
                                        
                                    </div>

                                    <!-- Back Button -->
                                    <div>
                                        <button onclick="history.back()" class="btn btn-outline-success">
                                            <img src="{{ asset('dashboard_assets/images/back.png') }}" width="36px" height="26px" alt=""> Back
                                        </button>
                                    </div>
                                
                                </div>
                                <div class="body genealogy-body genealogy-scroll">
                                    <div class="genealogy-tree">
                                        <ul id="tree-container">
                                            {!! $html !!}
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
                function MemberDetails(val) {

                    $.ajax({
                        type: "POST",
                        data: { "U_ID": val , _token:"{{ csrf_token() }}"},
                        url: "{{ route('customer.get-member-details-on-hover') }}",
                        success: function (resp) {
                            console.log(resp);
                            $('#u'+val).html(resp);
                        },
                        error: function () {

                        }
                    });
                }
            </script>
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
                                                .attr('href', "{{ route('customer.tree-view', ':id') }}".replace(':id', customer.user_id))
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