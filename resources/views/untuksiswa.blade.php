<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Perpustakaan SMP 02 KLAKAH</title>
    <link rel="shortcut icon" href="{{ asset('AdminLTE-3.2.0/dist/img/smp2.png') }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('environs-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('environs-1.0.0/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('environs-1.0.0/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('environs-1.0.0/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->

    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid carousel-header vh-100 px-0">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('environs-1.0.0/img/carousel-1.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Selamat
                                Datang di Perpustakaan</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">SMPN 02 KLAKAH</h1>
                            <p class="mb-5 fs-5">Jelajahi dunia pengetahuan dan imajinasi bersama kami.
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <button onclick="scrollToSection()"
                                    class="btn-hover-bg btn btn-primary text-white py-3 px-5">Mulai</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('environs-1.0.0/img/carousel-2.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Selamat
                                Datang di Perpustakaan</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">SMPN 02 KLAKAH</h1>
                            <p class="mb-5 fs-5">Temukan buku favoritmu untuk meraih impianmu.
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <button onclick="scrollToSection()"
                                    class="btn-hover-bg btn btn-primary text-white py-3 px-5">Mulai</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('environs-1.0.0/img/carousel-3.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Selamat
                                Datang di Perpustakaan</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">SMPN 02 KLAKAH</h1>
                            <p class="mb-5 fs-5">Nikmati waktumu dengan membaca buku.
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <button onclick="scrollToSection()"
                                    class="btn-hover-bg btn btn-primary text-white py-3 px-5">Mulai</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->





    <!-- About Start -->
    {{-- @include('untuksiswa.about') --}}
    <!-- About End -->


    <!-- Services Start -->
    {{-- halaman Buku --}}
    <!-- Services End -->


    <!-- Donation Start -->
    <div id="section2" class="section">
        <div class="container-fluid donation py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                    <h1 class="text-uppercase text-primary"><b>Daftar Perpustakaan</b></h1>
                    <h4 class="mb-0">Pilih Opsi</h4>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="donation-item">
                            <img src="{{ asset('environs-1.0.0/img/donation-12.jpg') }}" class="img-fluid w-100"
                                alt="Image">
                            <div class="donation-content d-flex flex-column">
                                <h5 class="text-uppercase text-primary mb-4">Buat</h5>
                                <a href="{{ asset('environs-1.0.0/#') }}"
                                    class="btn-hover-color display-6 text-white">Pinjam Buku Harian</a>
                                <h4 class="text-white mb-4">Peminjaman Harian</h4>
                                <p class="text-white mb-4">Klik "<b>Pinjam</b>" untuk melakukan pinjam buku
                                    harian<br>dan klik "<b>Kembalikan</b>" jika sudah selesai meminjam.</p>
                                <div class="donation-btn d-flex align-items-center justify-content-start">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-2"
                                        href="{{ route('untuksiswa.pinjamharian.index') }}">Pinjam</a>
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                        href="{{ route('untuksiswa.kembalianharian.index') }}">Kembalikan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="donation-item">
                            <img src="{{ asset('environs-1.0.0/img/donation-11.jpg') }}" class="img-fluid w-100"
                                alt="Image">
                            <div class="donation-content d-flex flex-column">
                                <h5 class="text-uppercase text-primary mb-4">Buat</h5>
                                <a href="{{ asset('environs-1.0.0/#') }}"
                                    class="btn-hover-color display-6 text-white">Pinjam Buku Tahunan</a>
                                <h4 class="text-white mb-4">Peminjaman Tahunan</h4>
                                <p class="text-white mb-4">Klik "<b>Pinjam</b>" untuk melakukan pinjam buku tahunan<br>dan
                                    klik "<b>Kembalikan</b>" jika sudah selesai meminjam.</p>
                                <div class="donation-btn d-flex align-items-center justify-content-start">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-2"
                                        href="{{ route('untuksiswa.pinjamtahunan.index') }}">Pinjam</a>
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                        href="{{ route('untuksiswa.kembaliantahunan.index') }}">Kembalikan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="donation-item">
                            <img src="{{ asset('environs-1.0.0/img/donation-13.jpg') }}" class="img-fluid w-100"
                                alt="Image">
                            <div class="donation-content d-flex flex-column">
                                <h5 class="text-uppercase text-primary mb-4">Lihat</h5>
                                <a href="{{ asset('environs-1.0.0/#') }}"
                                    class="btn-hover-color display-6 text-white">Daftar Buku</a>
                                <h4 class="text-white mb-4">Data Buku</h4>
                                <p class="text-white mb-4">Klik "<b>Lihat</b>" untuk melakukan melihat buku di perpustakaan.
                                </p>
                                <div class="donation-btn d-flex align-items-center justify-content-start">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                        href="{{ route('untuksiswa.daftarbuku.index') }}">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Donation End -->


    <!-- Counter Start -->
    <div class="container-fluid counter py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, 0.4)), url(img/volunteers-bg.jpg) center center; background-size: cover;">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h3 class="text-uppercase text-primary">Detail Perpustakaan</h3>
                <p class="text-white mb-0">Total Data Siswa, Buku, Data Harian dan Data Tahunan.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-users fa-4x text-white"></i>
                        <h3 class="text-white my-4">Siswa</h3>
                        <div class="counter-counting">
                            <span class="text-primary fs-2 fw-bold"
                                data-toggle="counter-up">{{ $siswa }}</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-book-open fa-4x text-white"></i>
                        <h3 class="text-white my-4">Buku</h3>
                        <div class="counter-counting text-center border-white w-100"
                            style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold"
                                data-toggle="counter-up">{{ $totalBuku }}</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-users-cog fa-4x text-white"></i>
                        <h3 class="text-white my-4">Data Harian</h3>
                        <div class="counter-counting text-center border-white w-100"
                            style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold"
                                data-toggle="counter-up">{{ $harian }}</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-user-cog fa-4x text-white"></i>
                        <h3 class="text-white my-4">Data Tahunan</h3>
                        <div class="counter-counting text-center border-white w-100"
                            style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold"
                                data-toggle="counter-up">{{ $tahunan }}</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">

                </div>
            </div>
        </div>
    </div>
    <!-- Counter End -->


    <!-- Causes Start -->

    <!-- Causes End -->


    <!-- Events Start -->

    <!-- Events End -->

    <!-- Blog Start -->

    <!-- Blog End -->


    <!-- Gallery Start -->

    <!-- Gallery End -->


    <!-- Volunteers Start -->

    <!-- Volunteers End -->


    <!-- Footer Start -->

    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-4 text-center text-md-start mb-md-0">
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    @include('untuksiswa.js')

</body>

</html>
