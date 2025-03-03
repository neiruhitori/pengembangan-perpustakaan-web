<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Bukucrud;
use App\Models\Bukusharian;
use App\Models\Peminjaman;
use App\Models\PeminjamanTahunan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UntukSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::count();
        $bukuh = Bukusharian::count();
        $bukut = Bukucrud::count();
        $harian = Peminjaman::count();
        $tahunan = PeminjamanTahunan::count();

        $totalBuku = $bukuh + $bukut;

        return view('/untuksiswa', ['bukuh' => $bukuh, 'bukut' => $bukut, 'totalBuku' => $totalBuku, 'siswa' => $siswa, 'harian' => $harian, 'tahunan' => $tahunan]);
    }
    // PEMINJAMAN HARIAN===================================================================
    public function pinjamharian(Request $request)
    {
        $keyword = $request->input('search');
        if ($request->has('search')) {
            $peminjaman = Peminjaman::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $peminjaman = Peminjaman::latest()->paginate(35);
        }
        return view('untuksiswa.pinjamharian.index', compact('peminjaman'));
    }

    public function pinjamhariancreate()
    {
        $peminjaman = Peminjaman::all();
        $siswa = Siswa::all();
        $bukuharian = Bukusharian::with('kodebukuharians')->get();
        return view('untuksiswa.pinjamharian.create', compact('peminjaman', 'siswa', 'bukuharian'));
    }

    public function pinjamharianstore(Request $request)
    {
        $this->validate($request, [
            'siswas_id' => 'required|min:1|max:50',
            'bukusharians_id' => 'required|min:1|max:50',
            'jml_buku' => 'required|min:1|max:50',
            'jam_pinjam' => 'required:true',
            'jam_kembali' => 'required:true',
            'kodebuku' => 'required:true',
        ]);

        // Ambil data buku
        $bukuharian = Bukusharian::findOrFail($request->bukusharians_id);

        // Cek stok buku
        if ($bukuharian->stok < $request->jml_buku) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
        }

        // Kurangi stok buku
        $bukuharian->stok -= $request->jml_buku;
        $bukuharian->save();

        // Simpan data peminjaman

        Peminjaman::create([
            'siswas_id' => $request->siswas_id,
            'bukusharians_id' => $request->bukusharians_id,
            'kodebuku' => json_encode($request->kodebuku), // Simpan kode buku dalam format JSON
            'jml_buku' => $request->jml_buku,
            'jam_pinjam' => $request->jam_pinjam,
            'jam_kembali' => $request->jam_kembali,
            'description' => $request->description
        ]);
        return redirect('/untuksiswa')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function pinjamharianshow(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $siswa = Siswa::all();
        return view('untuksiswa.pinjamharian.show', compact('peminjaman', 'siswa'));
    }

    // ===================================================================================
    // Kembalian Harian====================================================================
    public function Kembalianharian(Request $request)
    {
        $keyword = $request->input('search');
        if ($request->has('search')) {
            $pengembalian = Peminjaman::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $pengembalian = Peminjaman::latest()->paginate(35);
        }
        return view('untuksiswa.kembalianharian.index', compact('pengembalian'));
    }

    public function kembalianharianstatus($id)
    {
        $pengembalian = Peminjaman::where('id', $id)->update([
            'status'=>2
        ]);
        return redirect()->route('untuksiswa', compact('pengembalian'))->with('success', 'Peminjaman selesai successfully');
    }
        
    // =====================================================================================
    // PEMINJAMAN TAHUNAN===================================================================
    public function pinjamtahunan(Request $request)
    {   $keyword = $request->input('search');
        if ($request->has('search')) {
            $peminjamantahunan = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $peminjamantahunan = PeminjamanTahunan::latest()->paginate(35);
        }
        return view('untuksiswa.pinjamtahunan.index', compact('peminjamantahunan'));
    }

    public function pinjamtahunancreate()
    {
        $peminjamantahunan = PeminjamanTahunan::all();
        $siswa = Siswa::all();
        return view('untuksiswa.pinjamtahunan.create', compact('peminjamantahunan', 'siswa'));
    }

    public function pinjamtahunanstore(Request $request)
    {
        $this->validate($request, [
            'kls' => 'required:true',
            'absen' => 'required:true',
            'tgl' => 'required:true',
            'siswas_id' => 'required:true',
            'jam_pinjam' => 'required:true',
            'jam_kembali' => 'required:true',
        ]);

        $kode_pinjam = $request->kls . '' . $request->absen . '-' . $request->tgl;
        $siswas_id = $request->siswas_id;
        $jam_pinjam = $request->jam_pinjam;
        $jam_kembali = $request->jam_kembali;
        $description = $request->description;

        // Simpan ke database
        $yourModel = new PeminjamanTahunan();
        $yourModel->kode_pinjam = $kode_pinjam;
        $yourModel->siswas_id = $siswas_id;
        $yourModel->jam_pinjam = $jam_pinjam;
        $yourModel->jam_kembali = $jam_kembali;
        $yourModel->description = $description;
        $yourModel->save();

        return redirect()->route('untuksiswa.pinjamtahunan.addbuku')->with('success', 'Data Berhasil di Tambahkan');;
    }

    public function pinjamtahunanaddbuku()
    {
        $peminjamantahunanbuku = PeminjamanTahunan::all();
        $siswa = Siswa::all();
        $bukucrud = Bukucrud::all();
        return view('untuksiswa.pinjamtahunan.addbuku', compact('peminjamantahunanbuku', 'bukucrud', 'siswa'));
    }

    public function pinjamtahunanaddbukustore(Request $request)
    {
        $this->validate($request, [
            'peminjamantahunan_id' => 'required|array|min:1|max:50',
            'bukucruds_id' => 'required|array|min:1|max:50',
            'jml_buku' => 'required|array',
            'kodebuku' => 'required|array',
        ]);
    
        $peminjamantahunan_id = $request->peminjamantahunan_id;
        $bukucruds_id = $request->bukucruds_id;
        $kodebuku = $request->kodebuku;
        $jml_buku = $request->jml_buku;
    
        DB::beginTransaction();
    
        try {
            foreach ($kodebuku as $i => $kode) {
                $buku = Bukucrud::find($bukucruds_id[$i]);
    
                if (!$buku) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Buku tidak ditemukan.');
                }
    
                if ($buku->stok < $jml_buku[$i]) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
                }
    
                // Kurangi stok
                $buku->stok -= $jml_buku[$i];
                $buku->save();
    
                Buku::create([
                    'peminjamantahunan_id' => $peminjamantahunan_id[$i],
                    'bukucruds_id' => $bukucruds_id[$i],
                    'kodebuku' => $kode,
                    'jml_buku' => $jml_buku[$i],
                ]);
            }
    
            DB::commit();
            return redirect('/untuksiswa')->with('success', 'Data Berhasil di Tambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data.');
        }
        return redirect('/untuksiswa')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function pinjamtahunanshow(string $id)
    {
        $peminjamantahunan = PeminjamanTahunan::findOrFail($id);
        return view('untuksiswa.pinjamtahunan.show', compact('peminjamantahunan'));
    }
    // ======================================================================================
    // Kembalian TAHUNAN====================================================================
    public function Kembaliantahunan(Request $request)
    {
        $keyword = $request->input('search');
        if ($request->has('search')) {
            $pengembaliantahunan = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $pengembaliantahunan = PeminjamanTahunan::latest()->paginate(35);
        }
        return view('untuksiswa.kembaliantahunan.index', compact('pengembaliantahunan'));
    }

    public function kembaliantahunanstatus($id)
    {
        $pengembaliantahunan = PeminjamanTahunan::where('id', $id)->update([
            'status'=>2
        ]);
        return redirect()->route('untuksiswa', compact('pengembaliantahunan'))->with('success', 'Peminjaman selesai successfully');
    }
        
    // =====================================================================================

    public function daftarbuku()
    {
        return view('untuksiswa.daftarbuku.index');
    }
    
    // BUKU HARIAN==========================================================================
    public function daftarbukuharian(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $bukuharian = Bukusharian::where('buku', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%")
                         ->paginate(8);
        } else {
            $bukuharian = Bukusharian::paginate(8);
        }
        $events = Bukusharian::take(4)->get();
        // $bukuharian = Bukusharian::all();
        return view('untuksiswa.daftarbuku.harian.index', compact('bukuharian', 'events'));
    }

    public function daftarbukuhariansearch(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $bukuharian = Bukusharian::where('buku', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%")
                         ->paginate(8);
        } else {
            $bukuharian = Bukusharian::paginate(8);
        }
        $events = Bukusharian::take(4)->get();

        return view('untuksiswa.daftarbuku.harian.index', compact('bukuharian', 'events'));
    }

    public function daftarbukuharianlihat(string $id)
    {
        $bukuharian = Bukusharian::findOrFail($id);
        return view('untuksiswa.daftarbuku.harian.lihat', compact('bukuharian'));
    }
    // =======================================================================================
    
    // BUKU TAHUNAN============================================================================
    public function daftarbukutahunan(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $bukutahunan = Bukucrud::where('buku', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%")
                         ->paginate(8);
        } else {
            $bukutahunan = Bukucrud::paginate(8);
        }
        $events = Bukucrud::take(4)->get();
        return view('untuksiswa.daftarbuku.tahunan.index', compact('bukutahunan', 'events'));
    }

    public function daftarbukutahunansearch(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $bukutahunan = Bukucrud::where('buku', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%")
                         ->paginate(8);
        } else {
            $bukutahunan = Bukucrud::paginate(8);
        }
        $events = Bukucrud::take(4)->get();

        return view('untuksiswa.daftarbuku.tahunan.index', compact('bukutahunan', 'events'));
    }

    public function daftarbukutahunanlihat(string $id)
    {
        $bukutahunan = Bukucrud::findOrFail($id);
        return view('untuksiswa.daftarbuku.tahunan.lihat', compact('bukutahunan'));
    }
    // =========================================================================================
}
