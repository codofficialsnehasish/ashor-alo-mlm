    <header class="header position-relative z-9">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark navbar-theme-primary fixed-top headroom">
            <div class="container position-relative">
                <a class="navbar-brand mr-lg-3" href="{{ url('/') }}">
                    <img class="navbar-brand-dark" src="{{ asset('site_assets/img/logo-white.png') }}" alt="menuimage">
                    <img class="navbar-brand-light" src="{{ asset('site_assets/img/logo-color.png') }}" alt="menuimage">
                </a>
                <div class="navbar-collapse collapse" id="navbar-default-primary">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('site_assets/img/logo-color.png') }}" alt="menuimage">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <i class="fas fa-times" data-toggle="collapse" role="button"
                                   data-target="#navbar-default-primary" aria-controls="navbar-default-primary"
                                   aria-expanded="false" aria-label="Toggle navigation"></i>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover ml-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" target="_blank" href="{{ asset('web_directory/business_plan/Ashor Alo Plan.pdf') }}">Business Plan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('site-products') }}">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('certificate') }}">Legal / Affiliation</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('photo-gallary') }}">Photo Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact_us') }}">Contact Us</a></li>
                        @auth
                            @if(auth()->user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Back To Admin Panel</a></li>
                            @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('member-dashboard') }}">Back To Dashboard</a></li>
                            @endif
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/sign-up') }}">Signup</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbar-default-primary" aria-controls="navbar-default-primary" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>