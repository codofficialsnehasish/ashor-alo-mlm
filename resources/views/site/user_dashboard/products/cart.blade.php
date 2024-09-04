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

                    <section class="h-100 h-custom">
                        <div class="container h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-lg-7">
                                                    <h5 class="mb-3"><a href="{{ route('product') }}" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                                    <hr>

                                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                                        <div>
                                                            <p class="mb-1">Shopping cart</p>
                                                            <p class="mb-0">You have {{ $cart_count }} items in your cart</p>
                                                        </div>
                                                    </div>

                                                    @foreach($cart_items as $cart)
                                                    @php $product = get_product_by_id($cart->product_id) @endphp
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="d-flex flex-row align-items-center">
                                                                    <div class="ms-3">
                                                                        <h5>{{ $product->title }}</h5>
                                                                        <!-- <p class="small mb-0">256GB, Navy Blue</p> -->
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row align-items-center">
                                                                    <div style="width: 20px;">
                                                                        <h5 class="fw-normal mb-0">{{ $cart->quantity}}</h5>
                                                                    </div>
                                                                    <div style="width: 100px;">
                                                                        <h5 class="mb-0">₹ {{ $product->price}}</h5>
                                                                    </div>
                                                                    <a href="{{ route('cart.delete-cart-data',$cart->id) }}" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>

                                                <div class="col-lg-5">

                                                    <div class="card bg-primary text-white rounded-3">
                                                        <div class="card-body">
                                                            
                                                            <h5>Payment Method</h5>
                                                            <h6>Online(Bank)</h6>

                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="text" style="font-size: 20px;padding: 10px 0;color: #000000;">
                                                                        <strong>Account Name - ASHOR ALO</strong><br>
                                                                        <strong class="text-muted">AXIS BANK LTD</strong><br>
                                                                        <strong>A/C No. - 918020016287253</strong><br>
                                                                        <strong>IFSC Code - UTIB0003232</strong>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr class="my-4">

                                                            <div class="d-flex justify-content-between">
                                                                <p class="mb-2">Subtotal</p>
                                                                <p class="mb-2">₹ {{ $cart_total }}</p>
                                                            </div>

                                                            <div class="d-flex justify-content-between">
                                                                <p class="mb-2">Shipping</p>
                                                                <p class="mb-2">₹ 0.00</p>
                                                            </div>

                                                            <div class="d-flex justify-content-between mb-4">
                                                                <p class="mb-2">Total(Incl. taxes)</p>
                                                                <p class="mb-2">₹ {{ $cart_total }}</p>
                                                            </div>
                                                            <div class="input-img">
                                                                <img src="" alt="" id="blash" style="display:none;width: 100%;">
                                                            </div>
                                                            <form action="{{ route('process-checkout') }}" class="needs-validation" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="custom-file mb-3">
                                                                <input type="file" class="custom-file-input" id="inputfile" name="payment_proof" required>
                                                                <label class="custom-file-label validate" for="inputfile">Upload Payment Proof</label>
                                                                <div class="invalid-feedback">Please Upload Payment Proof</div>
                                                            </div>
                                                            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg">
                                                                <div class="d-flex justify-content-between">
                                                                    <span>₹ {{ $cart_total }}</span>
                                                                    <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                                </div>
                                                            </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')