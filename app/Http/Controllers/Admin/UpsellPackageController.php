<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpsellPackage;
use Illuminate\Http\Request;

class UpsellPackageController extends Controller
{
    public function index() { return view('admin.upsells.index', ['items' => UpsellPackage::latest()->paginate(10)]); }
    public function create() { return view('admin.upsells.form', ['item' => new UpsellPackage()]); }
    public function store(Request $request) { UpsellPackage::create($this->validated($request)); return redirect()->route('admin.upsells.index')->with('success', 'Upsell package ditambahkan.'); }
    public function edit(UpsellPackage $upsell) { return view('admin.upsells.form', ['item' => $upsell]); }
    public function update(Request $request, UpsellPackage $upsell) { $upsell->update($this->validated($request)); return redirect()->route('admin.upsells.index')->with('success', 'Upsell package diperbarui.'); }
    public function destroy(UpsellPackage $upsell) { $upsell->delete(); return back()->with('success', 'Upsell package dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['nama_paket'=>'required|max:100','harga'=>'required|numeric|min:0','deskripsi'=>'nullable','aktif'=>'nullable|boolean']); }
}
