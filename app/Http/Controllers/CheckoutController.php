<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Membership;
use App\Models\Merchandise;
use App\Models\Pembayaran;
use App\Models\Pengunjung;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\UpsellPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function create()
    {
        return view('public.checkout', [
            'tikets' => Tiket::where('aktif', true)->get(),
            'merchandises' => Merchandise::where('stok', '>', 0)->get(),
            'upsells' => UpsellPackage::where('aktif', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'no_hp' => ['required', 'string', 'max:15'],
            'tanggal_kunjungan' => ['required', 'date'],
            'id_tiket' => ['required', Rule::exists('tikets', 'id_tiket')],
            'jumlah_tiket' => ['required', 'integer', 'min:1'],
            'id_upsell_package' => ['nullable', 'array'],
            'id_upsell_package.*' => ['integer', Rule::exists('upsell_packages', 'id')],
            'id_produk' => ['nullable', 'array'],
            'id_produk.*' => ['integer', Rule::exists('merchandises', 'id_produk')],
            'jumlah_produk' => ['nullable', 'array'],
            'membership_tier' => ['nullable', 'in:Silver,Gold,Premium'],
            'metode' => ['required', 'string', 'max:50'],
        ]);

        return DB::transaction(function () use ($data, $request) {
            $pengunjung = Pengunjung::updateOrCreate(
                ['email' => $data['email']],
                ['nama' => $data['nama'], 'no_hp' => $data['no_hp']]
            );

            $transaksi = Transaksi::create([
                'id_pengunjung' => $pengunjung->id_pengunjung,
                'tanggal' => $data['tanggal_kunjungan'],
                'total' => 0,
                'status' => 'menunggu',
            ]);

            $total = 0;

            $tiket = Tiket::findOrFail($data['id_tiket']);
            $hargaTiket = $tiket->hitungHargaDinamis($data['tanggal_kunjungan']);
            $subtotalTiket = $hargaTiket * (int) $data['jumlah_tiket'];
            $total += $subtotalTiket;

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_tiket' => $tiket->id_tiket,
                'jenis_item' => 'tiket',
                'nama_item' => $tiket->jenis_tiket,
                'jumlah' => (int) $data['jumlah_tiket'],
                'subtotal' => $subtotalTiket,
            ]);

            foreach (($data['id_upsell_package'] ?? []) as $idUpsell) {
                $upsell = UpsellPackage::find($idUpsell);
                if ($upsell) {
                    $total += (float) $upsell->harga;
                    DetailTransaksi::create([
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_upsell_package' => $upsell->id,
                        'jenis_item' => 'upsell',
                        'nama_item' => $upsell->nama_paket,
                        'jumlah' => 1,
                        'subtotal' => $upsell->harga,
                    ]);
                }
            }

            foreach (($data['id_produk'] ?? []) as $idProduk) {
                $qty = (int) ($request->input("jumlah_produk.$idProduk", 0));
                if ($qty <= 0) { continue; }

                $produk = Merchandise::lockForUpdate()->find($idProduk);
                if (!$produk || !$produk->cekStok($qty)) {
                    abort(422, "Stok {$produk?->nama_produk} tidak cukup.");
                }

                $subtotal = (float) $produk->harga * $qty;
                $kontribusi = $produk->hitungKontribusi($subtotal);
                $total += $subtotal;

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $produk->id_produk,
                    'jenis_item' => 'merchandise',
                    'nama_item' => $produk->nama_produk,
                    'jumlah' => $qty,
                    'subtotal' => $subtotal,
                    'kontribusi_konservasi' => $kontribusi,
                ]);

                $produk->decrement('stok', $qty);
                $produk->increment('jumlah_terjual', $qty);
            }

            if (!empty($data['membership_tier'])) {
                Membership::updateOrCreate(
                    ['id_pengunjung' => $pengunjung->id_pengunjung],
                    ['status_member' => $data['membership_tier'], 'tanggal_daftar' => now()->toDateString()]
                );
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'jenis_item' => 'membership',
                    'nama_item' => 'Membership '.$data['membership_tier'],
                    'jumlah' => 1,
                    'subtotal' => 0,
                ]);
            }

            $transaksi->update(['total' => $total, 'status' => 'berhasil']);

            Pembayaran::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'metode' => $data['metode'],
                'status' => 'berhasil',
                'nominal' => $total,
                'kode_referensi' => 'PAY-'.str_pad((string) $transaksi->id_transaksi, 6, '0', STR_PAD_LEFT),
            ]);

            return redirect()->route('checkout.success', $transaksi)->with('success', 'Checkout berhasil. Tiket dan invoice sudah dibuat.');
        });
    }

    public function success(Transaksi $transaksi)
    {
        $transaksi->load(['pengunjung', 'details', 'pembayaran']);
        return view('public.checkout-success', compact('transaksi'));
    }
}
