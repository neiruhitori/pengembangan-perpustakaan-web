<head>
    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Harian</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/peminjaman">Peminjaman</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="profile_setup_frm"
            action="{{ route('peminjaman.update', $peminjaman->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Edit Peminjaman Harian</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <!-- Informasi Peminjam -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Siswa</label>
                                    <select id="siswa_id" name="siswas_id" class="form-control" required>
                                        <option value="">Pilih Siswa</option>
                                        @foreach ($siswa as $siswaa)
                                            <option value="{{ $siswaa->id }}"
                                                {{ $peminjaman->siswas_id == $siswaa->id ? 'selected' : '' }}>
                                                {{ $siswaa->nisn }} - {{ $siswaa->name }} - {{ $siswaa->kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <label>Nama :</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $peminjaman->name }}" /> --}}

                            {{-- <select id="name" name="name" class="form-control">
                                    <option selected disabled>{{ $peminjaman->name }}</option>
                                    @foreach ($siswa as $sw)
                                        <option value="{{ $sw->name }}">{{ $sw->name }}</option>
                                    @endforeach
                                </select> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-md-6">
                                <label for="inputStatus">Kelas :</label>
                                @error('kelas')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <select id="kelas" name="kelas" class="form-control">
                                    <option selected disabled>{{ $peminjaman->kelas }}</option>
                                    <option>VII A</option>
                                    <option>VII B</option>
                                    <option>VII C</option>
                                    <option>VII D</option>
                                    <option>VII E</option>
                                    <option>VII F</option>
                                    <option>VII G</option>
                                    <option>VIII A</option>
                                    <option>VIII B</option>
                                    <option>VIII C</option>
                                    <option>VIII D</option>
                                    <option>VIII E</option>
                                    <option>VIII F</option>
                                    <option>VIII G</option>
                                    <option>IX A</option>
                                    <option>IX B</option>
                                    <option>IX C</option>
                                    <option>IX D</option>
                                    <option>IX E</option>
                                    <option>IX F</option>
                                    <option>IX G</option>
                                </select>
                            </div> --}}
                            <!-- Buku dropdown -->
                            <div class="col-md-6">
                                <label>Buku</label>
                                <select id="bukuharian" name="bukusharians_id" class="form-control" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach ($bukuharian as $sw)
                                        <option value="{{ $sw->id }}"
                                            {{ $peminjaman->bukusharians_id == $sw->id ? 'selected' : '' }}
                                            @if ($sw->stok <= 0) disabled @endif>
                                            {{ $sw->buku }}
                                            @if ($sw->stok <= 0)
                                                (Stok Habis)
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kode Buku dropdown -->
                            <div class="col-md-6">
                                <label>Kode Buku</label>
                                <select id="kodebuku" name="kodebuku" class="form-control" required>
                                    <option value="">Pilih Kode Buku</option>
                                    @foreach ($bukuharian as $buku)
                                        @foreach ($buku->kodebukuharians as $kode)
                                            <option value="{{ $kode->kodebuku }}"
                                                {{ $peminjaman->kodebuku == $kode->kodebuku ? 'selected' : '' }}>
                                                {{ $buku->buku }} - {{ $kode->kodebuku }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Jumlah Buku :</label>
                                <input type="number" class="form-control" id="jml_buku" name="jml_buku"
                                    value="{{ old('jml_buku', $peminjaman->jml_buku) }}" autocomplete="off" />
                            </div>

                            <!-- Datetime inputs -->
                            <div class="col-md-6">
                                <label>Jam Pinjam</label>
                                <input type="datetime-local" name="jam_pinjam" class="form-control"
                                    value="{{ date('Y-m-d\TH:i', strtotime($peminjaman->jam_pinjam)) }}" required />
                            </div>
                            <div class="col-md-6">
                                <label>Jam Kembali</label>
                                <input type="datetime-local" name="jam_kembali" class="form-control"
                                    value="{{ date('Y-m-d\TH:i', strtotime($peminjaman->jam_kembali)) }}" required />
                            </div>
                            <!-- /.form group -->
                            {{-- <div class="col-md-6">
                                <label>Deskripsi :</label>
                                <textarea type="text" class="form-control" id="description" name="description">{{ $peminjaman->description }}</textarea>
                            </div> --}}
                            <div class="col-md-6">
                                <div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fas fa-plus-circle"></i>Ubah
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Simpan Perubahan?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin mengubah data?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal
                                                    </button>

                                                    <button type="submit" class="btn btn-primary waves-light waves-effect"
                                                        id="update-modal">
                                                        Ubah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    @endsection
