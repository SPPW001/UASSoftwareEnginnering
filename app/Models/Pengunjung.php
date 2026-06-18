<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengunjung extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pengunjung';
    protected $fillable = ['nama', 'email', 'no_hp'];

    public function transaksis() { return $this->hasMany(Transaksi::class, 'id_pengunjung'); }
    public function membership() { return $this->hasOne(Membership::class, 'id_pengunjung'); }
}
