<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DMapel extends Model
{
    use HasFactory;
    protected $table = 'dmapel';
    protected $fillable = [
        'kdmapel',
        'mapel'
    ];

    public function fmapel(){
        return $this->belongsTo(Mapel::class, 'kdmapel', 'id');
    }
}
