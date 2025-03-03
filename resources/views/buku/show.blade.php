@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Buku</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/buku">Buku</a></li>
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
                            <h4 class="text-right">Detail Buku</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Sampul :</label>
                                <div>
                                    <img src="{{ asset('gambarbukutahunan/' . $buku->foto) }}" alt=""
                                        style="width:200px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Judul :</label>
                                <input type="text" class="form-control" value="{{ $buku->buku }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Penulis :</label>
                                <input type="text" class="form-control" value="{{ $buku->penulis }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Penerbit :</label>
                                <input type="text" class="form-control" value="{{ $buku->penerbit }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Kode Buku :</label>
                                @foreach ($buku->kodebukucruds()->get() as $b)
                                    <input type="text" class="form-control"
                                        value="{{ $b->kodebuku }}" disabled />
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label>Stok :</label>
                                <input type="number" class="form-control" value="{{ $buku->stok }}" disabled />
                            </div>
                            <div class="col-md-6">
                                <label>Deskripsi :</label>
                                <textarea type="text" class="form-control" disabled>{{ $buku->description }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    @endsection
