<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_member';
    protected $fillable = ['id_pengunjung', 'status_member', 'tanggal_daftar', 'jumlah_kunjungan'];

    public function pengunjung() { return $this->belongsTo(Pengunjung::class, 'id_pengunjung'); }
}
