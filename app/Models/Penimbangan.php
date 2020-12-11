<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Penimbangan extends Model
{
    use HasFactory;
    protected $table= "penimbangans";
    protected $fillable = [
        'tanggal_timbang',
        'balita_id',
        'bb',
        'tb',
    ];
    public function balita(){
        return $this->belongsTo(Balita::class);
    }
}
