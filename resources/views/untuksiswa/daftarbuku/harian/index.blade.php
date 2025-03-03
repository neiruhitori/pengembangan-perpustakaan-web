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

    <!-- Tambahkan CSS untuk gambar -->
    <style>
        .event-item img,
        .blog-item img {
            width: 100%;
            height: 400px;
            /* Sesuaikan tinggi gambar sesuai kebutuhan Anda */
            object-fit: cover;
            /* Mengatur gambar agar menyesuaikan ukuran kontainer */
        }

        .blog-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .blog-item .blog-img {
            flex-shrink: 0;
        }

        .blog-item .text-dark {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .event-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .event-item .event-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <h1 class="text-uppercase text-primary">Buku Harian</h1>
                <h3 class="mb-0">Rekomendasi</h3>
            </div>
            <div class="event-carousel owl-carousel">
                @foreach ($events->slice(0, 4) as $book)
                    <div class="event-item">
                        <img src="{{ asset('gambarbukuharian/' . $book->foto) }}" class="img-fluid w-100"
                            alt="Image">
                        <div class="event-content p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-body"><i
                                        class="fas fa-calendar-alt me-2"></i>{{ $book->created_at }}</span>
                            </div>
                            <h4 class="mb-4">{{ $book->buku }}</h4>
                            <p class="mb-4">{{ Str::limit($book->description, 50) }}</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                href="{{ route('untuksiswa.daftarbuku.harian.lihat', $book->id) }}">Lihat</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid blog py-5 mb-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h1 class="text-uppercase text-primary">Buku Harian</h1>
                <h3 class="mb-0">Daftar Lengkap
                </h3>
            </div>
            <form action="{{ route('untuksiswa.daftarbuku.harian.search') }}" method="GET">
                <div class="input-group mb-5">
                    <input type="text" name="query" class="form-control" placeholder="Search buku..."
                        value="{{ request()->input('query') }}" autocomplete="off">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <div class="row g-4">
                @if ($bukuharian->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            Buku yang Anda cari tidak ditemukan.
                        </div>
                    </div>
                @else
                    @foreach ($bukuharian as $book)
                        <div class="col-lg-6 col-xl-3">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="{{ asset('gambarbukuharian/' . $book->foto) }}" class="img-fluid w-100"
                                        alt="">
                                    <div class="blog-info">
                                        <span><i class="fa fa-clock"></i>{{ $book->created_at }}</span>
                                        {{-- <div class="d-flex">
                                        <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                        <a href="{{ asset('gambarbukuharian/' . $book->foto) }}" class="text-white">0 <i
                                                class="fa fa-comment"></i></a>
                                    </div> --}}
                                    </div>
                                    <div class="search-icon">
                                        <a href="{{ asset('gambarbukuharian/' . $book->foto) }}" data-lightbox="Blog-1"
                                            class="my-auto"><i
                                                class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                                    </div>
                                </div>
                                <div class="text-dark border p-4 ">
                                    <h4 class="mb-4">{{ $book->buku }}</h4>
                                    <p class="mb-4">{{ Str::limit($book->description, 50) }}</p>
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                        href="{{ route('untuksiswa.daftarbuku.harian.lihat', $book->id) }}">Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $bukuharian->links() }}
            </div>
        </div>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    @include('untuksiswa.js')

</body>

</html>
