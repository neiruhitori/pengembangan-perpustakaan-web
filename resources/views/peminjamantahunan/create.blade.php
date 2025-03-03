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

@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Buat Tahunan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item active"><a href="/peminjamantahunan">Peminjaman Tahunan</a></li>
                            <li class="breadcrumb-item active">Buat</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form id="peminjamanForm" method="post" action="{{ route('peminjamantahunan.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Peminjaman Buku Tahunan</h3>
                        </div>
                        <div class="card-body">
                            <!-- Informasi Peminjam -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Siswa</label>
                                        <select name="siswas_id" class="form-control select2" required>
                                            <option value="">Pilih Siswa</option>
                                            @foreach ($siswa as $s)
                                                <option value="{{ $s->id }}" data-nisn="{{ $s->nisn }}"
                                                    data-kelas="{{ $s->kelas }}">
                                                    {{ $s->nisn }} - {{ $s->name }} - {{ $s->kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Periode Peminjaman -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="jam_pinjam" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Kembali</label>
                                        <input type="date" name="jam_kembali" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Buku -->
                            <div class="book-list">
                                <h4>Daftar Buku</h4>
                                <div class="book-row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Buku</label>
                                                <select name="bukucruds_id[]" class="form-control select2-books" required>
                                                    <option value="">Pilih Buku</option>
                                                    @foreach ($bukucrud as $buk)
                                                        <option value="{{ $buk->id }}" data-stok="{{ $buk->stok }}">
                                                            {{ $buk->buku }} (Stok: {{ $buk->stok }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kode Buku</label>
                                                <select name="kodebuku[]" class="form-control select2-books" required>
                                                    <option value="">Pilih Kode Buku</option>
                                                    @foreach ($bukucrud as $buku)
                                                        @foreach ($buku->kodebukucruds as $kode)
                                                            <option value="{{ $kode->kodebuku }}">{{ $buku->buku }}
                                                                -
                                                                {{ $kode->kodebuku }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" name="jml_buku[]" class="form-control" min="1"
                                                    required>
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

                            <div class="row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for student selection with proper event handling
            $('select[name="siswas_id"]').select2({
                placeholder: 'Pilih Siswa',
                allowClear: true
            });

            // Inisialisasi Select2 untuk buku
            $('.select2-books').select2();

            // Load kode buku when book is selected
            $(document).on('change', 'select[name="bukucruds_id[]"]', function() {
                const bookId = $(this).val();
                const kodebukuSelect = $(this).closest('.row').find('select[name="kodebuku[]"]');
                const jmlInput = $(this).closest('.row').find('input[name="jml_buku[]"]');
                const maxStok = $(this).find(':selected').data('stok');

                jmlInput.attr('max', maxStok);

                if (bookId) {
                    $.get(`/api/buku/${bookId}/kode`, function(data) {
                        kodebukuSelect.empty();
                        kodebukuSelect.append('<option value="">Pilih Kode Buku</option>');
                        data.forEach(function(item) {
                            kodebukuSelect.append(
                                `<option value="${item.kodebuku}">${item.kodebuku}</option>`
                            );
                        });
                    });
                }
            });

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
                    <h5 class="modal-title">Konfirmasi Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Pastikan semua data peminjaman sudah benar!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
