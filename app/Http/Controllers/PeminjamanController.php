<?php

namespace App\Http\Controllers;

use App\Models\Bukusharian;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
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
            $peminjaman = Peminjaman::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('nisn', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $peminjaman = Peminjaman::latest()->paginate(35);
        }
        return view('peminjaman.index', compact('peminjaman', 'profile'));
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

        $peminjaman = Peminjaman::all();
        $siswa = Siswa::all();
        $bukuharian = Bukusharian::all();
        return view('peminjaman.create', compact('peminjaman', 'siswa', 'bukuharian', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'kodebuku' => $request->kodebuku,
            'jml_buku' => $request->jml_buku,
            'jam_pinjam' => $request->jam_pinjam,
            'jam_kembali' => $request->jam_kembali,
            'description' => $request->description
        ]);
        return redirect('/peminjaman')->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        $peminjaman = Peminjaman::findOrFail($id);
        $siswa = Siswa::all();
        return view('peminjaman.show', compact('peminjaman', 'siswa', 'profile'));
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

        $peminjaman = Peminjaman::findOrFail($id);
        $siswa = Siswa::all();
        $bukuharian = Bukusharian::all();
        return view('peminjaman.edit', compact('peminjaman', 'siswa', 'bukuharian', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        try {
            // Log the incoming request data
            // \Log::info("Update Request Data:', $request->all()");

            // Validate the request
            $validated = $request->validate([
                'siswas_id' => 'required',
                'bukusharians_id' => 'required',
                'kodebuku' => 'required',
                'jml_buku' => 'required|numeric|min:1',
                'jam_pinjam' => 'required',
                'jam_kembali' => 'required|after:jam_pinjam'
            ]);

            // Find the peminjaman
            $peminjaman = Peminjaman::findOrFail($id);

            // Find the bukuharian
            $bukuharian = Bukusharian::findOrFail($request->bukusharians_id);

            // Calculate stock difference
            $stokLama = $peminjaman->jml_buku;
            $stokBaru = $request->input('jml_buku');
            $selisih = $stokLama - $stokBaru;

            // Update stock
            $bukuharian->stok += $selisih;

            // Check if stock would go negative
            if ($bukuharian->stok < 0) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Stok buku tidak mencukupi.']);
            }

            // Save bukuharian changes
            $bukuharian->save();

            // Update peminjaman
            $updateResult = $peminjaman->update([
                'siswas_id' => $request->siswas_id,
                'bukusharians_id' => $request->bukusharians_id,
                'kodebuku' => $request->kodebuku,
                'jml_buku' => $stokBaru,
                'jam_pinjam' => $request->jam_pinjam,
                'jam_kembali' => $request->jam_kembali
            ]);

            // \Log::info('Update Result:', ['success' => $updateResult]);

            if (!$updateResult) {
                throw new \Exception('Failed to update peminjaman');
            }

            return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil diupdate');
        } catch (\Exception $e) {
            // \Log::error('Error updating peminjaman: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->delete();

        return redirect()->route('peminjaman')->with('success', 'Peminjaman deleted successfully');
    }

    public function removeAll()
    {
        Peminjaman::query()->forceDelete();
        return redirect()->route('peminjaman')->with('removeAll', 'Reset data Peminjaman successfully');
    }
}
