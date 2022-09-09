<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EPS TOPIK</title>
    <link rel="icon" href="{{asset('landingpage/img/icon/logo.png')}}" />
    <!-- Bootstrap-4 -->
    <link rel="stylesheet" href="{{asset('landingpage/css/plugins/bootstrap.min.css')}}">
    <!-- Font Awsome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('landingpage/sass/main.css')}}">
</head>

<body>
    <!-- ========== Start Navbar ==========-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand w-50" href="#"><img class="img-fluid w-50"
                    src="{{asset('landingpage/img/icon/logo.png')}}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">


                    <li class="nav-item">
                        <a class="nav-link" id="nav-home" href="#">Home<br>홈</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-paket" href="#paket">Paket<br>패키지</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Promo<br>프로모션</a>

                    </li>

                </ul>
                <a href="#0" style="padding:5px 15px" class="text-center btn-blue">Kontak Kami<br>고객센터</a>

            </div>
        </div>
    </nav>
    <!-- ========== End Navbar ==========-->

    <!-- ========== Start Slider ==========-->
    <section style="margin-top: -75px" id="home" class="slider d-flex align-items-center">
        <div class="shapes">
            <div class="shape-1"><img src="{{asset('landingpage/img/shapes/shape-1.svg')}}" alt="shape"></div>
            <div class="shape-2"><img src="{{asset('landingpage/img/shapes/shape-2.svg')}}" alt="shape"></div>
            <div class="shape-3"><img src="{{asset('landingpage/img/shapes/shape-3.svg')}}" alt="shape"></div>
            <div class="shape-4"><img src="{{asset('landingpage/img/shapes/shape-4.svg')}}" alt="shape"></div>
            <div class="shape-5"><img src="{{asset('landingpage/img/shapes/shape-5.svg')}}" alt="shape"></div>
            <div class="shape-6"><img src="{{asset('landingpage/img/shapes/shape-6.svg')}}" alt="shape"></div>
            <div class="shape-7"><img src="{{asset('landingpage/img/shapes/shape-7.svg')}}" alt="shape"></div>
            <div class="shape-8"><img src="{{asset('landingpage/img/shapes/shape-8.svg')}}" alt="shape"></div>
        </div>
        <div class="container">
            <div class="row d-flex align-items-lg-center">
                <div class="col-md-7">
                    <div class="content">
                        <h3 class="h3 mb-10">Employment Permit System-Test of Proficiency in Korean (EPS-TOPIK)</h3>
                        <h3 class="h3 mb-15">Computer Basic Test (CBT)</h3>
                        <p class="p-1">컴퓨터를 통해 시험 보기</p>
</p>
                        @auth
                        <a href="{{route('login')}}" class="btn-blue">Dashboard Tryout</a>
                        @else
                        <a href="{{route('register')}}" class="btn-blue" style="padding:5px 40px">Daftar<br>등록</a>
                        <a href="{{route('login')}}" class="btn-blue" style="padding:5px 40px">Masuk<br>로그인</a>

                        @endauth

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="image">
                        <img class="img-fluid w-75" src="{{asset('landingpage/img/icon/bg-com.png')}}" alt="slider"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Slider ==========-->

    <!-- ========== Start How-Work ==========-->
    <section class="how-work ptb-120">
        <div class="container text-center">
            <div class="heading text-center mb-70">
                <h2 class="h2">Selamat Datang !</h2>
                <h2 class="h2">환영합니다!</h2>
                <p class="p-1 mt-3">website ini adalah tes kemampuan untuk ujian EPS-TOPIK berbasis Computer Basic Test
                    (CBT)
                    <br>
                    bagi para calon pekerja migran indonesia (CPMI) yang ingin bekerja di Korea Selatan
                </p>
                <p class="p-1 mt-1">한국에서 일하고 싶은 외국인근로자를 위한 온라인 웹사이트입니다. 이 웹사이트를 통해 모든 외국인
                 <br>온라인으로 일정한 시간에 때라 시험을 볼 수 있거나 연습도 할 수 있습니다.</p>
            </div>
        </div>
    </section>
    <!-- ========== End How-Work ==========-->

    <!-- ========== Start Company ==========-->
    <section class="company pb-120">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-5">
                    <div class="image">
                        <img class="img-fluid" src="{{asset('landingpage/img/icon/korea.png')}}" alt="company"
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="text text-1">
                        <h3 class="h3 mb-20">Apa yang dimaksud dengan EPS –TOPIK? <br>EPS TOPIK 은?</h3>
                        <p class="p-1  font-weight-500">EPS TOPIK adalah suatu sistem ujian khusus bagi calon
                            pekerja migran yang diadakan oleh HRD KOREA SELATAN sejak agustus 2005 untuk menyeleksi para
                            calon pekerja asing secara adil dan terbuka serta mendorong pekerja asing untuk dapat
                            beradaptasi lebih awal saat bekerja di Korea Selatan </p>
                        <p class="p-1" style="font-size: 14px">EPS TOPIK은 외국인근로자 선발과정의 공정성⋅투명성을
                            제고하고 외국인근로자의 국내 조기 적응 유도를 위해 2005.8월부터 외국인 고용허가제
                            한국어능력시험(Employment Permit System-Test of Proficiency in Korean, EPS-TOPIK)을 한국산업인력공단이 실시하고
                            있습니다</p>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Company ==========-->

    <!-- ========== Start Company-2 ==========-->
    <section class="company pb-120">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-7">
                    <div class="text text-2">
                        <h3 class="h3 mb-20">Kenapa Harus Daftar Latihan?<br>왜 연습을 싵청해야 합니까?</h3>
                        <p class="p-1 font-weight-500 ">Data EPS TOPIK dalam website ini dibuat dengan bentuk soal terbarukan,
                            sehingga akan sangat membantu anda dalam menghadapi
                            soal-soal Ujian EPS-TOPIK yang sebenarnya</p>
                            <p class="p-1" style="font-size: 14px">이 웹사이트의 데이터는 계속 업데이트되는 다양한 종류의 기출문제로 만들어졌습니다.
                            게다가 외국인들이 이 웹사이트로 시험을 풀려면 예습하거나 복습할 떄 도움이 될 것입니다. 또 다른 보람도 느껴질 수 있습니다. 예를 들어서 시험에 잘 나오는 부분을
                            빠르게 파악 가능하고 출제 경향 파악하는 것이 쉽고 문제 형식대로 외우면 암기가 쉬워지고 자신감이 높으면 한국어능력 시험을 잘 보도록 합니다</p>

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="image">
                        <img class="img-fluid" src="{{asset('landingpage/img/icon/bg-lab.png')}}" alt="company"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Company-2 ==========-->

    <!-- ========== Start Offers ==========-->
    <section class="offers ptb-120">
        <div class="container">
            <div class="heading text-center mb-70">
                <h2 class="h2">Kelebihan</h2>
                <p class="p-2">berikut merupakan beberapa kelebihan yang bisa kamu dapatkan
                    <br>장점
                </p>
            </div>

            <div class="row">
                <!-- Box-1 -->
                <div class="col-md-6">
                    <div style="border-color:#6B7796"
                        class="shadow  box d-flex border align-items-center justify-content-start mb-30">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="icon">
                                    <img style="width:50px" src="{{asset('landingpage/img/icon/icon-back-large.png')}}"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h4 class="h4 ">Soal Terbarukan<br>최신 기출문제</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <p class="p-1 font-weight-500">Soal yang dalam paket telah dibuat dalam bentuk terbarukan</p>
                                    <p class="p-1" style="font-size: 14px">
                                        업데이트되는 다양한 종류의 기출문제들이 포함합니다.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Box-2 -->
                <div class="col-md-6">
                    <div style="border-color:#6B7796;padding-bottom:32px"
                        class="shadow  box d-flex border align-items-center justify-content-start mb-30">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="icon">
                                    <img src="{{asset('landingpage/img/icon/icon-energy-large.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h4 class="h4">Sistem Pengajaran<br>기출문제 작성 밥법</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <p class="p-1 font-weight-500">Sistem pengajaran merupakan sistem yang sama dengan sesungguhnya</p>
                                       <p class="p-1" style="font-size: 14px"> 기출문제를 잘 듣고 읽고 보시고 정답을 클릭하면 됩니다.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Box-3 -->
                <div class="col-md-6">
                    <div style="border-color:#6B7796"
                        class="shadow  box d-flex border align-items-center justify-content-start mb-30">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="icon">
                                    <img src="{{asset('landingpage/img/icon/icon-clock-large.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h4 class="h4">Simulasi Kondisi<br>소요 시간</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2">
                                    <p class="p-1 font-weight-500">Kondisi pengerjaannya sama dengan waktu ujian sebenarnya</p>
                                        <p class="p-1"style="font-size:14px">시간은 50분 동안 실제 시험과 동일합니다</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Box-4 -->
                <div class="col-md-6">
                    <div style="border-color:#6B7796;padding-bottom:14px"
                        class="shadow box d-flex border align-items-center justify-content-start mb-30 ">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="icon">
                                    <img src="{{asset('landingpage/img/icon/icon-book-large.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h4 class="h4">Hasil Jawaban<br>결과</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2">
                                    <p class="p-1 font-weight-500">Dapat melihat score nilai dan jawaban yang benar dan salah secara langsung, serta
                                        bisa didownload</p>
                                        <p class="p-1" style="font-size: 14px">수강생들은 시험이 모두 끝났으면 바로 정답이나 틀린 답을 볼 수 있고 설명서를 다운으로드 가능합니다.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Offers ==========-->

    <section class="ready ptb-120">
        <div class="container d-flex justify-content-between d-flex ">
            <div class="row justify-content-between">
                <div class="col-lg-8">
                    <h3 class="h2-white">Anda Siap Coba?<br>도절할 준비되셨나요? </h3>
                </div>
                <div style="left: 50%;top:10%" class="col-lg-4 ">
                    <div class="btn">
                        <a id="btn-paket" href="#0" class="btn-white">Lihat Paket</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="paket" class="how-work ptb-120">
        <div class="container text-center">
            <div class="heading text-center mb-70">
                <h2 class="h2">Pilihan Paket</h2>
                <p class="p-1 mt-3">패키지 선택
                </p>
            </div>
            <div class="row justify-content-center">
                <!-- Box-1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="box">

                        <h4 class="h4 mb-10">EPS TOPIK 1</h4>
                        <hr style="border-top:2px solid #263B5E;width:200px">
                        <p class="p-2">
                            (10 PAKET LATIHAN)<br>
                            (10개 연습패키지)<br>
                            Membaca 읽기 : 20 Soal 문장 Menyimak 듣기 : 20 Soal
                            문항수 : 40문제 / 시험 시간 50분
                        </p>

                        <div class="btn mt-3 ">
                            @auth
                            <a style="padding: 3px 40px" href="{{route('login')}}" class="btn-oranye">Uji Coba
                                Gratis<br>무료 체험</a>
                            @else
                            <a style="padding: 3px 40px" href="{{route('register')}}" class="btn-oranye">Uji Coba
                                Gratis<br>무료 체험</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <!-- Box-1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="box">

                        <h4 class="h4 mb-10">EPS TOPIK 2</h4>
                        <hr style="border-top:2px solid #263B5E;width:200px">
                        <p class="p-2">
                            (10 PAKET LATIHAN)<br>
                            (10개 연습패키지)<br>
                            Membaca 읽기 : 20 Soal 문장 Menyimak 듣기 : 20 Soal
                            문항수 : 40문제 / 시험 시간 50분
                        </p>
                        <div class="btn mt-3">
                            <a style="padding: 3px 75px" href="#0" class="btn-blue">Lihat<br>더보기</a>
                        </div>
                    </div>
                </div>
                <!-- Box-1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="box">
                        <h4 class="h4 mb-10">EPS TOPIK 3</h4>
                        <hr style="border-top:2px solid #263B5E;width:200px">
                        <p class="p-2">
                            (10 PAKET LATIHAN)<br>
                            (10개 연습패키지)<br>
                            Membaca 읽기 : 20 Soal 문장 Menyimak 듣기 : 20 Soal
                            문항수 : 40문제 / 시험 시간 50분
                        </p>
                        <div class="btn mt-3">
                            <a style="padding: 3px 75px" href="#0" class="btn-blue">Lihat<br>더보기</a>
                        </div>
                    </div>
                </div>
                <!-- Box-1 -->

            </div>
        </div>
    </section>
    <!-- ========== End How-Work ==========-->

    <!-- ========== Start customers ==========-->
    {{-- <section class="customers">
        <div class="container text-center">
            <div class="heading mb-70">
                <h2 class="h2">What Saasbox template offers</h2>
            </div>
            <!-- Testimonials -->
            <div class="testimonials">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <!-- Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <!-- Item-1 -->
                                <div class="carousel-item active text-center">
                                    <img src="http://placehold.jp/130x130.png" alt="" class="center-block team mb-20">
                                    <p class="p-2 mb-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Corporis dolores dolorum, error est excepturi exercitationem hic iusto minus nam
                                        officia optio quasi tempore voluptatibus. Aut dolore in nostrum quae voluptatem!
                                    </p>
                                    <div class="line mb-30"></div>
                                    <h5 class="tes">-Alamin Musa,
                                        <span>Brex Company</span></h5>
                                </div>
                                <!-- Item-1 -->
                                <div class="carousel-item text-center">
                                    <img src="http://placehold.jp/130x130.png" alt="" class="center-block team mb-20">
                                    <p class="p-2 mb-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Corporis dolores dolorum, error est excepturi exercitationem hic iusto minus nam
                                        officia optio quasi tempore voluptatibus. Aut dolore in nostrum quae voluptatem!
                                    </p>
                                    <div class="line mb-30"></div>
                                    <h5 class="tes">-Adil Elsaedd,
                                        <span>Acwad Tech</span></h5>
                                </div>

                            </div>
                            <a class="carousel-control-prev control" data-target="#carouselExampleIndicators"
                                role="button" data-slide="prev">
                                <span class="fa fa-angle-left icon d-flex align-items-center justify-content-center"
                                    aria-hidden="true"></span>
                                <span class="sr-only ">Previous</span>
                            </a>
                            <a class="carousel-control-next control" data-target="#carouselExampleIndicators"
                                role="button" data-slide="next">
                                <span class="fa fa-angle-right icon d-flex align-items-center justify-content-center"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ========== End customers ==========-->

    <!-- ========== Start Ready ==========-->

    <!-- ========== End Ready ==========-->

    <!-- ========== Start Footer ==========-->
    <footer class="footer ptb-120">
        <div class="container">
            <div class="row">
                <!-- Who We Are -->
                <div class="col-md-6">
                    <div class="who">
                        <h4 class="h4 mb-20">Tentang Kami</h4>

                        <p class="p-3">Website ini adalah Tes Kemampuan untuk Ujian EPS-TOPIK Berbasis Computer Basic
                            Test [CBT] Bagi Para Calon Pekerja Migran Indonesia [CPMI] Yang Ingin Bekerja di Korea
                            Selatan</p>
                    </div>
                </div>
                <!-- Links -->

                <!-- Links-2 -->
                <div class="col-md-4">
                        <div class="links">
                            <h4 class="h4 mb-20">Alamat</h4>
                            <ul>
                                <li>
                                    <a href="#0">Sekip Unit 1. Sleman. D.I. Yogyakarta</a>
                                </li>

                              
                            </ul>
                        </div>
                    </div>

                <!-- Social -->
                <div class="col-md-2 ">
                    <div class="social">
                        <h4 class="h4 mb-20">Social Media</h4>
                        <div class="icons">
                            <div class="ico">
                               <div class="icon d-flex justify-content-center align-items-center">
                                    <a href="https://www.youtube.com/channel/UChIBJIAOf8wo_zM2hE7LdFw/featured">
                                        <i class="fa fa-youtube" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ico">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <a href="https://www.instagram.com/rumahkoreaedu/">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
 
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="bottom text-center">
        <span></span>
    </div>
    <!-- ========== End Footer ==========-->

    <!-- ========== Javascript ==========-->
    <script src="{{asset('landingpage/js/plugins/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('landingpage/js/plugins/popper.min.js')}}"></script>
    <script src="{{asset('landingpage/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('landingpage/js/main.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#nav-paket,#btn-paket").click(function () {
                var targetDistance = 0;
                $('html, body').animate({
                    scrollTop: $("#paket").offset().top - targetDistance
                }, 2000);
            });
            $("#nav-home").click(function () {
                var targetDistance = 0;
                $('html, body').animate({
                    scrollTop: $("#home").offset().top - targetDistance
                }, 2000);
            });

        });

    </script>
</body>

</html>
