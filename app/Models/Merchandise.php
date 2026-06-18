<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchandise extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk';
    protected $fillable = ['nama_produk', 'kategori', 'harga', 'stok', 'jumlah_terjual', 'kontribusi'];

    public function cekStok(int $jumlah): bool
    {
        return $this->stok >= $jumlah;
    }

    public function hitungKontribusi(float $subtotal): float
    {
        return round($subtotal * ((float) $this->kontribusi / 100), 2);
    }
}
