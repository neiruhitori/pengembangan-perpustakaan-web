<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukucrud extends Model
{
    use HasFactory;
    protected $table ='bukucruds';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'bukucruds_id');
    }

    public function kodebukucruds()
    {
        return $this->hasMany(KodebukuTahunan::class, 'bukucrud_id');
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
