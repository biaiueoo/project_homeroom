<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BK extends Model
{
    use HasFactory;

    protected $table = 'bk';
    protected $fillable = [
        'kdkasus'
    ];

    public function fkasus()
    {
        return $this->belongsTo(CatatanKasus::class, 'kdkasus', 'id');
    }
}
