<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventPromo extends Model
{
    use HasFactory;
    protected $fillable = ['nama_event', 'tanggal_mulai', 'tanggal_selesai', 'diskon_persen', 'deskripsi', 'aktif'];

    public function scopeActiveForDate($query, string $date)
    {
        return $query->where('aktif', true)
            ->whereDate('tanggal_mulai', '<=', $date)
            ->whereDate('tanggal_selesai', '>=', $date);
    }
}
