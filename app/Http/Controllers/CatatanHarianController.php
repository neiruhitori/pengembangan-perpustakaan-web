<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CatatanHarianController extends Controller
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
            $catatan = Peminjaman::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })
                ->orderByRaw('CASE WHEN description IS NULL THEN 1 ELSE 0 END')  // Prioritaskan yang ada isi
                ->orderBy('updated_at', 'desc')  // Yang terbaru update di atas
                ->orderBy('description', 'asc')  // Kemudian urutkan berdasarkan description
                ->get();
        } else {
            $catatan = Peminjaman::orderByRaw('CASE WHEN description IS NULL THEN 1 ELSE 0 END')
                ->orderBy('updated_at', 'desc')
                ->orderBy('description', 'asc')
                ->paginate(35);
        }

        return view('catatanharian.catatan', compact('catatan', 'profile'));
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

        $catatan = Peminjaman::findOrFail($id);
        return view('catatanharian.show', compact('catatan', 'profile'));
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

        $catatan = Peminjaman::findOrFail($id);
        return view('catatanharian.edit', compact('catatan', 'profile'));
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
        $catatan = Peminjaman::findOrFail($id);
        $catatan->update([
            'description' => $request->description,
        ]);

        return redirect()->route('catatanharian')->with('success', 'catatan updated successfully');
    }
}
