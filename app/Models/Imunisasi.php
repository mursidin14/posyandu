<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal_imun',
        'balita_id',
        'umur',
        'jenis_imun',
    ];

    public function balita(){
        return $this->belongsTo(Balita::class);
    }

    public function jenisImun(): BelongsTo
    {
        return $this->belongsTo(JenisImun::class, 'jenis_imun', 'id');
    }
}
