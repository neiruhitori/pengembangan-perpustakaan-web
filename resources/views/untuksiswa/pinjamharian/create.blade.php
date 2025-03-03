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

    <!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
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

        .message-center-top {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            width: 50%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="profile_setup_frm"
            action="{{ route('untuksiswa.pinjamharian.store') }}">
            @csrf
            <div class="container custom-container"> <!-- Menambahkan kelas custom-container -->
                <div class="col-md-12 ">
                    <div class="card card-primary  ">
                        <div class="card-header">
                            <h1 class="card-title"><b>Buat Pinjaman Harian</b></h1>
                            @if (Session::has('error'))
                                <div class="btn btn-danger swalDefaultSuccess message-center-top" role="alert">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12 border-right">
                                <div class="p-3 py-5">
                                    <div class="row" id="res"></div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="inputStatus">Nama :</label>
                                            @error('siswas_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <select id="peminjaman_name" name="siswas_id" class="form-control">
                                                <option selected disabled>Pilih Siswa</option>
                                                @foreach ($siswa as $sw)
                                                    <option value="{{ $sw->id }}">{{ $sw->nisn }} -
                                                        {{ $sw->name }} - {{ $sw->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStatus">Buku :</label>
                                            @error('buku')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <select id="bukuharian" name="bukusharians_id" class="form-control">
                                                <option selected disabled>Pilih Buku</option>
                                                @foreach ($bukuharian as $sw)
                                                    <option value="{{ $sw->id }}"
                                                        @if ($sw->stok <= 0) disabled @endif>
                                                        {{ $sw->buku }}
                                                        @if ($sw->stok <= 0)
                                                            (Stok Habis)
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode Buku :</label>
                                            @error('kodebuku')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <select id="kodebuku" name="kodebuku" class="form-control">
                                                <option selected disabled>Pilih Kode Buku</option>
                                                @foreach ($bukuharian as $buku)
                                                    @foreach ($buku->kodebukuharians as $kode)
                                                        <option value="{{ $kode->kodebuku }}">{{ $buku->buku }} -
                                                            {{ $kode->kodebuku }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Jumlah Buku :</label>
                                            @error('jml_buku')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input type="number" class="form-control" id="jml_buku" name="jml_buku"
                                                placeholder=" Masukkan Jumlah Buku yang di Pinjam" autocomplete="off" />
                                        </div>
                                        <!-- Date and time -->
                                        <div class="form-group col-md-2">
                                            <label>Jam Pinjam :</label>
                                            @error('jam_pinjam')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="input-group date" id="reservationdatetime"
                                                data-target-input="nearest">
                                                <input type="datetime-local" name="jam_pinjam"
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
                                            <label>Jam Kembali :</label>
                                            @error('jam_kembali')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="input-group date" id="reservationdatetime"
                                                data-target-input="nearest">
                                                <input type="datetime-local" name="jam_kembali"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#reservationdatetime" autocomplete="off" />
                                                <div class="input-group-append" data-target="#reservationdatetime"
                                                    data-toggle="datetimepicker">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-4">

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Tambah Pinjaman
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Konfirmasi
                                                                Pinjaman</h1>
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
    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</html>
