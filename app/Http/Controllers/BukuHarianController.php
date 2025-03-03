<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bukusharian;
use App\Models\KodebukuHarian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BukuHarianController extends Controller
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

        // if ($request->has('search')) {
        //     $bukuharian = Bukusharian::where('buku', 'LIKE', '%' . $request->search . '%')->paginate(5);
        // } else {
        //     $bukuharian = Bukusharian::orderBy('created_at', 'DESC')->paginate(10);
        // }

        if ($request->has('search')) {
            $bukuharian = Bukusharian::with('kodebukuharians')
                ->where('buku', 'LIKE', '%' . $request->search . '%')
                ->paginate(5);
        } else {
            $bukuharian = Bukusharian::with('kodebukuharians')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        return view('bukuharian.index', compact('bukuharian', 'profile'));
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

        $bukuharian = Bukusharian::all();
        $kodebukuharian = KodebukuHarian::all();
        return view('bukuharian.create', compact('bukuharian', 'kodebukuharian', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi untuk data buku dan kode buku
        $this->validate($request, [
            'buku' => 'required|min:1|max:50',
            'penulis' => 'required|min:1|max:50',
            'penerbit' => 'required|min:1|max:50',
            'stok' => 'required:true',
            'kodebuku' => 'required|array',
            'kodebuku.*' => 'required|string|distinct',
            // 'foto' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan data buku harian
        $bukuharian = Bukusharian::create([
            'buku' => $request->buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'stok' => $request->stok,
        ]);

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('gambarbukuharian/', $request->file('foto')->getClientOriginalName());
            $bukuharian->foto = $request->file('foto')->getClientOriginalName();
            $bukuharian->save();
        }

        // Simpan kode buku
        foreach ($request->kodebuku as $kodebuku) {
            KodebukuHarian::create([
                'bukuharian_id' => $bukuharian->id,
                'kodebuku' => $kodebuku,
            ]);
        }

        return redirect('/bukuharian')->with('success', 'Data Buku dan Kode Buku Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        $bukuharian = Bukusharian::findOrFail($id);
        return view('bukuharian.show', compact('bukuharian', 'profile'));
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

        $bukuharian = Bukusharian::findOrFail($id);
        return view('bukuharian.edit', compact('bukuharian', 'profile'));
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
        // Validasi input
        $this->validate($request, [
            'buku' => 'required|min:1|max:50',
            'penulis' => 'required|min:1|max:50',
            'penerbit' => 'required|min:1|max:50',
            'stok' => 'required|integer',
            'kodebuku' => 'required|array',
            'kodebuku.*' => 'string|distinct',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Tambahkan validasi foto
        ]);

        // Temukan data Bukusharian berdasarkan ID
        $data = Bukusharian::findOrFail($id);

        // Handle file upload untuk foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();

            // Hapus foto lama jika ada
            if ($data->foto && file_exists(public_path('gambarbukuharian/' . $data->foto))) {
                unlink(public_path('gambarbukuharian/' . $data->foto));
            }

            // Simpan foto baru
            $foto->move(public_path('gambarbukuharian'), $filename);

            // Update nama foto di database
            $data->foto = $filename;
        }

        // Update data lainnya
        $data->update([
            'buku' => $request->buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'stok' => $request->stok,
            'description' => $request->description,
        ]);

        $data->save();

        // Update kodebuku
        KodebukuHarian::where('bukuharian_id', $id)->delete();

        foreach ($request->kodebuku as $kode) {
            if (!empty($kode)) {
                KodebukuHarian::create([
                    'bukuharian_id' => $id,
                    'kodebuku' => $kode
                ]);
            }
        }

        return redirect()->route('bukuharian')->with('success', 'Buku updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bukuharian = Bukusharian::findOrFail($id);

        $bukuharian->delete();

        return redirect()->route('bukuharian')->with('success', 'buku deleted successfully');
    }

    public function removeAll()
    {
        Bukusharian::query()->forceDelete();
        return redirect()->route('bukuharian')->with('removeAll', 'Reset data Buku Harian successfully');
    }
}
