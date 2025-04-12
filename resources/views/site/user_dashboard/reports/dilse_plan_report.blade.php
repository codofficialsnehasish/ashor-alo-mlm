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
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-wrap">Sl. No.</th>
                                            <th class="text-wrap">Amount</th>
                                            <th class="text-wrap">Total Installment</th>
                                            <th class="text-wrap">Installment Amount per Month</th>
                                            <th class="text-wrap">Paid Installment</th>
                                            <th class="text-wrap">Paid Amount</th>
                                            <th class="text-wrap">Due Paid</th>
                                            <th class="text-wrap">Start Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $user = 0 @endphp
                                        @php $amount = 0 @endphp
                                        @foreach($items as $item)
                                        @php $user++ @endphp
                                        @php $amount += $item->total_amount @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->total_amount }}</td>
                                            <td>{{ $item->total_installment_month }}</td>
                                            <td>{{ $item->installment_amount_per_month }}</td>
                                            <td>{{ $item->month_count }}</td>
                                            <td>{{ $item->total_disbursed_amount }}</td>
                                            <td>{{ abs($item->total_paying_amount - $item->total_disbursed_amount) }}</td>
                                            <td>{{ formated_date($item->start_date) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <tr>
                                                <td></td>
                                                <td><b>Total Amount - {{ $amount }}</b></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')