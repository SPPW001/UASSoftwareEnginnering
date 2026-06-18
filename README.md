# ZooLand ERP - Laravel Starter

Starter project Laravel untuk **ZooLand ERP - Ekowisata Terukur** sesuai revisi final:

Alur utama:

1. Pengunjung mengisi data dasar.
2. Pengunjung memilih tiket.
3. Pengunjung dapat menambah upsell package, merchandise, dan membership secara opsional.
4. Sistem menghitung total checkout.
5. Pengunjung memilih metode pembayaran.
6. Sistem menyimpan transaksi, detail transaksi, pembayaran, dan menghasilkan invoice/tiket digital.

Role:

- **Pengunjung**: akses halaman publik dan checkout.
- **Admin**: kelola tiket, dynamic pricing, merchandise, membership, event & promo, upsell package, transaksi, laporan.
- **Manager**: semua akses admin + kelola partnership.

## Cara pakai cepat

1. Buat project Laravel baru atau gunakan folder ini langsung setelah `composer install`.
2. Copy `.env.example` menjadi `.env`.
3. Sesuaikan database di `.env`.
4. Jalankan:

```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

## Akun seed

```text
Admin
email: admin@zooland.test
password: password

Manager
email: manager@zooland.test
password: password
```

## Catatan manusiawi

File ini adalah starter Laravel tanpa folder `vendor`. Itu normal, bukan tanda kiamat. Jalankan `composer install` dulu.
