<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelahirans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'orang_tua_id',
        'ayah_id',
        'balita_id',
        'jumlah_lahiran',
        'jenis_kelamin',
        'tgl',
        'status_ibu',
        'status_bayi',
    ];

    public function orangtua(): BelongsTo
    {
        return $this->belongsTo(OrangTua::class, 'orang_tua_id', 'id');
    }

    public function ayah(): BelongsTo
    {
        return $this->belongsTo(Ayah::class, 'ayah_id', 'id');
    }

    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id');
    }
}
