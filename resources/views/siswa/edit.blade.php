<head>
    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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
                        <h1 class="m-0">Edit Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/siswa">Siswa</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="profile_setup_frm"
            action="{{ route('siswa.update', $siswa->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Edit Siswa</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>NISN :</label>
                                <input type="text" class="form-control" name="nisn"
                                    value="{{ $siswa->nisn }}" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label>Nama :</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $siswa->name }}" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label for="inputStatus">Kelas :</label>
                                @error('kelas')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <select id="kelas" name="kelas" class="form-control custom-select">
                                  <option selected disabled>{{ $siswa->kelas }}</option>
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
                              </div>
                            <div class="col-md-6 mt-2">
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
                                                    Apakah anda yakin ingin merubah data?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal
                                                    </button>

                                                    <button type="submit" class="btn btn-primary waves-light waves-effect" id="update-modal">
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
