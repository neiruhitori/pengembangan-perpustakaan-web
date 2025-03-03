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

    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!--CSS-->
    <style>
        .text-red {
            color: #dc3545 !important;
        }
    </style>
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
                            <h1 class="m-0">Pengembalian Harian</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                <li class="breadcrumb-item active">Pengembalian</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    @if (Session::has('success'))
                        <div class="btn btn-success swalDefaultSuccess" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <a href="{{ route('pengembalian.pdf') }}" class="btn btn-danger mb-3 breadcrumb float-sm-right"
                        hidden>Export
                        Pengembalian</a>
                    <form action="/pengembalian" method="GET">
                        <div class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" name="search" id="form1" class="form-control"
                                    placeholder="Cari Nama atau Kelas" autocomplete="off" />
                            </div>
                            <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <!-- index.blade.php - update tabel dan tambah modal -->
                <table id="example1" class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Buku</th>
                        <th>Jumlah Buku</th>
                        <th>Kode Buku</th>
                        <th>Jam Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengembalian as $k)
                            @if ($pengembalian->count() > 0)
                                @php
                                    $isOverdue =
                                        \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($k->jam_kembali)) &&
                                        $k->status != 0;
                                    $lateDays = $isOverdue
                                        ? \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($k->jam_kembali))
                                        : 0;
                                    $lateFine = $lateDays * 500;
                                @endphp
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ optional($k->siswas)->name }}</td>
                                    <td>{{ optional($k->siswas)->kelas }}</td>
                                    <td>{{ optional($k->bukusharians)->buku }}</td>
                                    <td>{{ $k->jml_buku }}</td>
                                    <td>{{ $k->kodebuku }}</td>
                                    <td class="{{ $isOverdue ? 'text-red' : '' }}">
                                        {{ $k->jam_kembali }}
                                    </td>
                                    <td>
                                        <label
                                            class="label 
                            @if ($k->status == 0) badge bg-success 
                            @elseif ($k->status == 1) badge bg-danger 
                            @else badge bg-warning @endif">
                                            @if ($k->status == 0)
                                                Selesai
                                            @elseif ($k->status == 1)
                                                Sedang Meminjam
                                            @else
                                                Butuh Diproses
                                            @endif
                                        </label>
                                    </td>
                                    <td>
                                        @if ($k->description)
                                            <span class="text-danger">{{ $k->description }}</span>
                                        @elseif($isOverdue)
                                            <span class="text-danger">Estimasi denda: Rp
                                                {{ number_format($lateFine, 0, ',', '.') }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="close">
                                            @if ($k->status == 1 || $k->status == 2)
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#returnModal{{ $k->id }}">
                                                    Selesai
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Modal Pengembalian -->
                                        <div class="modal fade" id="returnModal{{ $k->id }}" tabindex="-1"
                                            aria-labelledby="returnModalLabel{{ $k->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="returnModalLabel{{ $k->id }}">
                                                            Konfirmasi Pengembalian
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('pengembalian.status', $k->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <p>Harap periksa kelengkapan dan kondisi buku sebelum proses
                                                                pengembalian.</p>

                                                            @if ($isOverdue)
                                                                <div class="alert alert-warning">
                                                                    <p>Buku terlambat {{ $lateDays }} hari</p>
                                                                    <p>Denda keterlambatan: Rp
                                                                        {{ number_format($lateFine, 0, ',', '.') }}</p>
                                                                </div>
                                                            @endif

                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="is_damaged" id="isDamaged{{ $k->id }}">
                                                                <label class="form-check-label"
                                                                    for="isDamaged{{ $k->id }}">
                                                                    Buku rusak atau hilang (Denda Rp 50.000)
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Proses Pengembalian
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <div class="alert alert-danger">
                                Data Pengembalian Harian belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>

    </body>


    </html>
