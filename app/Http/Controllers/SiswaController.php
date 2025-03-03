<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        if ($request->has('search')) {
            $siswa = Siswa::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $siswa = Siswa::orderBy('created_at', 'DESC')->paginate(35);
        }
        return view('siswa.index', compact('siswa', 'profile'));
    }

    public function create()
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();

        $siswa = Siswa::all();
        return view('siswa.create', compact('siswa', 'profile'));
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
            'name' => 'required|min:1|max:50',
            'kelas' => 'required|min:1|max:50',
            // 'nisn' => 'required:true',
        ]);

        Siswa::create([
            'name' => $request->name,
            'kelas' => $request->kelas,
            'nisn' => $request->nisn,
        ]);
        return redirect('/siswa')->with('success', 'Data Berhasil di Tambahkan');
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

        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa', 'profile'));
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

        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa', 'profile'));
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
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa')->with('success', 'Siswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return redirect()->route('siswa')->with('success', 'Siswa deleted successfully');
    }

    public function removeAll()
    {
        Siswa::query()->forceDelete();
        return redirect()->route('siswa')->with('removeAll', 'Reset data Siswa successfully');
    }

    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ], [
            'file.required' => 'File Excel wajib diupload',
            'file.mimes' => 'File harus berformat Excel (xlsx atau xls)',
            'file.max' => 'Ukuran file maksimal 2MB'
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()->route('siswa')->with('success', 'Data siswa berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->route('siswa')->with('error', 'Format data Excel tidak sesuai');
        } catch (\Exception $e) {
            return redirect()->route('siswa')->with('error', 'Terjadi kesalahan saat import data');
        }
    }

    public function print($id)
    {
        // dibawah ini code untuk view
        //     $siswa = Siswa::findOrFail($id);

        //     // Generate QR Code
        //     $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)
        //         ->errorCorrection('H')
        //         ->margin(1)
        //         ->format('svg')
        //         ->generate(json_encode([
        //             'nama' => $siswa->name,
        //             'nisn' => $siswa->nisn
        //         ]));

        //     // Tampilkan view print.blade.php
        //     return view('siswa.print', compact('siswa', 'qrCode'));
        // }

        $siswa = Siswa::findOrFail($id);

        // Generate QR Code
        $qrCode = base64_encode(
            QrCode::format('svg')
                ->size(80)
                ->errorCorrection('H')
                ->margin(1)
                ->generate(json_encode([
                    'nama' => $siswa->name,
                    'nisn' => $siswa->nisn
                ]))
        );

        // Load view ke PDF dengan custom paper size
        $pdf = PDF::loadView('siswa.print', compact('siswa', 'qrCode'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        return $pdf->stream('kartu_perpustakaan_' . $siswa->nisn . '.pdf');
    }
}
