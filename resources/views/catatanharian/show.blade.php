@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Catatan Harian</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/catatanharian">Catatan</a></li>
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
                            <h4 class="text-right">Detail Catatan Harian</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>NISN :</label>
                                    <input type="text" class="form-control"
                                        value="{{ $catatan->siswas->nisn }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Nama :</label>
                                    <input type="text" class="form-control"
                                        value="{{ $catatan->siswas->name }}" disabled />
                            </div>

                            <div class="col-md-6">
                                <label>Kelas :</label>
                                    <input type="text" class="form-control"
                                        value="{{ $catatan->siswas->kelas }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Sampul :</label>
                                <div>
                                    <img src="{{ asset('gambarbukuharian/' . $catatan->bukusharians->foto) }}" alt="" style="width:200px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Buku :</label>
                                <input type="text" class="form-control"
                                    value="{{ $catatan->bukusharians->buku }}" disabled/>
                            </div>
                            <div class="col-md-6">
                                <label>Penulis :</label>
                                <input type="text" class="form-control" value="{{ $catatan->bukusharians->penulis }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Penerbit :</label>
                                <input type="text" class="form-control" value="{{ $catatan->bukusharians->penerbit }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Deskripsi :</label>
                                <textarea type="text" class="form-control" disabled>{{ $catatan->description }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Kode Buku :</label>
                                <input type="text" class="form-control"
                                    value="{{ $catatan->kodebuku }}" disabled/>
                            </div>
                            <div class="col-md-6">
                                <label>Jumlah Buku :</label>
                                <input type="text" class="form-control"
                                value="{{ $catatan->jml_buku }}" disabled />
                            </div>
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Jam Pinjam :</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="datetime-local" name="jam_pinjam" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime" value="{{ $catatan->jam_pinjam }}" disabled/>
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
                                    <input type="datetime-local" name="jam_kembali" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime" value="{{ $catatan->jam_kembali }}" disabled/>
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                        data-toggle="datetimepicker">
                                    </div>
                                </div>
                            </div>
                            <!-- /.form group -->
                            {{-- <div class="col-md-6">
                                <label>Deskripsi :</label>
                                <textarea class="form-control" id="description" name="description"
                                 disabled >{{ $catatan->description }}</textarea>
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>

        </form>
    @endsection
