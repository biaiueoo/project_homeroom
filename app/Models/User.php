<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'guru_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Menambahkan properti $username
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;

    public function getAuthIdentifierName()
    {
        return 'name';
    }

    public function hasRole($role)
    {
        return $this->level === $role;
    }

    public function getData() {
        if ($this->level === 'admin') {
            return Guru::all();
        } elseif ($this->level === 'kepala_kompetensi') {
            return Kelas::where('kdkompetensi', $this->guru_id)->get();
        } elseif ($this->level === 'wali_kelas') {
            return Kelas::where('kdkompetensi', $this->guru_id)->where('id', $this->kelas_id)->get();
        } else {
            // Handle other cases
            return [];
        }
    }
}
