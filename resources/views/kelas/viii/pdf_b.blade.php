<!DOCTYPE html>
<html>

<head>
    <title>Data Peminjaman Tahunan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .table-kop {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .table-isi {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #a3a3a3;
            font-size: 10px; /* Ukuran font dikurangi */
            table-layout: fixed; /* Lebar kolom disesuaikan */
        }

        .table-isi th, .table-isi td {
            border: 1px solid #a3a3a3;
            padding: 4px; /* Padding dikurangi */
            text-align: center;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .table-isi th {
            background-color: #898989;
            color: white;
            font-size: 11px;
        }

        .table-isi td:nth-child(2), 
        .table-isi td:nth-child(3) {
            text-align: left;
        }

        .table-ttd {
            width: 100%;
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <table class="table-kop">
        <tr>
            <td width="20%"><img src="AdminLTE-3.2.0/dist/img/smp2.png" width="70%"></td>
            <td width="60%">
                <h3 style="margin: 2px;">PEMERINTAH KABUPATEN LUMAJANG</h3>
                <h3 style="margin: 2px;">DINAS PENDIDIKAN</h3>
                <h2 style="margin: 2px;">SMP NEGERI 02 KLAKAH</h2>
                <b style="font-size: 12px;">Jl. Ranu No.23, Linduboyo, Klakah, Kabupaten Lumajang, Jawa Timur 67356</b>
            </td>
            <td width="20%"><img src="AdminLTE-3.2.0/dist/img/lumajang.png" width="70%"></td>
        </tr>
    </table>

    <hr />
    <h3 style="text-align: center;">Data Peminjaman Tahunan Kelas VIII B</h3>

    <table class="table-isi">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Kode</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($viiib as $a)
                <tr>
                    <td style="width: 5%; text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ optional($a->siswas)->nisn }}</td>
                    <td>{{ optional($a->siswas)->name }}</td>
                    <td>{{ optional($a->siswas)->kelas }}</td>
                    <td>
                        @foreach ($a->bukus()->get() as $b)
                            {{ $b->bukucruds->buku }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($a->bukus()->get() as $c)
                            {{ $c->jml_buku }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($a->bukus()->get() as $d)
                            {{ $d->kodebuku }}<br>
                        @endforeach
                    </td>
                    <td>{{ $a->jam_pinjam }}</td>
                    <td>{{ $a->jam_kembali }}</td>
                    <td>
                        <label>
                            @if ($a->status == 0)
                                Selesai
                            @elseif ($a->status == 1)
                                Pinjam
                            @else
                                Butuh Diproses
                            @endif
                        </label>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" align="center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="table-ttd">
        <tr>
            <td width="70%"></td>
            <td>
                <span>Kepala Perpustakaan</span><br>
                <span>SMPN 02 Klakah</span><br><br><br><br>
                <span>{{ auth()->user()->name }}</span><br>
                <span>NIP. {{ auth()->user()->nip }}</span>
            </td>
        </tr>
    </table>

</body>

</html>
