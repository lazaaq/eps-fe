<!DOCTYPE html>
<html lang="en">

<head>
    <title>RUKO &mdash; Website by technow.id</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" />
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}" />
    <link rel="stylesheet" href="{{asset('fonts/flaticon/font/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('css/landing-page.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" />
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="site-logo mr-auto w-25">
			                <a href="#"><img src="{{asset('img/web_transparent_fit_ruko_logo.png')}}" alt="" style="height:47px"></a>
                    </div>

                    <div class="mx-auto text-center">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                                <li>
                                    <a href="#home-section" class="nav-link" style="color:#004157">Home</a>
                                </li>
                                <li>
                                    <a href="#courses-section" class="nav-link" style="color:#004157">Paket</a>
                                </li>
                                <li>
                                    <a href="#programs-section" class="nav-link" style="color:#004157">Promo</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="ml-auto w-25">
                        <a href="#"
                            class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span
                                class="icon-menu h3"></span></a>
                    </div>
                </div>
            </div>
        </header>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="padding-top:95px">
            <div class="carousel-inner">
                @foreach (\App\Models\Banner::where('isViewWeb','1')->get() as $key => $value)
                <div class="carousel-item {{$key =='0' ? 'active' : ''}}">
                    <a target="_blank" href="{{$value->linkTo}}">
                        <img class="d-block w-100" src="{{config('apiurl.url').'/storage/banner/'.$value->id}}" alt="First slide">
                    </a>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="padding-top:95px">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="padding-top:95px">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="intro-section" id="home-section">
            <div class="slide-1" style="background-image: url('images/hero_1.jpg');" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <h1 data-aos="fade-up" data-aos-delay="100">
                                        SELAMAT DATANG DI RUMAH KOREA
                                    </h1>
                                    <p class="mb-4" data-aos="fade-up" data-aos-delay="200">
                                        Ini Adalah Tes Kemampuan untuk Tes Ujian EPS-TOPIK Berbasis Computer Base Test [CBT] Untuk Para Calon Pekerja Migran Indonesia [CPMI] Yang Ingin Bekerja Di Korea Selatan.
                                        Kami Buat Dengan Bentuk Soal EPS-TOPIK Terbarukan, sehingga Akan Sangat Membantu Pemahaman Teman-Teman Dalam Menghadapi dan Menjawab soal-soal Ujian EPS-TOPIK Sebenarnya.
                                    </p>
                                    <div class="d-flex flex-row justify-content-start">
                                        @auth
                                        <p data-aos="fade-up" data-aos-delay="300">
                                            <a href="{{ route('paket-saya.index') }}" style="background-color:#71b8e6"
                                                class="btn btn-primary mr-3 py-3 px-5 btn-pill">Dashboard Try Out</a>
                                        </p>
                                        @else
                                        <p data-aos="" data-aos-delay="300">
                                            <a href="{{ route('login') }}" style="background-color:#71b8e6"
                                                class="btn btn-primary py-3 px-5 btn-pill">Masuk</a>
                                        </p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section courses-title" id="courses-section" style="background-color:#7ac6c4">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                        <h2 class="section-title">Paket</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-section courses-entry-wrap" data-aos="fade-up" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            @foreach (\App\Models\Paket::whereNull('deleted_at')->get()->sortBy('name') as $key => $value)
                                <div class="col-md-3 course bg-white h-100 align-self-stretch" style="padding-top:20px">
                                    <figure class="m-0">
                                        <a target="_blank" href="https://wa.me/+6287812464174?text=Halo! Saya ingin membeli EPS Topik {{$value->name}} dari Rumah Korea."><img src='images/img_{{$key+1}}.jpg' alt="Image" class="img-fluid" /></a>
                                    </figure>
                                    <div class="py-4 px-4">
                                        <span class="course-price" style="margin-top:25px;background-color:#71b8e6">{{number_format($value->detailPaket->price,0,".",".")}} IDR</span>
                                        <div class="meta">
                                            20 Soal Bagian Membaca <br>
                                            20 Soal Bagian Mendengar
                                        </div>
                                        <h3>
                                            <a target="_blank" href="https://wa.me/+6287812464174?text=Halo! Saya ingin membeli EPS Topik {{$value->name}} dari Rumah Korea.">{{$value->name}}</a>
                                        </h3>
                                        <p>
                                            Terdiri dari 10 macam jenis tryout ujian EPS-Topik. 
                                            Hasil Langsung Keluar.
                                        </p>
                                    </div>
                                    <div class="d-flex border-top stats">
                                        <div class="py-3 px-4 text-center">
                                            <a class="btn btn-warning" target="_blank" href="https://wa.me/+6287812464174?text=Halo! Saya ingin membeli EPS Topik {{$value->name}} dari Rumah Korea.">
                                                BELI SEKARANG
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <button class="customPrevBtn btn btn-primary m-1">
                            Prev
                        </button>
                        <button class="customNextBtn btn btn-primary m-1">
                            Next
                        </button>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="site-section bg-light" id="programs-section">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                        <h2 class="section-title">Promo</h2>
                        <p>
                            JIKA BELI LANGSUNG 4 PAKET HARGA 500.000 IDR 
                            <br>
                            <br>
                            <a class="btn btn-warning" target="_blank" href="https://wa.me/+6287812464174?text=Halo! Saya ingin membeli EPS Topik Paket 1, 2, 3, dan 4 dari Rumah Korea.">
                                BELI SEKARANG
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                        <p>
                            <br><br><br><br>
                            DAPATKAN TIPS NABUNG UNTUK BERANGKAT KE KOREA DAN DAPATKAN KURSUS GRATIS BAHASA KOREA LEVEL DASAR, LEVEL 1, LEVEL 2, DAN LEVEL 3. 
                        </p>
                    </div>

                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="images/undraw_youtube_tutorial.svg" alt="Image" class="img-fluid" />
                    </div>
                    <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-black mb-4">
                            Iklan Disini
                        </h2>
                        <p class="mb-4">
                            Dengan ... di hanwha kamu akan mendapatkan kursus gratis. Kursus bahasa korea dari level dasar sampai level 3. Dengan belajar melalui rumah korea, kamu akan mampu untuk langsung mengikuti tes ujian eps-topik agar lolos untuk berangkat kerja ke korea.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer-section" style="background-color:#004157">
            <div class="container">
                <!-- <div class="row">
                    <div class="col-md-4">
                        <h3>Tentang Technow</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Porro consectetur ut hic ipsum
                            et veritatis corrupti. Itaque eius soluta optio
                            dolorum temporibus in, atque, quos fugit sunt
                            sit quaerat dicta.
                        </p>
                    </div>

                    <div class="col-md-3 ml-auto">
                        <h3>Links</h3>
                        <ul class="list-unstyled footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Paket</a></li>
                            <li><a href="#">Promo</a></li>
                            <li><a href="#">Teachers</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h3>Subscribe</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Nesciunt incidunt iure iusto
                            architecto? Numquam, natus?
                        </p>
                        <form action="#" class="footer-subscribe">
                            <div class="d-flex mb-5">
                                <input type="text" class="form-control rounded-0" placeholder="Email" />
                                <input type="submit" class="btn btn-primary rounded-0" value="Subscribe" />
                            </div>
                        </form>
                    </div>
                </div> -->

                <div class="row text-center">
                    <div class="col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(
                                    new Date().getFullYear()
                                );
                            </script>
                            All rights reserved | This template is made
                            with
                            <i class="icon-heart" aria-hidden="true" style="color:red"></i>
                            by
                            <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            redeisgn by 
                            <a href="https://technow.id" target="_blank">technow.id</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- .site-wrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"
        integrity="sha512-VqTaIU3VlSHylzoMs3hWCBTMZ9l5fvYayp4yzRb5qV9Ne4Z+n21uFoG672gWMcJiedQYZV2KmXF3VkTTsRGRbg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js"
        integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA=="
        crossorigin="anonymous"></script>
    <script src="{{asset('js/landing-page.js')}}"></script>
</body>

</html>
