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
                            <h1 class="m-0">Peminjaman Tahunan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                <li class="breadcrumb-item active">Peminjaman Tahunan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger float-sm-right" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Reset
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Data Peminjaman Tahunan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus semua data!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal
                                    </button>

                                    <a href="{{ route('peminjamantahunan.removeAll') }}" id="btn"
                                        class="btn btn-primary profile-button">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.content-header -->
                    <div class="alert col-md-7 mt-2 float-sm-right">
                        @if (Session::has('removeAll'))
                            <div class="btn btn-success swalDefaultSuccess" role="alert">
                                {{ Session::get('removeAll') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="btn btn-success swalDefaultSuccess" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="btn btn-danger swalDefaultSuccess" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="btn btn-warning swalDefaultSuccess" role="alert">
                                {{ session('warning') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="btn btn-danger swalDefaultSuccess" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form action="/peminjamantahunan" method="GET">
                        <div class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" name="search" id="form1" class="form-control"
                                    placeholder="Cari Nama/ Kelas/ NISN" autocomplete="off" />
                            </div>
                            <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="breadcrumb mb-3 float-sm-right" role="group" aria-label="Basic example">
                        <a href="{{ route('peminjamantahunan.create') }}" class="btn btn-success  float-sm-right"
                            type="button">
                            <i class="fas fa-plus"></i> Buat Pinjaman
                        </a>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->


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
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamantahunan as $p)
                            @if ($peminjamantahunan->count() > 0)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ optional($p->siswas)->nisn }}</td>
                                    <td>{{ optional($p->siswas)->name }}</td>
                                    <td>{{ optional($p->siswas)->kelas }}</td>
                                    <td>
                                        @foreach ($p->bukus()->get() as $peminjaman)
                                            <ul type=circle>
                                                <li>{{ $peminjaman->bukucruds->buku }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($p->bukus()->get() as $c)
                                            <ul type=circle>
                                                <li>{{ $c->jml_buku }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($p->bukus()->get() as $d)
                                            <ul type=circle>
                                                <li>{{ $d->kodebuku }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    @php
                                        $isOverdue =
                                            \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($p->jam_kembali)) &&
                                            $p->status != 0;
                                    @endphp
                                    <td class="{{ $isOverdue ? 'text-red' : '' }}">
                                        {{ $p->jam_kembali }}
                                    </td>
                                    <td>
                                        <label
                                            class="label 
                                            @if ($p->status == 0) badge bg-success 
                                            @elseif ($p->status == 1) badge bg-danger 
                                            @else badge bg-warning @endif">
                                            @if ($p->status == 0)
                                                Selesai
                                            @elseif ($p->status == 1)
                                                Sedang Meminjam
                                            @else
                                                Butuh Diproses
                                            @endif
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('peminjamantahunan.show', $p->id) }}" type="button"
                                                class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('peminjamantahunan.edit', $p->id) }}" type="button"
                                                class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('peminjamantahunan.destroy', $p->id) }}"
                                                method="POST" type="button" class="btn btn-danger p-0"
                                                onsubmit="return confirm('Delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger m-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endif
                        @empty
                            <div class="alert alert-danger">
                                Data Peminjaman Tahunan belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            @endsection
        </div>

</body>
<script>
    // Otomatis menghilangkan alert setelah 5 detik
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                // Gunakan Bootstrap dismiss
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000); // 5000ms = 5 detik
    });
</script>

</html>
