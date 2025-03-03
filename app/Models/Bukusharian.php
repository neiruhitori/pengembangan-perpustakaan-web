<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukusharian extends Model
{
    use HasFactory;

    protected $table = 'bukusharians';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];

    public function peminjaman()
    {
        return $this->hasMany(Buku::class, 'bukusharianss_id');
    }

    public function kodebukuharians()
    {
        return $this->hasMany(KodebukuHarian::class, 'bukuharian_id');
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
