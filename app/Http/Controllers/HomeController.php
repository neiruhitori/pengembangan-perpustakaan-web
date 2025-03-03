<?php

namespace App\Http\Controllers;

use App\Models\Bukusharian;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\PeminjamanTahunan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();

        $user = Siswa::count();
        $buku = Bukusharian::count();
        $siswa = Peminjaman::count();
        $siswatahunan = PeminjamanTahunan::count();
        $pengembalian = Peminjaman::select('status')->where('status', 1)->count();
        $pengembaliantahunan = PeminjamanTahunan::select('status')->where('status', 1)->count();
        $selesai = Peminjaman::select('status')->where('status', 0)->count();
        $selesaitahunan = PeminjamanTahunan::select('status')->where('status', 0)->count();

        return view('/dashboard',['buku' => $buku, 'siswa' => $siswa, 'siswatahunan' => $siswatahunan, 'user' => $user, 'pengembalian' => $pengembalian, 'pengembaliantahunan' => $pengembaliantahunan, 'selesai' => $selesai, 'selesaitahunan' => $selesaitahunan], compact('profile') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
