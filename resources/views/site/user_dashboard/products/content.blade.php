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
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                        <a href="{{ route('cart') }}" class="btn btn-success">Go to Cart
                        <span class="badge badge-danger badge-counter" id="CartCount"></span>
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="container-fluid">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-12 col-sm-8 col-md-6 col-lg-4 my-3">
                                <div class="card">
                                    <!-- <img class="card-img" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" alt="Vans"> -->
                                    <!-- <div class="card-img-overlay d-flex justify-content-end">
                                        <a href="#" class="card-link text-danger like">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    </div> -->
                                    <form id="add-to-cart-form{{ $product->id }}" action="">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $product->title }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6>
                                        <p class="card-text">The Vans All-Weather MTE Collection features footwear and apparel designed to withstand the elements whilst still looking cool.</p>
                                        <div class="options d-flex flex-fill">
                                            <!-- <select class="custom-select ml-1">
                                                <option selected>Weight</option>
                                                <option value="1">41</option>
                                                <option value="2">42</option>
                                                <option value="3">43</option>
                                            </select> -->
                                            <input type="number" id="quantity" class="form-control mx-3" name="qty" value="1" min="1" onblur="validateInput()">
                                        </div>
                                        <div class="buy d-flex justify-content-between align-items-center">
                                            <div class="price text-success"><h5 class="mt-4">₹ {{ $product->price }}</h5></div>
                                            <button type="button" id="{{ $product->id }}" onclick="add_to_cart(this.id)" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')