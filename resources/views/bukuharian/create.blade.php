<head>

    <head>
        <meta charset="UTF-8">
        <title>Form Peminjaman Buku</title>
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

            .book-row {
                margin-bottom: 15px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
        </style>
    </head>
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
                        <h1 class="m-0">Buat Buku</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/bukuharian">Buku Harian</a></li>
                            <li class="breadcrumb-item active">Buat</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form method="post" enctype="multipart/form-data" id="bukuForm" action="{{ route('bukuharian.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Buat buku</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Masukkan Sampul :</label>
                                @error('foto')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="file" class="form-control" name="foto" autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Judul :</label>
                                @error('buku')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" name="buku" placeholder=" Masukkan Nama Buku"
                                    autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Penulis :</label>
                                @error('penulis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" name="penulis"
                                    placeholder=" Masukkan Nama Penulis" autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Penerbit :</label>
                                @error('penerbit')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" name="penerbit"
                                    placeholder=" Masukkan Nama Penerbit" autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Stok :</label>
                                @error('stok')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" name="stok" placeholder=" Masukkan Stok Buku"
                                    autocomplete="off" />
                            </div>
                            <div class="col-md-6">
                                <label>Deskripsi :</label>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <textarea type="text" class="form-control" name="description" autocomplete="off"></textarea>
                            </div>
                            <!-- Daftar Buku -->
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="book-list text-center">
                                            <h4 class="mb-4">Daftar Kode Buku</h4>
                                            <div class="book-row">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Kode Buku</label>
                                                            <input type="text" name="kodebuku[]" class="form-control"
                                                                required placeholder="Masukkan Kode Buku"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-success add-book"
                                                            style="margin-top: 32px">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 untuk kodebuku
                $('.select2-books').select2();

                // Add more books
                $('.add-book').click(function() {
                    // Clone row tanpa events
                    const newRow = $('.book-row').first().clone(false);

                    // Hapus Select2 dari elemen yang di-clone
                    newRow.find('select').each(function() {
                        if ($(this).data('select2')) {
                            $(this).select2('destroy');
                        }
                        $(this).removeClass('select2-hidden-accessible')
                            .find('option').removeAttr('data-select2-id')
                            .end()
                            .removeAttr('data-select2-id')
                            .val('');
                    });

                    // Bersihkan input
                    newRow.find('input').val('');

                    // Hapus semua elemen Select2 yang tersisa
                    newRow.find('.select2-container').remove();

                    // Tambah tombol remove
                    const removeBtn = $(`
            <button type="button" class="btn btn-danger remove-book" style="margin-top: 32px">
                <i class="fas fa-minus"></i>
            </button>
        `);
                    newRow.find('.btn').replaceWith(removeBtn);

                    // Tambahkan row baru
                    $('.book-list').append(newRow);

                    // Inisialisasi ulang Select2 pada row baru
                    newRow.find('.select2-books').select2({
                        width: '100%',
                        dropdownParent: newRow
                    });
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

                $('#bukuForm').submit(function(e) {
                    if (isSubmitting) return;
                    e.preventDefault();
                    $('#confirmationModal').modal('show');
                });

                $('#confirmSubmit').on('click', function() {
                    isSubmitting = true;
                    $('#confirmationModal').modal('hide');
                    setTimeout(function() {
                        $('#bukuForm')[0].submit();
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
                        Pastikan semua data Buku sudah benar!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="confirmSubmit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
