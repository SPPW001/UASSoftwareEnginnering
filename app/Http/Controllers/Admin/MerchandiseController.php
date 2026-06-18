<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    public function index() { return view('admin.merchandise.index', ['items' => Merchandise::latest()->paginate(10)]); }
    public function create() { return view('admin.merchandise.form', ['item' => new Merchandise()]); }
    public function store(Request $request) { Merchandise::create($this->validated($request)); return redirect()->route('admin.merchandise.index')->with('success', 'Produk ditambahkan.'); }
    public function edit(Merchandise $merchandise) { return view('admin.merchandise.form', ['item' => $merchandise]); }
    public function update(Request $request, Merchandise $merchandise) { $merchandise->update($this->validated($request)); return redirect()->route('admin.merchandise.index')->with('success', 'Produk diperbarui.'); }
    public function destroy(Merchandise $merchandise) { $merchandise->delete(); return back()->with('success', 'Produk dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['nama_produk'=>'required|max:100','kategori'=>'nullable|max:50','harga'=>'required|numeric|min:0','stok'=>'required|integer|min:0','jumlah_terjual'=>'nullable|integer|min:0','kontribusi'=>'required|numeric|min:0|max:100']); }
}
