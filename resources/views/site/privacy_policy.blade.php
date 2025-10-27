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
                                <h1>{{ $title }}</h1>
                                <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                                    <ol class="breadcrumb breadcrumb-transparent breadcrumb-text-light">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('photo-gallary') }}">{{ $title }}</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--hero section end-->

       
        <section class="section section-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>{{ $title }}</h2>
                         
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                     
                        <div class="portfolio-container" id="MixItUp">
                            <h2>Privacy Policy</h2>
                            <p><strong>Effective Date:</strong> 16-10-2025</p>

                            <p>
                                <strong>Ashoralo</strong> (“we,” “our,” “us”) values your privacy and is committed to protecting your personal information. 
                                This Privacy Policy describes how we collect, use, disclose, and safeguard your information when you visit our website, 
                                mobile application, or use our services (collectively, the “Platform”).
                            </p>

                            <h3>1. Information We Collect</h3>
                            <p>We may collect the following types of information:</p>
                            <ul>
                                <li><strong>Personal Information:</strong> Name, email address, phone number, mailing address, payment details, and other identifiable data you provide during registration or transactions.</li>
                                <li><strong>Usage Information:</strong> Data on how you use our Platform, including IP address, browser type, device information, and pages visited.</li>
                                <li><strong>Cookies and Tracking Technologies:</strong> We use cookies and similar tools to enhance your experience and analyze usage trends.</li>
                            </ul>

                            <h3>2. How We Use Your Information</h3>
                            <ul>
                                <li>Provide, manage, and improve our services.</li>
                                <li>Process transactions and send confirmations or updates.</li>
                                <li>Communicate with you about promotions, updates, or customer support.</li>
                                <li>Ensure security, prevent fraud, and comply with legal obligations.</li>
                            </ul>

                            <h3>3. Sharing Your Information</h3>
                            <p>We may share your information with:</p>
                            <ul>
                                <li><strong>Service Providers:</strong> To assist in operating our business (e.g., payment processors, hosting providers).</li>
                                <li><strong>Legal Authorities:</strong> If required by law or to protect our rights.</li>
                                <li><strong>Business Transfers:</strong> In case of a merger, acquisition, or sale of assets.</li>
                            </ul>
                            <p><strong>We do not sell your personal information to third parties.</strong></p>

                            <h3>4. Data Security</h3>
                            <p>We implement appropriate technical and organizational measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>

                            <h3>5. Your Rights</h3>
                            <p>You have the right to:</p>
                            <ul>
                                <li>Access and review your personal data.</li>
                                <li>Request corrections or deletions.</li>
                                <li>Withdraw consent for marketing communications at any time.</li>
                            </ul>
                            <p>To exercise these rights, contact us at <strong>[insert email address]</strong>.</p>

                            <h3>6. Data Retention</h3>
                            <p>We retain personal information only as long as necessary to fulfill the purposes outlined in this policy or as required by law.</p>

                            <h3>7. Children’s Privacy</h3>
                            <p>
                                Our services are not directed to individuals under 18. We do not knowingly collect data from minors. 
                                If you believe a child has provided us with personal data, please contact us immediately.
                            </p>

                            <h3>8. Changes to This Privacy Policy</h3>
                            <p>
                                We may update this Privacy Policy periodically. Any changes will be posted on this page with an updated “Effective Date.”
                            </p>

                            <h3>9. Contact Us</h3>
                            <p>
                                If you have questions or concerns about this Privacy Policy, please contact us at:
                            </p>
                            <ul>
                                <li>📧 <strong>Email:</strong> <a href="mailto:ashoralo.in@gmail.com">ashoralo.in@gmail.com</a></li>
                                <li>🏢 <strong>Address:</strong> Thacker House, 35, Chittaranjan Avenue, 4th Floor, Kolkata 700012, Near 5 No Gate Chandni Metro, West Bengal</li>
                            </ul>

                            <div class="gap"></div>
                            <div class="gap"></div>
                            <div class="gap"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

      

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