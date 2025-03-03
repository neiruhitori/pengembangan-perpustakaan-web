<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
                        <h1 class="m-0">Detail Tahunan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/peminjamantahunan">Peminjaman Tahunan</a></li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Informasi Peminjam -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NISN</label>
                                        <input type="text" class="form-control"
                                            value="{{ $peminjamantahunan->siswas->nisn }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Siswa</label>
                                        <input type="text" class="form-control"
                                            value="{{ $peminjamantahunan->siswas->name }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <input type="text" class="form-control"
                                            value="{{ $peminjamantahunan->siswas->kelas }}" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <input type="text" class="form-control" id="buku" name="buku"
                                            value="{{ $peminjamantahunan->description }}" disabled />
                                    </div>
                                </div>
                            </div>

                            <!-- Periode Peminjaman -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="date" name="jam_pinjam"
                                                class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                                value="{{ $peminjamantahunan->jam_pinjam }}" disabled />
                                            <div class="input-group-append" data-target="#reservationdatetime"
                                                data-toggle="datetimepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Kembali</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="date" name="jam_kembali"
                                                class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                                value="{{ $peminjamantahunan->jam_kembali }}" disabled />
                                            <div class="input-group-append" data-target="#reservationdatetime"
                                                data-toggle="datetimepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Buku -->
                            <div class="book-list">
                                <h4>Daftar Buku</h4>
                                <div class="book-row">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Sampul:</label>
                                                @foreach ($peminjamantahunan->bukus()->get() as $b)
                                                    <img src="{{ asset('gambarbukutahunan/' . $b->bukucruds->foto) }}"
                                                        alt="" style="width:50px;" class="form-control">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Buku:</label>
                                                @foreach ($peminjamantahunan->bukus()->get() as $b)
                                                    <input type="text" class="form-control" id="buku" name="buku"
                                                        value="{{ $b->bukucruds->buku }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kode Buku</label>
                                                @foreach ($peminjamantahunan->bukus()->get() as $d)
                                                    <input type="text" class="form-control" name="kodebuku"
                                                        value="{{ $d->kodebuku }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Penulis</label>
                                                @foreach ($peminjamantahunan->bukus()->get() as $d)
                                                    <input type="text" class="form-control" name="kodebuku"
                                                        value="{{ $d->bukucruds->penulis }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Penerbit</label>
                                                @foreach ($peminjamantahunan->bukus()->get() as $d)
                                                    <input type="text" class="form-control" name="kodebuku"
                                                        value="{{ $d->bukucruds->penerbit }}" disabled />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                @foreach ($peminjamantahunan->bukus()->get() as $c)
                                                    <input type="text" class="form-control" id="jml_buku"
                                                        name="jml_buku" value="{{ $c->jml_buku }}" disabled />
                                                @endforeach
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
