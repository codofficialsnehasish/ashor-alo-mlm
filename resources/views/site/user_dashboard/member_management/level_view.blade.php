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
                        <h1 class="h3 mb-0 text-gray-800">Level View</h1>
                    </div>
                    @php 
                        $customerTree = get_customer_tree(Auth::user()->user_id); 
                        $levels = [];
                        $level_data = build_customer_array($customerTree,$levels);
                    @endphp

                    

                    @php
                    function render_customer_table($customers, $level) {
                        if (empty($customers)) {
                            return '';
                        }

                        $html = '<div class="card shadow mb-4">';
                        $html .= '<div class="card-header py-3">';
                        $html .= '<h6 class="m-0 font-weight-bold text-primary">Level ' . $level . '</h6>';
                        $html .= '</div>';
                        $html .= '<div class="card-body">';
                        $html .= '<div class="table-responsive">';
                        $html .= '<table class="table table-bordered" width="100%" cellspacing="0">';
                        $html .= '<thead>';
                        $html .= '<tr>';
                        $html .= '<th>Reg Date</th>';
                        $html .= '<th>ID</th>';
                        $html .= '<th>Name</th>';
                        $html .= '<th>Position</th>';
                        $html .= '<th>Sponsor ID</th>';
                        $html .= '<th>Status</th>';
                        $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                        foreach ($customers as $customer) {
                            $html .= '<tr>';
                            $html .= '<td>' . $customer['reg_date'] . '</td>';
                            $html .= '<td>' . $customer['user_id'] . '</td>';
                            $html .= '<td>' . $customer['name'] . '</td>';
                            $html .= '<td>' . $customer['position'] . '</td>';
                            $html .= '<td>' . $customer['agent_id'] . '</td>';
                            $html .= '<td>' . $customer['status'] . '</td>';
                            $html .= '</tr>';
                        }

                        $html .= '</tbody>';
                        $html .= '</table>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</div>';

                        return $html;
                    }

                    $maxLevels = 40; 
                    foreach ($levels as $level => $customers) {
                        //echo render_customer_table($customers, substr($level, 5));

                        $currentLevel = substr($level, 5);
                        if ($currentLevel <= $maxLevels) {
                            echo render_customer_table($customers, $currentLevel);
                        }
                    }
                    @endphp

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')