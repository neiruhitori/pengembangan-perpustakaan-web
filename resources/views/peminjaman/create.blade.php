<head>
    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .message-center-top {
            position: fixed;
            left: 55%;
            transform: translateX(-50%);
            z-index: 100;
            width: 50%;
            /* Sesuaikan lebar pesan */
            text-align: center;
        }
    </style>
</head>

@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Buat Harian</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/peminjaman">Peminjaman</a></li>
                            <li class="breadcrumb-item active">Buat</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @if (Session::has('error'))
            <div class="btn btn-danger swalDefaultSuccess message-center-top" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('peminjaman.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Buat Peminjaman Harian</h4>
                        </div>
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
                                        <option value="{{ $sw->id }}">{{ $sw->nisn }} - {{ $sw->name }} - {{ $sw->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputStatus">Buku :</label>
                                @error('bukusharians_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <select id="bukuharian" name="bukusharians_id" class="form-control">
                                    <option selected disabled>Pilih Buku</option>
                                    @foreach ($bukuharian as $sw)
                                        <option value="{{ $sw->id }}"
                                            @if ($sw->stok <= 0) disabled @endif>{{ $sw->buku }}
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
                                    placeholder=" Masukkan Jumlah Buku yang di Pinjam" autocomplete="off" min="1" />
                            </div>
                            <!-- Date and time -->
                            <div class="form-group col-md-2">
                                <label>Jam Pinjam :</label>
                                @error('jam_pinjam')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="datetime-local" name="jam_pinjam" class="form-control datetimepicker-input"
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
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="datetime-local" name="jam_kembali"
                                        class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                        autocomplete="off" />
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
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pinjaman
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Pastikan data pinjaman sudah benar!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal
                                                </button>

                                                <button id="btn" class="btn btn-primary profile-button"
                                                    type="submit">
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

        </form>
    @endsection
