@include('site.user_dashboard.partials.head')

    <style>
        /*Now the CSS*/

        .tree ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            padding-left: 0px;
        }

        .tree li {
            float: left; text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
            
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*We will use ::before and ::after to draw the connectors*/

        .tree li::before, .tree li::after{
            content: '';
            position: absolute; top: 0; right: 50%;
            border-top: 1px solid #ccc;
            width: 50%; height: 20px;
        }
        .tree li::after{
            right: auto; left: 50%;
            border-left: 1px solid #ccc;
        }

        /*We need to remove left-right connectors from elements without 
        any siblings*/
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }

        /*Remove space from the top of single children*/
        .tree li:only-child{ padding-top: 0;}

        /*Remove left connector from first child and 
        right connector from last child*/
        .tree li:first-child::before, .tree li:last-child::after{
            border: 0 none;
        }
        /*Adding back the vertical connector to the last nodes*/
        .tree li:last-child::before{
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }
        .tree li:first-child::after{
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before{
            content: '';
            position: absolute; top: 0; left: 50%;
            border-left: 1px solid #ccc;
            width: 0; height: 20px;
        }

        .tree li a{
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            /* font-size: 11px; */
            font-size: 20px;
            display: inline-block;
            
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*Time for some hover effects*/
        /*We will apply the hover effect the the lineage of the element also*/
        .tree li a:hover, .tree li a:hover+ul li a {
            background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
        }
        /*Connector styles on hover*/
        .tree li a:hover+ul li::after, 
        .tree li a:hover+ul li::before, 
        .tree li a:hover+ul::before, 
        .tree li a:hover+ul ul::before{
            border-color:  #94a0b4;
        }
    </style> 

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
                    
                    <div class="card-body table-responsive">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Back Button -->
                            <div>
                                <button onclick="history.back()" class="btn btn-outline-success">
                                    <img src="{{ asset('dashboard_assets/images/back.png') }}" width="36px" height="26px" alt=""> Back
                                </button>
                            </div>
                        
                            <!-- Search Form -->
                            <div>
                                <form action="{{ route('business-report.tree') }}" method="get" class="d-flex" id="search-form">
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
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

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

            @include('site.user_dashboard.partials.footer')