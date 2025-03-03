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

    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .short-input {
            width: 200px;
        }

        .custom-container {
            margin-top: 28px;
            /* Geser ke bawah */
            padding: 20px;
            border-radius: 5px;
            /* Radius border untuk sudut melengkung */
        }

        .card-header {
            background-color: #ff9800;
            /* Warna oren cerah */
            color: #fff;
            /* Warna teks putih untuk kontras */
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="profile_setup_frm"
            action="{{ route('untuksiswa.pinjamtahunan.store') }}">
            @csrf
            <div class="container custom-container"> <!-- Menambahkan kelas custom-container -->
                <div class="col-md-12 ">
                    <div class="card card-primary  ">
                        <div class="card-header">
                            <h1 class="card-title"><b>Buat Pinjaman Tahunan</b></h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12 border-right">
                                <div class="p-3 py-2">
                                    <div class="row" id="res"></div>
                                    <label>Kode Pinjam :</label>
                                    <br>
                                    <div class="kode_pinjam">
                                        @error('kls')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select id="kls" name="kls" class="form-control short-input">
                                            <option selected disabled>Pilih Kelas</option>
                                            <option>VIIA</option>
                                            <option>VIIB</option>
                                            <option>VIIC</option>
                                            <option>VIID</option>
                                            <option>VIIE</option>
                                            <option>VIIF</option>
                                            <option>VIIG</option>
                                            <option>VIIIA</option>
                                            <option>VIIIB</option>
                                            <option>VIIIC</option>
                                            <option>VIIID</option>
                                            <option>VIIIE</option>
                                            <option>VIIIF</option>
                                            <option>VIIIG</option>
                                            <option>IXA</option>
                                            <option>IXB</option>
                                            <option>IXC</option>
                                            <option>IXD</option>
                                            <option>IXE</option>
                                            <option>IXF</option>
                                            <option>IXG</option>
                                        </select>
                                        @error('absen')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control short-input" id="absen"
                                            name="absen" placeholder="No Absen" autocomplete="off" />
                                        @error('tgl')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="date" class="form-control short-input" id="tgl"
                                            name="tgl" autocomplete="off" />
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="inputStatus">Nama :</label>
                                            @error('siswas_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <select id="peminjamantahunan_name" name="siswas_id" class="form-control">
                                                <option selected disabled>Pilih Siswa</option>
                                                @foreach ($siswa as $sw)
                                                    <option value="{{ $sw->id }}">{{ $sw->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Date and time -->
                                        <div class="form-group col-md-2">
                                            <label>Tanggal Pinjam :</label>
                                            @error('jam_pinjam')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="input-group date" id="reservationdatetime"
                                                data-target-input="nearest">
                                                <input type="date" name="jam_pinjam"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#reservationdatetime" autocomplete="off" />
                                                <div class="input-group-append" data-target="#reservationdatetime"
                                                    data-toggle="datetimepicker">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.form group -->
                                        <!-- Date and time -->
                                        <div class="form-group col-md-2">
                                            <label>Tanggal Kembali :</label>
                                            @error('jam_kembali')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="input-group date" id="reservationdatetime"
                                                data-target-input="nearest">
                                                <input type="date" name="jam_kembali"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#reservationdatetime" autocomplete="off" />
                                                <div class="input-group-append" data-target="#reservationdatetime"
                                                    data-toggle="datetimepicker">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Buat Pinjaman
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Konfirmasi
                                                                Pinjaman
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Pastikan data pinjaman sudah benar!
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal
                                                            </button>

                                                            <button id="btn"
                                                                class="btn btn-primary profile-button" type="submit">
                                                                Buat
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
