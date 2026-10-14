<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPiket extends Model
{
    use HasFactory;

    protected $table = 'laporan_piket';

    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_kelas',
        'id_siswa',
        'hari',
        'tanggal',
        'status',
        'checklist',
        'foto_bukti',
        'catatan',
        'dibaca',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'checklist' => 'array',
            'dibaca' => 'boolean',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    /**
     * @return list<string>
     */
    public function getFotoBuktiListAttribute(): array
    {
        if (empty($this->foto_bukti)) {
            return [];
        }

        $decoded = json_decode((string) $this->foto_bukti, true);
        if (is_array($decoded)) {
            return array_values($decoded);
        }

        if (str_contains((string) $this->foto_bukti, ',')) {
            return array_values(array_filter(array_map('trim', explode(',', (string) $this->foto_bukti))));
        }

        return [(string) $this->foto_bukti];
    }

    public function getFirstFotoBuktiAttribute(): string
    {
        $list = $this->foto_bukti_list;

        return $list[0] ?? (string) ($this->foto_bukti ?? '');
    }
}
