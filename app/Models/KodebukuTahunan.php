<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodebukuTahunan extends Model
{
    use HasFactory;
    protected $table = 'kodebuku_tahunans';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];

    public function bukucruds()
    {
        return $this->belongsTo(Bukucrud::class, 'bukucrud_id');
    }
}
