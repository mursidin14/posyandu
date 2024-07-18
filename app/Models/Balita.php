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
        'nik',
        'nama_balita',
        'tpt_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'umur',
        'orang_tua_id',
        'alamat',
        'rt_rw',
        'ket',
    ];

    public function orangtua(){
        return $this->belongsTo(OrangTua::class,'orang_tua_id','id');
    }
    public function penimbangan(){
        return $this->hasMany(Penimbangan::class);
    }
    public function imunisasi(){
        return $this->hasMany(Imunisasi::class);
    }
}
