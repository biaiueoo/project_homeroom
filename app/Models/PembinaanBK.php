<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanBK extends Model
{
    use HasFactory;
    protected $table = 'pembinaan_bk';
    protected $fillable = [
        'kdkasus',
        'status',
    ];

    public function fkasus()
    {
        return $this->belongsTo(CatatanKasus::class, 'kdkasus', 'id');
    }
}
