<head>

    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .message-center-top {
            position: fixed;
            left: 55%;
            transform: translateX(-50%);
            z-index: 100;
            width: 50%;
            text-align: center;
        }

        .error {
            color: red;
            font-size: 0.875em;
        }

        .book-list {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #2c3338;
            border-radius: 8px;
            margin-top: 20px;
        }

        .book-row {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            background-color: #383f45;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: none;
        }

        .book-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .book-row .btn-group {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }
    </style>
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
                        <h1 class="m-0">Edit Buku</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/bukuharian">Buku Harian</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="peminjamanForm"
            action="{{ route('bukuharian.update', $bukuharian->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Edit Buku</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            @error('foto')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-md-6">
                                <label>Sampul :</label>
                                @if ($bukuharian->foto)
                                    <div>
                                        <img src="{{ asset('gambarbukuharian/' . $bukuharian->foto) }}" alt=""
                                            style="width:100">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="foto" value=""
                                    autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Judul :</label>
                                <input type="text" class="form-control" name="buku" value="{{ $bukuharian->buku }}"
                                    autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Penulis :</label>
                                <input type="text" class="form-control" name="penulis" value="{{ $bukuharian->penulis }}"
                                    autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Penerbit :</label>
                                <input type="text" class="form-control" name="penerbit"
                                    value="{{ $bukuharian->penerbit }}" autocomplete="off" />
                            </div>
                            <!-- Daftar Buku -->
                            <div class="book-list">
                                <h4>Daftar Buku</h4>
                                @foreach ($bukuharian->kodebukuharians as $index => $selectedBuku)
                                    <div class="book-row">
                                        <div class="form-group">
                                            <label>Kode Buku</label>
                                            <input type="text" class="form-control" name="kodebuku[]"
                                                value="{{ $selectedBuku->kodebuku }}" autocomplete="off">
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success add-book">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger remove-book">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Stok :</label>
                            <input type="number" class="form-control" name="stok" value="{{ $bukuharian->stok }}"
                                autocomplete="off" />
                        </div>
                        <div class="col-md-6">
                            <label>Deskripsi :</label>
                            <textarea type="text" class="form-control" name="description" autocomplete="off">{{ $bukuharian->description }}</textarea>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    </form>
    <script>
        $(document).ready(function() {

            // Add more books
            $('.add-book').click(function() {
                const newRow = $('.book-row').first().clone(false);

                // Bersihkan input
                newRow.find('input').val('');

                // Tambah tombol remove
                const removeBtn = $(`
                    <button type="button" class="btn btn-danger remove-book">
                        <i class="fas fa-minus"></i>
                    </button>
                `);
                newRow.find('.btn-danger').replaceWith(removeBtn);

                // Tambahkan row baru
                $('.book-list').append(newRow);
            });

            // Remove book row
            $(document).on('click', '.remove-book', function() {
                const row = $(this).closest('.book-row');
                row.find('select').each(function() {
                    if ($(this).data('select2')) {
                        $(this).select2('destroy');
                    }
                });
                row.remove();
            });

            // Form validation
            let isSubmitting = false;

            $('#peminjamanForm').submit(function(e) {
                if (isSubmitting) return;
                e.preventDefault();
                $('#confirmationModal').modal('show');
            });

            $('#confirmSubmit').on('click', function() {
                isSubmitting = true;
                $('#confirmationModal').modal('hide');
                setTimeout(function() {
                    $('#peminjamanForm')[0].submit();
                }, 500);
            });

            // Modal cleanup
            $('#confirmationModal').on('hidden.bs.modal', function() {
                isSubmitting = false;
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        });
    </script>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Pastikan semua data buku sudah benar!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
