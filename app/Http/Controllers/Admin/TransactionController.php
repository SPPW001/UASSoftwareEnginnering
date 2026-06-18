<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transactions.index', ['items' => Transaksi::with(['pengunjung','pembayaran'])->latest()->paginate(10)]);
    }
    public function show(Transaksi $transaction)
    {
        return view('admin.transactions.show', ['item' => $transaction->load(['pengunjung','details','pembayaran'])]);
    }
}
