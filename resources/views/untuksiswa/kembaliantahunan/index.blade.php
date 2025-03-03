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
                        <h1 class="m-0">Pengembalian Tahunan</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if (Session::has('success'))
                    <div class="btn btn-success swalDefaultSuccess" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <form action="{{ route('untuksiswa.kembaliantahunan.index') }}" method="GET">
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
            <table id="example1" class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Kode Pinjam</th>
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
                    @forelse ($pengembaliantahunan as $k)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $k->kode_pinjam }}</td>
                            <td>{{ optional($k->siswas)->name }}</td>
                            <td>{{ optional($k->siswas)->kelas }}</td>
                            <td>
                                @foreach ($k->bukus()->get() as $peminjaman)
                                    <ul type=circle>
                                        <li>{{ $peminjaman->bukucruds->buku }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($k->bukus()->get() as $c)
                                    <ul type=circle>
                                        <li>{{ $c->jml_buku }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($k->bukus()->get() as $d)
                                    <ul type=circle>
                                        <li>{{ $d->kodebuku }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            {{-- Dibawah Ini adalah Logika untuk membuat text pada jam_kembali berwarna merah jika melebihi batas tanggal --}}
                            @php
                                $isOverdue =
                                    \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($k->jam_kembali)) &&
                                    $k->status != 0;
                            @endphp
                            <td class="{{ $isOverdue ? 'text-red' : '' }}">
                                {{ $k->jam_kembali }}
                            </td>
                            {{-- =========================================================================================================== --}}
                            {{-- <td>
                                    <label
                                        class="label {{ $k->status == 1 ? 'badge bg-danger' : 'badge bg-success' }}">{{ $k->status == 1 ? 'Sedang Meminjam' : 'Selesai' }}</label>
                                </td> --}}
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
                                <div class="btn-group" role="group" aria-label="close">
                                    @if ($k->status == 1 || $k->status == 2)
                                        <!-- Tanpa Modal -->
                                        <a href="{{ route('untuksiswa.kembaliantahunan.status', $k->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Harap periksa terlebih dahulu kelengkapan buku dan kondisi buku sebelum proses pengembalian selesai!')">Kembalikan</a>
                                        <!-- Tanpa Modal End -->
                                    @else
                                        {{-- <a href="" class="btn btn-sm btn-success">Meminjam</a> --}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Pengembalian Tahunan belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    @include('untuksiswa.js')

</body>

</html>
