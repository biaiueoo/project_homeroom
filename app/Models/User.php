<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'guru_nip', // Tambahkan 'guru_nip' ke fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function fguru()
    {
        return $this->belongsTo(Guru::class, 'guru_nip', 'nip');
    }

    public function hasRole($role)
    {
        return $this->level === $role;
    }
}
