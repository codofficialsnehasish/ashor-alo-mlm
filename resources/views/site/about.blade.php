@include("site/partials/head")

<body>

 
    <!--header section start-->
    @include("site/partials/header") 
    <!--header section end-->

    <div class="main">

        <!--hero section start-->
        <section class="" style="background: url('{{ asset('site_assets/img/slider-img-4.jpg') }}')no-repeat center center / cover">
            <div class="section-lg bg-gradient-primary text-white section-header">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-7">
                            <div class="page-header-content text-center">
                                <h1>About Us</h1>
                                <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                                    <ol class="breadcrumb breadcrumb-transparent breadcrumb-text-light">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                                        <!-- <li class="breadcrumb-item active" aria-current="page">Contact US</li> -->
                                    </ol>
                                </nav>
                            </div>
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
                            <!-- <a href="#" class="btn btn-primary  mt-3">View Services</a> -->

                           
                        </div>
                    </div>
                </div>


                <div class="row justify-content-between align-items-center bged">
                    <div class="col-md-12">
                <h2>Why Choose Ashoralo ?</h2>
                <p class="lead">
                    <b>Exceptional Products:</b> We offer a diverse range of high-quality products that are carefully curated to meet the needs and preferences of our customers. From health and wellness supplements to beauty and skincare solutions, our products are designed to enhance lives and inspire confidence.</p>

                    <p class="lead"><b>Lucrative Compensation Plan:</b> Our compensation plan is designed to reward your hard work and dedication. With multiple streams of income, including retail profits, team bonuses, and leadership incentives, you have the opportunity to create a significant and recurring income that grows over time.</p>

                        <p class="lead"><b>Training and Support:</b> At [Your MLM Company Name], we are committed to your success. Our experienced team of mentors and leaders are here to provide you with the training, guidance, and support you need to build a thriving business. Whether you're a seasoned network marketer or just starting out, we'll help you every step of the way.</p>

                            <p class="lead"><b>Community and Camaraderie:</b> Joining [Your MLM Company Name] means becoming part of a supportive community of like-minded individuals who share your passion for success. Connect with fellow entrepreneurs, exchange ideas, and celebrate each other's achievements as you embark on this journey together.</p>

                                <p class="lead"><b>Flexibility and Freedom:</b> One of the greatest benefits of network marketing is the flexibility it offers. With [Your MLM Company Name], you have the freedom to build your business on your own terms, whether you choose to work part-time or pursue it as a full-time career. You're in control of your schedule and your success.</p>
                </p>

            </div></div>
            </div>
        </section>
        <!--about section end-->

   

      

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