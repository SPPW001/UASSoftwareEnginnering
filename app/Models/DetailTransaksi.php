<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_transaksi', 'id_tiket', 'id_produk', 'id_upsell_package',
        'jenis_item', 'nama_item', 'jumlah', 'subtotal', 'kontribusi_konservasi'
    ];

    public function transaksi() { return $this->belongsTo(Transaksi::class, 'id_transaksi'); }
    public function tiket() { return $this->belongsTo(Tiket::class, 'id_tiket'); }
    public function merchandise() { return $this->belongsTo(Merchandise::class, 'id_produk'); }
    public function upsellPackage() { return $this->belongsTo(UpsellPackage::class, 'id_upsell_package'); }
}
