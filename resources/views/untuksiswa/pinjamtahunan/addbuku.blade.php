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
            action="{{ route('untuksiswa.pinjamtahunan.addbukustore') }}">
            @csrf
            <div class="container custom-container"> <!-- Menambahkan kelas custom-container -->
                <div class="col-md-12 ">
                    <div class="card card-primary  ">
                        <div class="card-header">
                            <h1 class="card-title"><b>Tambah Buku</b></h1>
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
                                        <div class="input-group mb-3" id="table">
                                            <div class="col-md-6">
                                                @error('peminjamantahunan_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                @error('bukucruds_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                @error('jml_buku')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                @error('kodebuku')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Kode Pinjam</th>
                                                    <th>Buku</th>
                                                    <th>Kode Buku</th>
                                                    <th>Jumlah Buku</th>
                                                    <th>Aksi</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" name="peminjamantahunan_id[]"
                                                            id="peminjamantahunan_id">
                                                            <option selected disabled>Pilih Kode Pinjaman</option>
                                                            @foreach ($peminjamantahunanbuku as $buku)
                                                                <option scope="row" value="{{ $buku->id }}">
                                                                    {{ $buku->kode_pinjam }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="bukucrud" name="bukucruds_id[]"
                                                            class="form-control">
                                                            <option selected disabled>Pilih buku</option>
                                                            @foreach ($bukucrud as $buk)
                                                                <option value="{{ $buk->id }}"
                                                                    @if ($buk->stok <= 0) disabled @endif>
                                                                    {{ $buk->buku }} @if ($buk->stok <= 0)
                                                                        (Stok Habis)
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" id="kodebuku"
                                                            name="kodebuku[]" placeholder=" Masukkan Kode Buku"
                                                            autocomplete="off" /></td>
                                                    <td><input type="number" class="form-control" id="jml_buku"
                                                            name="jml_buku[]"
                                                            placeholder=" Masukkan Jumlah Buku yang di Pinjam"
                                                            autocomplete="off" />
                                                    </td>
                                                    <td><button class="btn btn-success add_buku" type="button"
                                                            name="add" id="add">Tambah</button></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Tambah Buku
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah
                                                                Buku</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Pastikan data Buku sudah benar!
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal
                                                            </button>

                                                            <button id="btn"
                                                                class="btn btn-primary profile-button" type="submit">
                                                                Tambah
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
        <script>
            const add = document.querySelectorAll(".input-group .add_buku")
            add.forEach(function(e) {
                e.addEventListener('click', function() {
                    let element = this.parentElement
                    // console.log(element);
                    let newElement = document.createElement('div')
                    newElement.classList.add('input-group', 'mb-3')
                    newElement.innerHTML = `
                        <tr>
                            <td>
                                <select class="form-control tag-select" name="peminjamantahunan_id[]" id="peminjamantahunan_id">
                                    <option selected disabled>Pilih Kode Pinjaman</option>
                                        @foreach ($peminjamantahunanbuku as $buku)
                                            <option scope="row" value="{{ $buku->id }}">{{ $buku->kode_pinjam }}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="bukucrud" name="bukucruds_id[]" class="form-control tag-select">
                                    <option selected disabled>Pilih buku</option>
                                        @foreach ($bukucrud as $buk)
                                            <option value="{{ $buk->id }}">{{ $buk->buku }}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control" id="kodebuku" name="kodebuku[]" placeholder=" Masukkan Kode Buku" autocomplete="off"/></td>
                            <td><input type="text" class="form-control" id="jml_buku" name="jml_buku[]" placeholder=" Masukkan Jumlah Buku yang di Pinjam" autocomplete="off"/></td>
                            <td><button class="btn btn-danger remove_buku" type="button" name="add" id="add">Hapus</button></td>
                        </tr>`
                    document.getElementById('table').appendChild(newElement)
                    callEvent()
                })
            })
            callEvent()

            function callEvent() {
                // Dibawah ini adalah untuk Hapus Input yang ditambahkan
                document.querySelector('div').querySelectorAll('.remove_buku').forEach(function(remove) {
                    remove.addEventListener('click', function(elmClick) {
                        elmClick.target.parentElement.remove()
                    })
                })
                // Dibawah ini adalah untuk fitur select2 pada saat add multiple
                $(document).ready(function() {
                    $('.tag-select').select2({
                        placeholder: 'Select tags',
                    });
                });
            }
        </script>
        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
                class="fa fa-arrow-up"></i></a>

        @include('untuksiswa.js')

</body>

</html>
