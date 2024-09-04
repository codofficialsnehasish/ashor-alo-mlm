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
                            <div class="card-body table-responsive" style="display:flex;justify-content:center;">
                                {{--<div class="tree">
                                    <ul>
                                        @foreach ($rootUsers as $user)
                                        <li>
                                            <a href="#">{{ $user->name }}</a>
                                            @if ($user->children->count() > 0)
                                                <ul>
                                                    @foreach ($user->children as $child)
                                                        @include('admin.customer.tree-node', ['user' => $child])
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        @foreach ($rootUsers as $user)
                                            @include('admin.customer.tree-node', ['user' => $user])
                                        @endforeach
                                    </ul>
                                </div>--}}
                                <div class="body genealogy-body genealogy-scroll">
                                    <div class="genealogy-tree">
                                        <ul>
                                            @foreach ($rootUsers as $user)
                                                @include('admin.customer.tree-node', ['user' => $user])
                                            @endforeach
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
        
        @include("admin/dash/footer")