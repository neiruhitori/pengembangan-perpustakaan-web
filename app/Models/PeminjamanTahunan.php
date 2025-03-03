<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanTahunan extends Model
{
    use HasFactory;
    protected $table ='peminjamantahunan';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['is_overdue'];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'peminjamantahunan_id');
    }

    public function siswas()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function getIsOverdueAttribute()
    {
        return Carbon::now()->gt(Carbon::parse($this->jam_kembali)) && $this->status != 0;
    }

}

