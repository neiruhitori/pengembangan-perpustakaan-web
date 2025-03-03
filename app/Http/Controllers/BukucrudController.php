<?php

namespace App\Http\Controllers;

use App\Models\Bukucrud;
use App\Models\KodebukuTahunan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukucrudController extends Controller
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

        if ($request->has('search')) {
            $buku = Bukucrud::where('buku', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $buku = Bukucrud::orderBy('created_at', 'DESC')->paginate(10);
        }
        return view('buku.index', compact('buku', 'profile'));
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

        $buku = Bukucrud::all();
        $kodebukucrud = KodebukuTahunan::all();
        return view('buku.create', compact('buku', 'kodebukucrud', 'profile'));
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

        // Simpan data buku tahuanan
        $bukucrud = Bukucrud::create([
            'buku' => $request->buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'stok' => $request->stok,
        ]);

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('gambarbukutahunan/', $request->file('foto')->getClientOriginalName());
            $bukucrud->foto = $request->file('foto')->getClientOriginalName();
            $bukucrud->save();
        }

        // Simpan kode buku
        foreach ($request->kodebuku as $kodebuku) {
            KodebukuTahunan::create([
                'bukucrud_id' => $bukucrud->id,
                'kodebuku' => $kodebuku,
            ]);
        }

        return redirect()->route('buku')->with('success', 'Data Berhasil di Tambahkan');
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
        $profile = User::where('id',$iduser)->first();
        
        $buku = Bukucrud::findOrFail($id);
        return view('buku.show', compact('buku', 'profile'));
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
        $profile = User::where('id',$iduser)->first();
        
        $buku = Bukucrud::findOrFail($id);
        return view('buku.edit', compact('buku', 'profile'));
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

        // Temukan data Buku berdasarkan ID
        $data = Bukucrud::findOrFail($id);

        // Handle file upload untuk foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();

            // Hapus foto lama jika ada
            if ($data->foto && file_exists(public_path('gambarbukutahunan/' . $data->foto))) {
                unlink(public_path('gambarbukutahunan/' . $data->foto));
            }

            // Simpan foto baru
            $foto->move(public_path('gambarbukutahunan'), $filename);

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
        KodebukuTahunan::where('bukucrud_id', $id)->delete();

        foreach ($request->kodebuku as $kode) {
            if (!empty($kode)) {
                KodebukuTahunan::create([
                    'bukucrud_id' => $id,
                    'kodebuku' => $kode
                ]);
            }
        }
        return redirect()->route('buku')->with('success', 'Buku updated successfully');
    }
    // {
    //     $buku = Bukucrud::findOrFail($id);
    //     $buku->update($request->all());

    //     return redirect()->route('buku')->with('success', 'buku updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Bukucrud::findOrFail($id);
  
        $buku->delete();
  
        return redirect()->route('buku')->with('success', 'buku deleted successfully');
    }

    public function removeAll(){
        Bukucrud::query()->forceDelete();
        return redirect()->route('buku')->with('removeAll', 'Reset data Buku Tahunan successfully');
    }
}
