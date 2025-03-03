<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan SMP 02 KLAKAH</title>
    <link rel="shortcut icon" href="{{ asset('AdminLTE-3.2.0/dist/img/smp2.png') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .custom-container {
            margin-top: 28px;
            /* Geser ke bawah */
            padding: 20px;
            border-radius: 5px;
            /* Radius border untuk sudut melengkung */
        }

        .card-header {
            background-color: #ff9800;
            /* Warna oren cerah */
            color: #fff;
            /* Warna teks putih untuk kontras */
        }

        .event-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .event-item .event-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="container custom-container">
        <div class="card-header">
            <h1 class="card-title"><b>Detail Buku</b></h1>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('gambarbukuharian/' . $bukuharian->foto) }}" class="img-fluid w-100"
                                alt="Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bukuharian->buku }}</h5>
                                <p class="card-text"><strong>Penulis:</strong> {{ $bukuharian->penulis }}</p>
                                <p class="card-text"><strong>Penerbit:</strong> {{ $bukuharian->penerbit }}</p>
                                <p class="card-text"><strong>Stok:</strong> {{ $bukuharian->stok }}</p>
                                <p class="card-text"><strong>Deskripsi:</strong></p>
                                <p class="card-text">{{ $bukuharian->description }}</p>
                                <div class="container-fluid event py-3">
                                    <div class="event-carousel owl-carousel">
                                        <div class="event-item">
                                            <div class="event-content p-4">
                                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                    href="{{ route('untuksiswa.pinjamharian.create') }}">Pinjam
                                                    Buku</a>
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
    </div>
</body>

</html>
