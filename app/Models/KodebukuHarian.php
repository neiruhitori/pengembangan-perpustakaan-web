<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodebukuHarian extends Model
{
    use HasFactory;

    protected $table = 'kodebuku_harians';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];


    public function bukusharians()
    {
        return $this->belongsTo(Bukusharian::class, 'bukuharian_id');
    }
}
