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
                        <h1 class="m-0">Detail Peminjaman Harian</h1>
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
                            <input type="text" class="form-control" value="{{ $peminjaman->siswas->name }}"
                                disabled />
                        </div>

                        <div class="col-md-6">
                            <label>Kelas :</label>
                            <input type="text" class="form-control" value="{{ $peminjaman->siswas->kelas }}"
                                disabled />
                        </div>
                        <div class="col-md-6">
                            <label>Sampul :</label>
                            <div>
                                <img src="{{ asset('gambarbukuharian/' . $peminjaman->bukusharians->foto) }}"
                                    alt="" style="width:200px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Judul Buku :</label>
                            <input type="text" class="form-control" id="buku" name="buku"
                                value="{{ $peminjaman->bukusharians->buku }}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label>Penulis :</label>
                            <input type="text" class="form-control" value="{{ $peminjaman->bukusharians->penulis }}"
                                disabled />
                        </div>
                        <div class="col-md-6">
                            <label>Penerbit :</label>
                            <input type="text" class="form-control"
                                value="{{ $peminjaman->bukusharians->penerbit }}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label>Deskripsi :</label>
                            <textarea type="text" class="form-control" disabled>{{ $peminjaman->bukusharians->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Kode Buku :</label>
                            <input type="text" class="form-control" id="kodebuku" name="kodebuku"
                                value="{{ $peminjaman->kodebuku }}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label>Jumlah Buku :</label>
                            <input type="text" class="form-control" id="jml_buku" name="jml_buku"
                                value="{{ $peminjaman->jml_buku }}" disabled />
                        </div>
                        <!-- Date and time -->
                        <div class="form-group">
                            <label>Jam Pinjam :</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="datetime-local" name="jam_pinjam" class="form-control datetimepicker-input"
                                    data-target="#reservationdatetime" value="{{ $peminjaman->jam_pinjam }}"
                                    disabled />
                                <div class="input-group-append" data-target="#reservationdatetime"
                                    data-toggle="datetimepicker">
                                </div>
                            </div>
                        </div>
                        <!-- /.form group -->
                        <!-- Date and time -->
                        <div class="form-group">
                            <label>Jam Kembali :</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="datetime-local" name="jam_kembali"
                                    class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                    value="{{ $peminjaman->jam_kembali }}" disabled />
                                <div class="input-group-append" data-target="#reservationdatetime"
                                    data-toggle="datetimepicker">
                                </div>
                            </div>
                        </div>
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
