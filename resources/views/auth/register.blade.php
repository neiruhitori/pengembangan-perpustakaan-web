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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ asset('AdminLTE-3.2.0/index2.html') }}" class="h1"><b>Register Account</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ route('register.save') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" name="perpustakaan_id" id="perpustakaan_id" class="form-control from-control-user @error('perpustakaan_id')is-invalid @enderror" placeholder="ID Perpustakaan" autocomplete="off">
                        @error('perpustakaan_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="name" id="username" class="form-control from-control-user @error('name')is-invalid @enderror" placeholder="Nama" autocomplete="off">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <input type="email" name="email" id="emailaddress" class="form-control from-control-user @error('email')is-invalid @enderror" placeholder="Email" autocomplete="off">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control from-control-user @error('password')is-invalid @enderror"
                            placeholder="Password" autocomplete="off">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" onclick="ShowSub()">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div> --}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="MySub">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>

    <script>
        function ShowSub() {
            var x = document.getElementById("MySub");
            if (x.type === "submit") {
                x.type = "submit";
            } else {
                x.type = "false";
            }
        }
    </script>
</body>

</html>
