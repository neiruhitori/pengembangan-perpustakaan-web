<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">




    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan SMP 02 KLAKAH</title>
    <link rel="shortcut icon" href="{{ asset('AdminLTE-3.2.0/dist/img/smp2.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    @extends('layouts.app')

    @section('title', 'Home Product')

    @section('contents')


        <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selesai Meminjam Harian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                        <li class="breadcrumb-item active">Selesai Meminjam</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
                    <a href="{{ route('selesaimeminjam.pdf') }}" class="btn btn-danger mb-3 breadcrumb float-sm-right">
                        <i class="fa fa-download mb-3 breadcrumb float-sm-right"></i>
                        <p>Cetak PDF</p>
                    </a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Buku</th>
                        <th>Jumlah Buku</th>
                        <th>Kode Buku</th>
                        <th>Jam Pinjam</th>
                        <th>Jam Kembali</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                            @forelse ($selesaimeminjam as $k)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ optional($k->siswas)->nisn }}</td>
                                    <td>{{ optional($k->siswas)->name }}</td>
                                    <td>{{ optional($k->siswas)->kelas }}</td>
                                    <td>{{ optional($k->bukusharians)->buku }}</td>
                                    <td>{{ $k->jml_buku }}</td>
                                    <td>{{ $k->kodebuku }}</td>
                                    <td>{{ $k->jam_pinjam }}</td>
                                    <td>{{ $k->jam_kembali }}</td>
                                    <td>
                                        <label
                                            class="label {{ $k->status == 1 ? 'label-danger' : 'label-success' }}">{{ $k->status == 1 ? 'Sedang Meminjam' : 'Selesai' }}</label>
                                    </td>
                                    
                                </tr>

                            @empty
                                <div class="alert alert-danger">
                                    Data Kategori Repositori belum Tersedia.
                                </div>
                            @endforelse
                    </tbody>
                </table>
                
            @endsection
        </div>

</body>


</html>
