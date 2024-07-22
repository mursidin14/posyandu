<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ayah extends Model
{
    use HasFactory;

    protected $table = 'ayahs';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'alamat',
        'ket',
    ];

    public function balitas(): HasMany
    {
        return $this->hasMany(Balita::class);
    }

    public function kelahiran(): HasMany
    {
        return $this->hasMany(Kelahiran::class);
    }
}
