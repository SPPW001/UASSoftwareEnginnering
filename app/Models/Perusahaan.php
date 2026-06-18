<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_perusahaan';
    protected $fillable = ['nama_perusahaan', 'email', 'kontak'];

    public function partnerships() { return $this->hasMany(Partnership::class, 'id_perusahaan'); }
}
