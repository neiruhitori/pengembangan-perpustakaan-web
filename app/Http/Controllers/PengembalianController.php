<?php

namespace App\Http\Controllers;

use App\Models\Bukusharian;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
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
            $pengembalian = Peminjaman::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('siswas', function ($query) use ($keyword) {
                $query->where('kelas', 'like', '%' . $keyword . '%');
            })->get();
        } else {
            $pengembalian = Peminjaman::latest()->paginate(35);
        }
        return view('pengembalian.index', compact('pengembalian', 'profile'));

        /* -------dibawah ini adalah sebelum adanya fitur search-------*/
        // $pengembalian = Peminjaman::orderBy('created_at', 'DESC')->paginate(10);
        // return view('pengembalian.index', compact('pengembalian'));
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

    // public function status($id)
    // {
    //     // Temukan peminjaman berdasarkan ID
    //     $pengembalian = Peminjaman::findOrFail($id);

    //     // Temukan buku berdasarkan ID peminjaman
    //     $bukuharian = Bukusharian::findOrFail($pengembalian->bukusharians_id);

    //     // Tambah stok buku berdasarkan jumlah buku yang dipinjam
    //     $bukuharian->stok += $pengembalian->jml_buku;
    //     $bukuharian->save();

    //     // Update status peminjaman menjadi selesai (0)
    //     $pengembalian->update([
    //         'status' => 0
    //     ]);

    //     // Redirect ke halaman pengembalian dengan pesan sukses
    //     return redirect()->route('pengembalian', compact('pengembalian'))->with('success', 'Peminjaman selesai successfully');
    // }

    public function status($id)
    {
        // Temukan peminjaman berdasarkan ID
        $pengembalian = Peminjaman::findOrFail($id);

        // Hitung keterlambatan
        $tglKembali = Carbon::parse($pengembalian->jam_kembali);
        $today = Carbon::now();
        $isOverdue = $today->gt($tglKembali);
        $lateDays = $isOverdue ? $today->diffInDays($tglKembali) : 0;
        $lateFine = $lateDays * 500;

        // Update stok buku
        $bukuharian = Bukusharian::findOrFail($pengembalian->bukusharians_id);
        $bukuharian->stok += $pengembalian->jml_buku;
        $bukuharian->save();

        // Siapkan deskripsi denda jika ada
        $description = '';
        if ($lateDays > 0) {
            $description = "Denda keterlambatan {$lateDays} hari: Rp " . number_format($lateFine, 0, ',', '.');
        }
        if (request()->has('is_damaged')) {
            $damageFine = 50000;
            $description .= ($description ? "\n" : "") . "Denda kerusakan/kehilangan buku: Rp " . number_format($damageFine, 0, ',', '.');
            $lateFine += $damageFine;
        }

        // Update status peminjaman
        $pengembalian->update([
            'status' => 0,
            'description' => $description ?: null
        ]);

        return redirect()->route('pengembalian')
            ->with('success', 'Pengembalian berhasil diproses' . ($lateFine > 0 ? ". Total denda: Rp " . number_format($lateFine, 0, ',', '.') : ''));
    }


    public function view_pdf()
    {
        $pengembalian = Peminjaman::orderBy('name', 'ASC')->get();
        $pdf = Pdf::loadView('pengembalian.pdf', ['pengembalian' => $pengembalian]);
        return $pdf->stream('data-perpustakaan.pdf');
    }
}
