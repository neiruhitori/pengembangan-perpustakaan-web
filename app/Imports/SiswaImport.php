<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Ambil NISN lengkap tanpa memotong
        $nisn = isset($row['nisn']) ? trim($row['nisn']) : null;
        
        // Jika NISN adalah "Tidak ada NISN", set jadi null
        if ($nisn == "Tidak ada NISN") {
            $nisn = null;
        }

        return new Siswa([
            'nisn' => $nisn,
            'name' => trim($row['name']),
            'kelas' => trim($row['kelas']),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'kelas' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'kelas.required' => 'Kolom kelas tidak boleh kosong',
        ];
    }
}