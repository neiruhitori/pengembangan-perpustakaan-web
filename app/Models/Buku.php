<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table ='bukus';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];

    public function peminjamantahunan()
    {
        return $this->belongsTo(PeminjamanTahunan::class, 'peminjamantahunan_id');
    }
    public function bukucruds()
    {
        return $this->belongsTo(Bukucrud::class, 'bukucruds_id');
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
}
