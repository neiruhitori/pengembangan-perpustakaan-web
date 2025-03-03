<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table ='peminjaman';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];
    // Dibawah ini adalah untuk merubah text menjadi red ketika melebihi tanggal
    protected $appends = ['is_overdue'];

    public function siswas()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function bukusharians()
    {
        return $this->belongsTo(Bukusharian::class, 'bukusharians_id');
    }

    // Method untuk meminjam buku
    public function pinjam()
    {
        if ($this->stok > 0) {
            $this->stok--;
            $this->save();
            return true;
        }
        return false;
    }

    // Method untuk mengembalikan buku
    public function kembali()
    {
        $this->stok++;
        $this->save();
    }

    // Dibawah ini adalah untuk merubah text menjadi red ketika melebihi tanggal
    public function getIsOverdueAttribute()
    {
        return Carbon::now()->gt(Carbon::parse($this->jam_kembali)) && $this->status != 0;
    }

}
