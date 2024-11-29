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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                        </div>
                        {{-- <pre> --}}
                        {{-- {{ print_r($business) }} --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-wrap">Sl. No.</th>
                                            <th class="text-wrap">Name</th>
                                            <th class="text-wrap">Level</th>
                                            <th class="text-wrap">Date</th>
                                            <th class="text-wrap">Amount</th>
                                            <th class="text-wrap">Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $amount = 0 @endphp
                                        @if(!empty($business))
                                        @foreach($business as $item)
                                        @php $amount += $item['total_business']->total_amount @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['name'] }} ({{ $item['user_id'] }}) </td>
                                            <td>{{ 'Level '.$item['level'] }}</td>
                                            <td>{{ formated_date($item['total_business']->start_date,'-') }}</td>
                                            <td>{{ $item['total_business']->total_amount }}</td>
                                            <td>{{ get_products_by_order_id($item['total_business']->order_id) }}</td>
                                            {{-- <td>{{ print_r($item['total_business']) }}</td> --}}
                                            {{-- <td>{{ print_r($item) }}</td> --}}
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total Amount - {{ $amount }}</b></td>
                                            <td></td>
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