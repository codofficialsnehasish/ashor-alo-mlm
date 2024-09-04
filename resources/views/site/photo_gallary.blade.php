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
                            <h2>Our Photos</h2>
                         
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                     
                        <div class="portfolio-container" id="MixItUp">
                            @foreach($photos as $photo)
                            <div class="mix portfolio-item branding" data-ref="mixitup-target">
                                <div class="portfolio-wrapper border border-variant-soft rounded bg-soft p-2">
                                    <a href="javascript:void(0)">
                                        <div class="content-overlay"></div>
                                        <img class="img-fluid" src="{{ asset($photo->file_path) }}" alt="portfolio">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                         
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