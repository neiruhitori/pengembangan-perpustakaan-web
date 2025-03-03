<head>
    <style>
        .message-center-top {
            position: fixed;
            left: 55%;
            transform: translateX(-50%);
            z-index: 100;
            width: 50%;
            text-align: center;
        }

        .error {
            color: red;
            font-size: 0.875em;
        }

        .book-row {
            justify-content-center;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
                        <h1 class="m-0">Detail Catatan Tahunan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/catatantahunan">Catatan</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Detail Catatan Tahunan</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>NISN :</label>
                                <input type="text" class="form-control" value="{{ $catatan->siswas->nisn }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Nama :</label>
                                <input type="text" class="form-control" value="{{ $catatan->siswas->name }}" disabled />
                            </div>

                            <div class="col-md-6">
                                <label>Kelas :</label>
                                <input type="text" class="form-control" value="{{ $catatan->siswas->kelas }}" disabled />
                            </div>
                            <!-- Daftar Buku -->
                            <!-- Ubah struktur div di bagian daftar buku -->
                            <div class="container">
                                <h4>Daftar Buku</h4>
                                <div class="book-row">
                                    <div class="row justify-content-center g-3">
                                        <!-- Tambahkan justify-content-center dan g-3 untuk spacing -->
                                        <div class="col-12 col-md-2"> <!-- Ubah ukuran kolom -->
                                            <div class="form-group">
                                                <label>Sampul :</label>
                                                @foreach ($catatan->bukus()->get() as $b)
                                                    <img src="{{ asset('gambarbukutahunan/' . $b->bukucruds->foto) }}"
                                                        alt="" style="width:50px;" class="form-control">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group">
                                                <label>Buku :</label>
                                                @foreach ($catatan->bukus()->get() as $b)
                                                    <input type="text" class="form-control"
                                                        value="{{ $b->bukucruds->buku }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group">
                                                <label>Penulis :</label>
                                                @foreach ($catatan->bukus()->get() as $b)
                                                    <input type="text" class="form-control"
                                                        value="{{ $b->bukucruds->penulis }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group">
                                                <label>Penerbit :</label>
                                                @foreach ($catatan->bukus()->get() as $b)
                                                    <input type="text" class="form-control"
                                                        value="{{ $b->bukucruds->penerbit }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group">
                                                <label>Kode Buku :</label>
                                                @foreach ($catatan->bukus()->get() as $b)
                                                    <input type="text" class="form-control" value="{{ $b->kodebuku }}"
                                                        disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group">
                                                <label>Jumlah Buku :</label>
                                                @foreach ($catatan->bukus()->get() as $b)
                                                    <input type="text" class="form-control" value="{{ $b->jml_buku }}"
                                                        disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Deskripsi :</label>
                                <input type="text" class="form-control" value="{{ $catatan->description }}" disabled />
                            </div>
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Tanggal Pinjam :</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="date-local" name="jam_pinjam" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime" value="{{ $catatan->jam_pinjam }}" disabled />
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
                                    <input type="date-local" name="jam_kembali" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime" value="{{ $catatan->jam_kembali }}" disabled />
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
    @endsection
