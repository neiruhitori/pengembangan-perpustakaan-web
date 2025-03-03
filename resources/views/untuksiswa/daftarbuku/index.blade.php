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
    <div class="container-fluid service py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h1 class="text-uppercase text-primary"><b>Halaman Buku</b></h1>
                <h4 class="mb-0">Cari buku yang ingin kamu pinjam disini</h4>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3">

                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="service-item">
                        <a href="{{ route('untuksiswa.daftarbuku.harian.index') }}" onmouseover="document.formulir.sub_but.src='submit_icon.jpg'"
                            onmouseout="document.formulir.sub_but.src='submit_icon_hover.jpg'"
                            onclick="return val_form_this_page()">
                            <img src="{{ asset('environs-1.0.0/img/harian_service-2.jpg') }}" class="img-fluid w-100"
                                alt="Image">
                        </a>
                        {{-- <div class="service-link">
                            <a class="h4 mb-0">Harian</a>
                        </div> --}}
                    </div>
                    <p class="my-4">Terdapat berbagai macam buku harian, klik gambar untuk melihat lengkapnya.
                    </p>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="service-item">
                        <a href="{{ route('untuksiswa.daftarbuku.tahunan.index') }}" onmouseover="document.formulir.sub_but.src='submit_icon.jpg'"
                            onmouseout="document.formulir.sub_but.src='submit_icon_hover.jpg'"
                            onclick="return val_form_this_page()">
                            <img src="{{ asset('environs-1.0.0/img/tahunan_service-2.jpg') }}" class="img-fluid w-100"
                                alt="Image">
                        </a>
                        {{-- <div class="service-link">
                            <a href="{{ asset('environs-1.0.0/#') }}" class="h4 mb-0">Tahunan</a>
                        </div> --}}
                    </div>
                    <p class="my-4">Terdapat berbagai macam buku tahunan, klik gambar untuk melihat lengkapnya.
                    </p>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">

                </div>

            </div>
        </div>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    @include('untuksiswa.js')

</body>

</html>
