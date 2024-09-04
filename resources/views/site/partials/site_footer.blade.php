    <footer class="footer-wrap">
        <div class="footer footer-top section section-md bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <a class="footer-brand mr-lg-5 d-flex" href="{{ url('/') }}">
                            <img src="{{ asset('site_assets/img/logo-white.png') }}" class="mr-3" alt="Footer logo">
                        </a>
                        <p class="my-4">Interactively unleash interactive best practices before technically sound portals.</p>
                        <div class="btn-wrapper mt-4">
                            <button class="btn btn-icon-only btn-pill btn-twitter mr-2 icon icon-xs icon-shape" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="40k Followers">
                                <span aria-hidden="true" class="fab fa-twitter"></span>
                            </button>
                            <button class="btn btn-icon-only btn-pill btn-facebook mr-2 icon icon-xs icon-shape" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="50k Like">
                                <span aria-hidden="true" class="fab fa-facebook-f"></span>
                            </button>
                            <button class="btn btn-icon-only btn-pill btn-youtube mr-2 icon icon-xs icon-shape" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="25k Subscribe">
                                <span aria-hidden="true" class="fab fa-youtube"></span>
                            </button>
                            <button class="btn btn-icon-only btn-pill btn-dribbble icon icon-xs icon-shape" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="2k Project">
                                <span aria-hidden="true" class="fab fa-dribbble"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                        <h5 class="mb-4">Company</h5>
                        <ul class="links-vertical">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('site-products') }}">Products</a></li>
                            <li><a href="{{ route('certificate') }}">Certificate</a></li>
                            <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                        <h5 class="mb-4">Resources</h5>
                        <ul class="links-vertical">
                            <li><a href="{{ route('certificate') }}">Legal / Affiliation</a></li>
                            <li><a href="{{ route('site-terms-and-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="javascript:void(0)">Privacy Policy</a></li>
                            <li><a href="{{ route('photo-gallary') }}">Photo Gallery</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <h5 class="mb-4">Support</h5>
                        <ul class="links-vertical">
                            <li><a href="{{ route('contact_us') }}">Help</a></li>
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/sign-up') }}">Signup</a></li>
                            <li><a href="{{ route('contact_us') }}">Contact Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer py-3 bg-primary text-white border-top border-variant-default">
            <div class="container">
                <div class="row">
                    <div class="col p-3">
                        <div class="d-flex text-center justify-content-center align-items-center">
                            <p class="copyright pb-0 mb-0">
                                <!-- Copyrights © 2024. All rights reserved by <a href="{{ url('/') }}">Ashoralo</a> -->
                                {{ copyright() }}. Crafted with <i class="fas fa-heart text-danger"></i> by <a style="color:blue;opacity:1;" href="https://codeofdolphins.com/"><b>Code of Dolphins</b></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>