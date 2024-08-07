<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrangTua extends Model
{
    use HasFactory;
    protected $table= "orang_tuas";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'ket',
    ];

    public function balitas(){
        return $this->hasMany(Balita::class);
    }

    public function kelahiran():HasMany
    {
        return $this->hasMany(Kelahiran::class);
    }
}
