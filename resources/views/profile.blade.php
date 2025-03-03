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
                        <h1 class="m-0">Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile.update') }}">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <!-- /.content-header -->
                        <div class="alert">
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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">

                            <div class="col-md-6">
                                <label class="labels">ID Perpustakaan</label>
                                <input type="text" name="perpustakaan_id" disabled class="form-control"
                                    placeholder="ID Perpustakaan" value="{{ auth()->user()->perpustakaan_id }}"
                                    autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">NIP</label>
                                <input type="text" name="nip" class="form-control" placeholder="NIP"
                                    value="{{ auth()->user()->nip }}" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Baru"
                                    value="{{ auth()->user()->name }}" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Email</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ auth()->user()->email }}" placeholder="Email tidak wajib diisi"
                                    autocomplete="off">
                            </div>
                            {{-- <div class="col-md-6">
                                <label for="photoProfile" class="">Tambah Foto Profile</label>
                                <div class="custom-file">
                                    <input type="file" name="photoProfile" id="photoProfile"
                                        value="{{ old('photoProfile', $profile->photoProfile) }}">
                                </div>
                            </div> --}}
                        </div>

                        <center>
                            <p>Peringatan setiap Anda mengubah <b>Nama</b>, <b>Email</b> dan <b>Password</b>.<br>
                                Anda perlu memasukan <b>Password lama</b> atau <b>Password baru</b> anda terlebih dahulu di
                                <b>Changes Password!</b>
                            </p>
                        </center>
                        <div class="mt-5 text-center">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Save Profil
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Perubahan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="labels">Password Saat Ini</label>
                                                <input type="password" name="current_password" class="form-control"
                                                    placeholder="Masukkan password saat ini" id="currentPass" required>
                                                <div class="form-text text-danger">* Wajib diisi untuk konfirmasi perubahan
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="labels">Password Baru (Optional)</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Masukkan password baru" id="newPass">
                                                <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                                            </div>

                                            <div class="mb-3">
                                                <input type="checkbox" onclick="showPasswords()"> Show Passwords
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button id="btn" class="btn btn-primary profile-button"
                                                type="submit">Save Profile</button>
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

    <script>
        function showPasswords() {
            var currentPass = document.getElementById("currentPass");
            var newPass = document.getElementById("newPass");

            if (currentPass.type === "password") {
                currentPass.type = "text";
                newPass.type = "text";
            } else {
                currentPass.type = "password";
                newPass.type = "password";
            }
        }

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
@endsection
