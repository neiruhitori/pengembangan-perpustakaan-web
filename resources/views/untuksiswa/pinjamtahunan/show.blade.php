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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Peminjaman Tahunan</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="profile_setup_frm" action="#">
            @csrf
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Nama :</label>
                                <input type="text" class="form-control"
                                    value="{{ $peminjamantahunan->siswas->name }}" disabled />
                            </div>

                            <div class="col-md-6">
                                <label>Kelas :</label>
                                <input type="text" class="form-control"
                                    value="{{ $peminjamantahunan->siswas->kelas }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Sampul :</label>
                                <div>
                                    @foreach ($peminjamantahunan->bukus()->get() as $b)
                                        <img src="{{ asset('gambarbukutahunan/' . $b->bukucruds->foto) }}"
                                            alt="" style="width:50px;" class="form-control">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Judul Buku :</label>
                                @foreach ($peminjamantahunan->bukus()->get() as $b)
                                    <input type="text" class="form-control" id="buku" name="buku"
                                        value="{{ $b->bukucruds->buku }}" disabled />
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label>Penulis :</label>
                                @foreach ($peminjamantahunan->bukus()->get() as $b)
                                    <input type="text" class="form-control" id="buku" name="buku"
                                        value="{{ $b->bukucruds->penulis }}" disabled />
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label>Penerbit :</label>
                                @foreach ($peminjamantahunan->bukus()->get() as $b)
                                    <input type="text" class="form-control" id="buku" name="buku"
                                        value="{{ $b->bukucruds->penerbit }}" disabled />
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label>Deskripsi :</label>
                                @foreach ($peminjamantahunan->bukus()->get() as $b)
                                    <input type="text" class="form-control" id="buku" name="buku"
                                        value="{{ $b->bukucruds->description }}" disabled />
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label>Kode Buku :</label>
                                @foreach ($peminjamantahunan->bukus()->get() as $d)
                                    <input type="text" class="form-control" id="kodebuku" name="kodebuku"
                                        value="{{ $d->kodebuku }}" disabled />
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label>Jumlah Buku :</label>
                                @foreach ($peminjamantahunan->bukus()->get() as $c)
                                    <input type="text" class="form-control" id="jml_buku" name="jml_buku"
                                        value="{{ $c->jml_buku }}" disabled />
                                @endforeach
                            </div>
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Tanggal Pinjam :</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="date" name="jam_pinjam" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime"
                                        value="{{ $peminjamantahunan->jam_pinjam }}" disabled />
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                        data-toggle="datetimepicker">
                                    </div>
                                </div>
                            </div>
                            <!-- /.form group -->
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Tanggal Kembali :</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="date" name="jam_kembali"
                                        class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                        value="{{ $peminjamantahunan->jam_kembali }}" disabled />
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                        data-toggle="datetimepicker">
                                    </div>
                                </div>
                            </div>
                            <!-- /.form group -->
                            {{-- <div class="col-md-6">
                                <label>Description :</label>
                                <textarea class="form-control" id="description" name="description"
                                 disabled >{{ $peminjamantahunan->description }}</textarea>
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>

        </form>

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
                class="fa fa-arrow-up"></i></a>

        @include('untuksiswa.js')

</body>

</html>
