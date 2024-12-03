
<section class="app-footer">
    <footer class="footer-28 py-5">
        <div class="footer-bg-layer">
            <div class="container py-lg-3">
                <div class="row footer-top-28">
                    <div class="col-lg-4 footer-list-28 copy-right mb-lg-0 mb-sm-5 mt-sm-0 mt-4">
                        <a class="navbar-brand mb-3" href="{{ route('main') }}">
                            <span class="fa fa-newspaper-o"></span> Forum </a>
                        <p class="copy-footer-28"> © 2024. All Rights Reserved. </p>
                        <h5 class="mt-2">Design by <a href="https://w3layouts.com/">W3Layouts</a></h5>
                    </div>
                    <div class="col-lg-8 row">
                        <div class="col-sm-4 col-6 footer-list-28">
                            <h6 class="footer-title-28">Useful links</h6>
                            <ul>
                                <li><a href="https://velikoborets-portfolio.ru">Portfolio</a></li>
                                <li><a href="https://kinoklad.velikoborets-portfolio.ru">KinoKlad</a></li>
                                <li><a href="https://t.me/ms_velik">Telegram</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-6 footer-list-28">
                            <h6 class="footer-title-28">Categories</h6>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('topics', ['category' => $category->slug]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-4 col-6 footer-list-28 mt-sm-0 mt-4">
                            <h6 class="footer-title-28">Social Media</h6>
                            <ul class="social-icons">
                                <li class="facebook">
                                    <a href="#facebook"><span class="fa fa-facebook"></span> Facebook</a></li>
                                <li class="linkedin"> <a href="#linkedin"><span class="fa fa-linkedin"></span> Linkedin</a></li>
                                <li class="dribbble"><a href="#dribbble"><span class="fa fa-dribbble"></span> Dribbble</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
</section>
