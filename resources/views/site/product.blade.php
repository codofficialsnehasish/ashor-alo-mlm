@include("site/partials/head")

<body>

    <!--header section start-->
    @include("site/partials/header") 
    <!--header section end-->

    <div class="main">
        <section class="" style="background: url('http://127.0.0.1:8000/site_assets/img/slider-img-4.jpg')no-repeat center center / cover">
            <div class="section-lg bg-gradient-primary text-white section-header">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-7">
                            <div class="page-header-content text-center">
                                <h1>Products</h1>
                                <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                                    <ol class="breadcrumb breadcrumb-transparent breadcrumb-text-light">
                                        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000">Home</a></li>
                                        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/about">Products</a></li>
                                        <!-- <li class="breadcrumb-item active" aria-current="page">Contact US</li> -->
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-lg bg-soft pro_dect">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Our Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 mb-4 mb-md-4 mb-lg-0 mb-4" style="margin-bottom:10px !important;">
                        <div class="card bg-white border-variant-soft shadow-soft">

                            <div class="blog-img position-relative">
                                <img src="{{ !empty($product->product_image) ? $product->product_image : asset('site_assets/img/no-image.png')}}" class="card-img-top rounded-top" alt="themetags office">
                            </div>
                            
                            <div class="card-body">
                                
                                <h3 class="h5 card-title mt-3"><a href="#">{{ $product->title }}</a></h3>
                                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                <a href="javascript:void(0)" class="link-with-icon text-default font-small font-weight-bold">MRP<span> : </span> {{ $product->total_price }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    


                    <div class="col-12" style="text-align: center;padding-top: 20px;">

                    <!-- <a href="javascript:void(0)" class="btn btn-primary  mt-3">More Products</a> -->
                   </div>


                </div>
            </div>
        </section>

    </div>

    <!--footer section start-->
    @include('site/partials/site_footer')
    <!--footer section end-->

    @include('site/partials/footer')