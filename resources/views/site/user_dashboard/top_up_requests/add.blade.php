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
                        <h1 class="h3 mb-0 text-gray-800">Send Top Up Requests</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Please fillup this field for topup requests</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('process.top-up-requests') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="usr">Referance User Name:</label>
                                    <input type="text" class="form-control" id="usr" name="ref_user_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Amount:</label>
                                    <input type="number" class="form-control" id="pwd" name="amount" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <script>
                function get_sponcor_name(){
                    $("#sponsor_name").val("");
                    var sponcor_id = $("#agentid").val();
                    // alert(sponcor_id);
                    $.ajax({
                        url: "{{ url('/get-sponsor-name') }}/"+sponcor_id,
                        type: "GET",
                        data: {},
                        dataType: "json",
                        success: function (response) { 
                            // alert(response);
                            $("#sponsor_name").val(response);
                        }
                    });
                }
            </script>

            @include('site.user_dashboard.partials.footer')