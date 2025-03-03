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
                            <h1 class="m-0">Catatan Tahunan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                <li class="breadcrumb-item active">Catatan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

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
                    {{-- <a href="{{ route('peminjaman.create') }}" class="btn btn-primary breadcrumb float-sm-right">Add
                        Catatan</a> --}}

                    <form action="/catatantahunan" method="GET">
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
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($catatan as $p)
                            @if ($catatan->count() > 0)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ optional($p->siswas)->nisn }}</td>
                                    <td>{{ optional($p->siswas)->name }}</td>
                                    <td>{{ optional($p->siswas)->kelas }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('catatantahunan.edit', $p->id) }}" type="button"
                                                class="btn btn-warning"><i class="fas fa-plus"></i></a>
                                            <a href="{{ route('catatantahunan.show', $p->id) }}" type="button"
                                                class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <div class="alert alert-danger">
                                Data Catatan Tahunan belum Tersedia.
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
