<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['id_transaksi', 'metode', 'status', 'nominal', 'kode_referensi'];

    public function transaksi() { return $this->belongsTo(Transaksi::class, 'id_transaksi'); }
}
