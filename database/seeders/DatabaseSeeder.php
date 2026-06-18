<?php

namespace Database\Seeders;

use App\Models\EventPromo;
use App\Models\Merchandise;
use App\Models\Perusahaan;
use App\Models\Tiket;
use App\Models\UpsellPackage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@zooland.test'], [
            'name' => 'Admin ZooLand',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::updateOrCreate(['email' => 'manager@zooland.test'], [
            'name' => 'Manager ZooLand',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        Tiket::insert([
            ['jenis_tiket' => 'Reguler Dewasa', 'kategori' => 'Reguler', 'harga' => 120000, 'kapasitas_harian' => 500, 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_tiket' => 'Reguler Anak', 'kategori' => 'Reguler', 'harga' => 90000, 'kapasitas_harian' => 500, 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_tiket' => 'Premium Experience', 'kategori' => 'Premium', 'harga' => 180000, 'kapasitas_harian' => 200, 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        UpsellPackage::insert([
            ['nama_paket' => 'Behind The Scenes', 'harga' => 75000, 'deskripsi' => 'Akses edukasi di balik area perawatan satwa.', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_paket' => 'Keeper Experience', 'harga' => 95000, 'deskripsi' => 'Pengalaman edukatif bersama keeper.', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_paket' => 'Night Safari', 'harga' => 110000, 'deskripsi' => 'Pengalaman safari malam terbatas.', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Merchandise::insert([
            ['nama_produk' => 'Boneka Harimau', 'kategori' => 'Souvenir', 'harga' => 85000, 'stok' => 40, 'jumlah_terjual' => 0, 'kontribusi' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Kaos Konservasi', 'kategori' => 'Apparel', 'harga' => 125000, 'stok' => 30, 'jumlah_terjual' => 0, 'kontribusi' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Tumbler Satwa', 'kategori' => 'Eco Product', 'harga' => 65000, 'stok' => 55, 'jumlah_terjual' => 0, 'kontribusi' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);

        EventPromo::insert([
            ['nama_event' => 'Wildlife Education Week', 'tanggal_mulai' => now()->subDays(7), 'tanggal_selesai' => now()->addDays(14), 'diskon_persen' => 5, 'deskripsi' => 'Promo edukasi satwa untuk pengunjung.', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $perusahaan = Perusahaan::create([
            'nama_perusahaan' => 'PT Konservasi Nusantara',
            'email' => 'csr@konservasi.test',
            'kontak' => '081234567890',
        ]);

        $perusahaan->partnerships()->create([
            'jenis_kerjasama' => 'CSR Konservasi',
            'tanggal_mulai' => now()->toDateString(),
            'tanggal_selesai' => now()->addYear()->toDateString(),
            'kontribusi' => 50000000,
            'status' => 'aktif',
        ]);
    }
}
