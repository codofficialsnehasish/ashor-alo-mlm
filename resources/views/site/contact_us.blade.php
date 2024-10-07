@include("site.partials.head")

<body>

 
    <!--header section start-->
    @include("site.partials.header") 
    <!--header section end-->

    <div class="main">

        <!--page header section start-->
        <section class="" style="background: url('{{ asset('site_assets/img/slider-img-4.jpg') }}')no-repeat center center / cover">
            <div class="section-lg bg-gradient-primary text-white section-header">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-7">
                            <div class="page-header-content text-center">
                                <h1>Contact Us</h1>
                                <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                                    <ol class="breadcrumb breadcrumb-transparent breadcrumb-text-light">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <!-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Pages</a></li> -->
                                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page header section end-->

        <!--contact us section start-->
        <section class="section section-lg">
            <div class="container contact">
                <div class="col-12 pb-3 message-box d-none">
                    <div class="alert alert-danger"></div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="contact-us-form bg-soft rounded p-5">
                            <h4>Ready to get started?</h4>
                            <form action="{{ route('contact_us.submit') }}" method="POST" class="contact-us-form mt-4" novalidate="true">
                                @csrf
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email_or_phone" placeholder="Enter Email or Phone" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" rows="7" cols="25" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-3">
                                        <button type="submit" class="btn btn-secondary disabled" id="btnContactUs" style="pointer-events: all; cursor: pointer;">
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="contact-us-content">
                            <h2>Welcome to Ashoralo - Revolutionizing Your Path to Success</h2>
                            <!-- <p class="lead">Seamlessly deliver pandemic e-services and next-generation initiatives.</p> -->

                            <a href="{{ url('/login') }}" class="btn btn-outline-secondary align-items-center">Join Us<span class="ti-arrow-right pl-2"></span></a>

                            <hr class="my-5">

                            <h5>Contact Us</h5>
                            <address>
                                <!-- Fortuna Tower 23A, NETAJI SUBASH ROAD
                                (ROOM No. 9B ) FLOOR : 08 KOLKATA 700001  -->
                                <!-- Thacker House, 35, Chittaranjan Avenue, 4th Floor, Kolkata 700012, Near 5 No Gate Chandni Metro, West Bengal -->
                                {{ $settings->contact_address }}
                            </address>
                            <br>
                            <!-- <span>Phone: +1234567890123</span> <br> -->
                            <span>Email: <a href="mailto:{{ $settings->contact_email }}" class="link-color">{{ $settings->contact_email }}</a></span>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--contact us section end-->
    </div>

    <!--footer section start-->
    @include('site/partials/site_footer')
    <!--footer section end-->
    
    @include('site.partials.footer')