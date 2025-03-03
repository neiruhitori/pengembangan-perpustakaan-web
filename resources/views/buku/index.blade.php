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
                            <h1 class="m-0">Buku Tahunan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                <li class="breadcrumb-item active">Buku Tahunan</li>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Data Buku Tahunan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus semua data!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal
                                    </button>

                                    <a href="{{ route('buku.removeAll') }}" id="btn"
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

                    <form action="/buku" method="GET">
                        <div class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="search" name="search" id="form1" class="form-control"
                                    placeholder="Cari Buku" autocomplete="off" />
                            </div>
                            <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="breadcrumb mb-3 float-sm-right" role="group" aria-label="Basic example">
                        <a href="{{ route('buku.create') }}" class="btn btn-success float-sm-right">Tambah
                            Buku</a>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->


            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Kode Buku</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($buku as $key => $p)
                            @if ($buku->count() > 0)
                                <tr>
                                    <td scope="row">{{ $buku->firstItem() + $key }}</td>
                                    <td>
                                        <img src="{{ asset('gambarbukutahunan/'.$p->foto) }}" alt="" style="width:40px;">
                                    </td>
                                    <td>{{ $p->buku }}</td>
                                    <td>{{ $p->penulis }}</td>
                                    <td>{{ $p->penerbit }}</td>
                                    <td>
                                        <ul>
                                            @foreach($p->kodebukucruds as $kd)
                                                <li>{{ $kd->kodebuku }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $p->stok }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('buku.show', $p->id) }}" type="button"
                                                class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('buku.edit', $p->id) }}" type="button"
                                                class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('buku.destroy', $p->id) }}" method="POST"
                                                type="button" class="btn btn-danger p-0"
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
                                Data Buku Tahunan belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-sm-left">
                    Showing
                    {{ $buku->firstItem() }}
                    to
                    {{ $buku->lastItem() }}
                    of
                    {{ $buku->total() }}
                    entries
                </div>
                <div class="float-sm-right">
                    {{ $buku->links() }}
                </div>
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
