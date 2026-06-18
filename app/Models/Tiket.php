<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Tiket extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tiket';
    protected $fillable = ['jenis_tiket', 'kategori', 'harga', 'kapasitas_harian', 'aktif'];

    public function hitungHargaDinamis(?string $tanggal = null): float
    {
        $tanggal = $tanggal ? Carbon::parse($tanggal) : now();
        $harga = (float) $this->harga;

        if ($tanggal->isWeekend()) {
            $harga *= 1.15;
        }

        $promo = EventPromo::activeForDate($tanggal->toDateString())->first();
        if ($promo) {
            $harga -= ($harga * ((float) $promo->diskon_persen / 100));
        }

        return max(0, round($harga, 2));
    }

    public function detailTransaksis() { return $this->hasMany(DetailTransaksi::class, 'id_tiket'); }
}
