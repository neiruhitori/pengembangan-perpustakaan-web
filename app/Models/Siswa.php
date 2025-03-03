<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table ='siswas';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id');
    }
    public function peminjamantahunan()
    {
        return $this->hasMany(PeminjamanTahunan::class, 'id');
    }

    // public function peminjaman()
    // {
    //     return $this->hasMany(Peminjaman::class, 'siswa_id');
    // }
    
    // public function peminjamantahunan()
    // {
    //     return $this->hasMany(PeminjamanTahunan::class, 'siswa_id');
    // }
}
