<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_pengunjung', 'tanggal', 'total', 'status'];

    public function pengunjung() { return $this->belongsTo(Pengunjung::class, 'id_pengunjung'); }
    public function details() { return $this->hasMany(DetailTransaksi::class, 'id_transaksi'); }
    public function pembayaran() { return $this->hasOne(Pembayaran::class, 'id_transaksi'); }
}
