<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Bukucrud;
use Illuminate\Http\Request;
use App\Models\PeminjamanTahunan;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        $keyword = $request->input('search');
        if ($request->has('search')) {
            $peminjamantahunan = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('nisn', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $peminjamantahunan = PeminjamanTahunan::latest()->paginate(35);
        }
        return view('peminjamantahunan.index', compact('peminjamantahunan', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        $peminjamantahunan = PeminjamanTahunan::all();
        $siswa = Siswa::all();
        $bukucrud = Bukucrud::all();
        return view('peminjamantahunan.create', compact('peminjamantahunan', 'siswa', 'profile', 'bukucrud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         // 'kls' => 'required:true',
    //         'nisn' => 'required:true',
    //         'absen' => 'required:true',
    //         'tgl' => 'required:true',
    //         'siswas_id' => 'required:true',
    //         'jam_pinjam' => 'required:true',
    //         'jam_kembali' => 'required:true',
    //     ]);

    //     $kode_pinjam = $request->nisn . '-' . $request->absen . '-' . $request->tgl;
    //     $siswas_id = $request->siswas_id;
    //     $jam_pinjam = $request->jam_pinjam;
    //     $jam_kembali = $request->jam_kembali;
    //     $description = $request->description;

    //     // Simpan ke database
    //     $yourModel = new PeminjamanTahunan();
    //     $yourModel->kode_pinjam = $kode_pinjam;
    //     $yourModel->siswas_id = $siswas_id;
    //     $yourModel->jam_pinjam = $jam_pinjam;
    //     $yourModel->jam_kembali = $jam_kembali;
    //     $yourModel->description = $description;
    //     $yourModel->save();

    //     return redirect()->route('peminjamantahunanbuku.create')->with('success', 'Data Berhasil di Tambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            // 'nisn' => 'required',
            // 'absen' => 'required',
            // 'tgl' => 'required',
            'siswas_id' => 'required',
            'jam_pinjam' => 'required',
            'jam_kembali' => 'required',
            'bukucruds_id' => 'required|array|min:1',
            'kodebuku' => 'required|array|min:1',
            'jml_buku' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Buat peminjaman
            $peminjaman = PeminjamanTahunan::create([
                // 'kode_pinjam' => $request->nisn . '-' . $request->absen . '-' . $request->tgl,
                'siswas_id' => $request->siswas_id,
                'jam_pinjam' => $request->jam_pinjam,
                'jam_kembali' => $request->jam_kembali
            ]);

            // Simpan detail buku
            foreach ($request->bukucruds_id as $index => $bukuId) {
                $buku = Bukucrud::find($bukuId);

                if (!$buku || $buku->stok < $request->jml_buku[$index]) {
                    throw new \Exception('Stok buku tidak mencukupi.');
                }

                // Kurangi stok
                $buku->stok -= $request->jml_buku[$index];
                $buku->save();

                // Simpan detail peminjaman
                Buku::create([
                    'peminjamantahunan_id' => $peminjaman->id,
                    'bukucruds_id' => $bukuId,
                    'kodebuku' => $request->kodebuku[$index],
                    'jml_buku' => $request->jml_buku[$index]
                ]);
            }

            DB::commit();
            return redirect()->route('peminjamantahunan')
                ->with('success', 'Peminjaman berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        $peminjamantahunan = PeminjamanTahunan::findOrFail($id);
        return view('peminjamantahunan.show', compact('peminjamantahunan', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        // Ambil data peminjamantahunan beserta buku dan relasi ke bukucrud
        $peminjamantahunan = PeminjamanTahunan::with('bukus.bukucruds')->findOrFail($id);
        $siswas = Siswa::all();
        $bukucrud = Bukucrud::all();
        $bukus = Buku::with('bukucruds')->get();
        return view('peminjamantahunan.edit', compact('peminjamantahunan', 'bukucrud', 'siswas', 'bukus', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $peminjaman = Peminjamantahunan::findOrFail($id);

            $peminjaman->siswas_id = $request->siswas_id;
            $peminjaman->jam_kembali = $request->jam_kembali;
            $peminjaman->save();

    // Hapus semua buku terkait
    $peminjaman->bukus()->delete();

    // Tambah buku baru (jika ada)
    if ($request->has('bukucruds_id')) {
        foreach ($request->bukucruds_id as $index => $bukuId) {
            $peminjaman->bukus()->create([
                'bukucruds_id' => $bukuId,
                'kodebuku' => $request->kodebuku[$index],
                'jml_buku' => $request->jml_buku[$index],
            ]);
        }
    }

    return redirect()->route('peminjamantahunan')->with('success', 'Peminjaman berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peminjamantahunan = PeminjamanTahunan::findOrFail($id);

        $peminjamantahunan->delete();

        return redirect()->route('peminjamantahunan')->with('success', 'Peminjaman deleted successfully');
    }

    public function removeAll()
    {
        PeminjamanTahunan::query()->forceDelete();
        return redirect()->route('peminjamantahunan')->with('removeAll', 'Reset data Peminjaman Tahunan successfully');
    }
}
