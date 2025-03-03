<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Perpustakaan SMP 02 KLAKAH</title>
    <link rel="shortcut icon" href="{{ asset('AdminLTE-3.2.0/dist/img/smp2.png') }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('environs-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('environs-1.0.0/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('environs-1.0.0/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('environs-1.0.0/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Peminjaman Harian</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <!-- /.content-header -->
                <div class="col-md-7 mt-2 float-sm-right">
                    @if (Session::has('removeAll'))
                        <div class="btn btn-success swalDefaultSuccess" role="alert">
                            {{ Session::get('removeAll') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="btn btn-success swalDefaultSuccess" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                </div>

                <form action="{{ route('untuksiswa.pinjamharian.index') }}" method="GET">
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
                <div class="mb-3">
                    <a href="{{ route('untuksiswa.pinjamharian.create') }}" class="btn btn-primary float-sm-right">Tambah
                        Peminjaman</a>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.row -->
        <!-- /.container-fluid -->


        <div class="card-body">
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
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($peminjaman as $key => $p) --}}
                    @forelse ($peminjaman as $p)
                        @if ($peminjaman->count() > 0)
                            <tr>
                                {{-- <td scope="row">{{ $peminjaman->firstItem() + $key }}</td> --}}
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ optional($p->siswas)->name }}</td>
                                <td>{{ optional($p->siswas)->kelas }}</td>
                                <td>{{ optional($p->bukusharians)->buku }}</td>
                                <td>{{ $p->jml_buku }}</td>
                                <td>{{ $p->kodebuku }}</td>
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
                                        <a href="{{ route('untuksiswa.pinjamharian.show', $p->id) }}" type="button"
                                            class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                    </div>

                                </td>
                            </tr>
                        @endif
                    @empty
                        <div class="alert alert-danger">
                            Data Peminjaman Harian belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    @include('untuksiswa.js')

</body>

</html>
