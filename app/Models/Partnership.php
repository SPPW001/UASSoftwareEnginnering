<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partnership extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_partnership';
    protected $fillable = ['id_perusahaan', 'jenis_kerjasama', 'tanggal_mulai', 'tanggal_selesai', 'kontribusi', 'status'];

    public function perusahaan() { return $this->belongsTo(Perusahaan::class, 'id_perusahaan'); }
}
