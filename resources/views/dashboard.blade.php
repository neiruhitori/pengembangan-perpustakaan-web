@extends('layouts.app')

@section('title', 'Dashboard - Laravel Admin Panel With Login and Registration')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Beranda</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li> --}}
                            <li class="breadcrumb-item active">Beranda</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><a href="/siswa" class="fas fa-users"></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Siswa</span>
                                <span class="info-box-number">{{ $user }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><a href="/pengembalian" class="fas fa-users-cog"></a></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Data Harian</span>
                                <span class="info-box-number">{{ $siswa }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><a href="/sedangmeminjam" class="fas fa-user-plus"></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sedang Meminjam</span>
                                <span class="info-box-number">{{ $pengembalian }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><a href="/selesaimeminjam" class="fas fa-hand-holding-medical"></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Selesai Meminjam</span>
                                <span class="info-box-number">{{ $selesai }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><a href="/bukuharian" class="fas fa-book-open"></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Buku</span>
                                <span class="info-box-number">{{ $buku }} Buku</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><a href="/pengembaliantahunan" class="fas fa-user-cog"></a></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Data Tahunan</span>
                                <span class="info-box-number">{{ $siswatahunan }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><a href="/sedangmeminjamtahunan" class="fas fa-user-plus"></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sedang Meminjam</span>
                                <span class="info-box-number">{{ $pengembaliantahunan }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><a href="/selesaimeminjamtahunan" class="fas fa-hand-holding-medical"></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Selesai Meminjam</span>
                                <span class="info-box-number">{{ $selesaitahunan }} Siswa</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/smp2.png') }}" width="160px" height="160px"
                        style="display: block; margin-left: auto; margin-right: auto; margin-top: 30px; margin-bottom: -20px;">


                </div>
                <br>
                <h2 class="text-center" style="font-family: Quicksand, sans-serif;">Perpustakaan SMPN 02 Klakah</h2>
                <p class="text-center">Alamat : Jl. Ranu No.23, Linduboyo, Klakah, Kec. Klakah, Kabupaten Lumajang, Jawa
                    Timur</p>
                <!-- /.row -->


                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
