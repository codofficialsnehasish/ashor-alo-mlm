@include("site/partials/head")

<body>

    <!--header section start-->
    @include("site/partials/header") 
    <!--header section end-->

    <div class="main">

        <!--hero section start-->
        <section class="section pt-9 pb-9 section-header text-white gradient-overly-right-color" style="background: url('{{ asset('site_assets/img/hero-bg10.jpg') }}')no-repeat center center / cover">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-slider-content">
                            <!-- <span class="text-uppercase">Business Solutions</span> -->
                            <h1 class="display-2">Ashoralo</h1>
                            <p class="lead">At Ashoralo, we believe in empowering individuals to achieve their dreams through our 
                                innovative approach to network marketing. With our cutting-edge products and proven business model, we're dedicated to helping you build a 
                                lucrative and sustainable income stream while making a positive impact on the lives of others.</p>
                            <a href="{{ url('/login') }}" class="btn btn-secondary mt-4">Get Start Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--hero section end-->

       
        <!--about section start-->
        <section class="section section-lg  ">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-12 col-lg-6 mb-4 mb-md-4 mb-lg-0">
                        <div class="card bg-primary position-relative  shadow-lg fancy-radius p-3">
                            <div class="dot-shape-top position-absolute">
                                <img src="{{ asset('site_assets/img/color-shape.svg') }}" alt="dot" class="img-fluid">
                            </div>
                            <img class="fancy-radius img-fluid" src="{{ asset('site_assets/img/about-us-2.jpg') }}" alt="modern desk">
                            <div class="dot-shape position-absolute bottom-0">
                                <img src="{{ asset('site_assets/img/dot-shape.png') }}" alt="dot">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div class="video-promo-content">
                            <h2>Welcome to Ashoralo - Revolutionizing Your Path to Success  </h2>
                            <p class="lead">In this section, detail the specific market you are targeting. 
                                If it is a sizeable market, you may group your target audience into categories. 
                                You can also take into account the geography of your target market - if the business 
                                is an online endeavor or if it has physical locations. Besides geography, consider the 
                                audience's gender, race, educational level, and other demographic data. In this section, 
                                detail the specific market you are targeting. If it is a sizeable market, you may group 
                                your target audience into categories. You can also take into account the geography of your 
                                target market - if the business is an online endeavor or if it has physical locations. 
                                Besides geography, consider the audience's gender, race, educational level, and other demographic data.</p>
                            <!-- <ul class="list-unstyled tech-feature-list">
                                <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>Creative</strong> Websites Design</li>
                                <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>Accounting</strong> Procedures Guidebook</li>
                                <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>Cost</strong> Accounting Fundamentals</li>
                                <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>SEO</strong> Optimization Services</li>
                            </ul> -->
                            <a target="_blank" href="{{ asset('web_directory/business_plan/Ashor Alo Plan.pdf') }}" class="btn btn-primary  mt-3">View Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--about section end-->

        <!--blog section start-->
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
                        <a href="{{ route('site-products') }}" class="btn btn-primary  mt-3">More Products</a>
                    </div>
                </div>
            </div>
        </section>
        <!--blog section end-->

        <!--testimonial section start-->
        <!-- <section class="section section-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading mb-5 text-center">
                            <h2>What Clients Say About Us</h2>
                            <p class="lead">
                                Rapidiously morph transparent internal or "organic" sources whereas resource sucking
                                e-business innovate compelling internal.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 mb-4 mb-md-4 mb-lg-0">
                        <div class="testimonial-single shadow-sm bg-white rounded-custom p-5">
                            <div class="quotation mb-4">
                                <span class="icon icon-md icon-lg icon-light"><i class="fas fa-quote-left"></i></span>
                            </div>
                            <blockquote class="blockquote">
                                Assertively procrastinate distributed relationships whereas equity invested intellectual capital everything energistically underwhelm proactive.
                            </blockquote>
                            <div class="d-flex justify-content-md-between justify-content-lg-between align-items-center pt-3">
                                <div class="media align-items-center">
                                    <img src="{{ asset('site_assets/img/team/team-4.jpg') }}" alt="team" class="avatar avatar-sm mr-3">
                                    <div class="media-body">
                                        <h6 class="mb-0">Kyan Boards</h6>
                                        <small>CEO, ThemeTags</small>
                                    </div>
                                </div>
                                <div class="client-ratting d-none d-md-block d-lg-block">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                    </ul>
                                    <span class="font-weight-bold small">5.0 <span class="font-weight-lighter">Out of 5</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4 mb-md-4 mb-lg-0">
                        <div class="testimonial-single shadow-sm bg-white rounded-custom p-5">
                            <div class="quotation mb-4">
                                <span class="icon icon-md icon-lg icon-light"><i class="fas fa-quote-left"></i></span>
                            </div>
                            <blockquote class="blockquote">
                                Intrinsicly facilitate functional imperatives without next-generation services. Compellingly revolutionize worldwide users enterprise best practices.
                            </blockquote>
                            <div class="d-flex justify-content-md-between justify-content-lg-between align-items-center pt-3">
                                <div class="media align-items-center">
                                    <img src="{{ asset('site_assets/img/team/team-1.jpg') }}" alt="team" class="avatar avatar-sm mr-3">
                                    <div class="media-body">
                                        <h6 class="mb-0">Pirtle Karol</h6>
                                        <small>Team Leader, ThemeTags</small>
                                    </div>
                                </div>
                                <div class="client-ratting d-none d-md-block d-lg-block">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                                    </ul>
                                    <span class="font-weight-bold small">5.0 <span class="font-weight-lighter">Out of 5</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--testimonial section end-->

        <!--cta section start-->
        <section class="section section-sm py-5 pro_dect">
            <div class="container">
                <div class="row justify-content-around align-items-center">
                    <div class="col-md-7">
                        <div class="subscribe-content">
                            <h3>Consulting Agency for Your Business</h3>
                            <p class="mb-lg-0 mb-md-0">Rapidiously engage fully tested e-commerce with progressive architectures.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="action-btn text-lg-right text-sm-left">
                            <a href="{{ url('/login') }}" class="btn btn-primary">Join With Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--cta section end-->

    </div>
    
    <!--footer section start-->
    @include('site/partials/site_footer')
    <!--footer section end-->

    @include('site/partials/footer')