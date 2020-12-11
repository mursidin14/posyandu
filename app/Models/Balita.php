<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;
    protected $table= "balitas";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama_balita',
        'tpt_lahir',
        'tgl_lahir',
        'nama_orangtua',
        'pendidikan',
        'pekerjaan',
        'alamat',
        'ket',
    ];
    public function penimbangan(){
        return $this->hasMany(Penimbangan::class);
    }
}
