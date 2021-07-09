<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;
    protected $table= "orang_tuas";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'pekerjaan',
        'pendidikan',
        'alamat',
        'ket',
    ];
    public function balitas(){
        return $this->hasMany(Balita::class);
    }
}
