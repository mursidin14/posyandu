<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisImun extends Model
{
    use HasFactory;

    protected $table = 'jenis_imuns';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name_imun',
        'usia_pakai'
    ];

    public function imunisasi(): HasMany
    {
        return $this->hasMany(Imunisasi::class, 'jenis_imun', 'id');
    }
}
