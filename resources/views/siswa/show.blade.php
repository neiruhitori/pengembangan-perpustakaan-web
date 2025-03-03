@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/siswa">Siswa</a></li>
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
                        <div class="container">
                            <div class="card" style="width: 18rem; margin: 0 auto;">
                                {{-- <img src="{{ asset('storage/' . $siswa->foto) }}" class="card-img-top" alt="Foto Siswa"> --}}
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%;">
                                    <h5 class="card-title">{{ $siswa->name }}</h5>
                                    <p class="card-text">
                                        <strong>NISN:</strong> {{ $siswa->nisn }}<br>
                                        <strong>Kelas:</strong> {{ $siswa->kelas }}
                                    </p>
                                    <a href="{{ route('siswa.print', $siswa->id) }}" class="btn btn-primary">Cetak Kartu</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    @endsection
