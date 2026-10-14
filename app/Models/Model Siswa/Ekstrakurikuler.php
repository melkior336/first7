<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';

    protected $primaryKey = 'id_ekskul';

    protected $fillable = [
        'nama_ekskul',
        'pembina',
        'hari_kegiatan',
        'jam_kegiatan',
        'tempat',
    ];

    public function anggotaEkskul(): HasMany
    {
        return $this->hasMany(AnggotaEkskul::class, 'id_ekskul', 'id_ekskul');
    }

    public function siswa(): BelongsToMany
    {
        return $this->belongsToMany(Siswa::class, 'anggota_ekskul', 'id_ekskul', 'id_siswa');
    }
}
