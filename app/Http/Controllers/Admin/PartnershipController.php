<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function index() { return view('admin.partnerships.index', ['items' => Partnership::with('perusahaan')->latest()->paginate(10)]); }
    public function create() { return view('admin.partnerships.form', ['item' => new Partnership(), 'perusahaans' => Perusahaan::all()]); }
    public function store(Request $request) {
        $data = $this->validated($request);
        if (!empty($data['nama_perusahaan_baru'])) {
            $perusahaan = Perusahaan::create(['nama_perusahaan' => $data['nama_perusahaan_baru']]);
            $data['id_perusahaan'] = $perusahaan->id_perusahaan;
        }
        unset($data['nama_perusahaan_baru']);
        Partnership::create($data);
        return redirect()->route('admin.partnerships.index')->with('success', 'Partnership ditambahkan.');
    }
    public function edit(Partnership $partnership) { return view('admin.partnerships.form', ['item' => $partnership, 'perusahaans' => Perusahaan::all()]); }
    public function update(Request $request, Partnership $partnership) { $partnership->update($this->validated($request)); return redirect()->route('admin.partnerships.index')->with('success', 'Partnership diperbarui.'); }
    public function destroy(Partnership $partnership) { $partnership->delete(); return back()->with('success', 'Partnership dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['id_perusahaan'=>'nullable|exists:perusahaans,id_perusahaan','nama_perusahaan_baru'=>'nullable|string|max:100','jenis_kerjasama'=>'required|max:50','tanggal_mulai'=>'nullable|date','tanggal_selesai'=>'nullable|date','kontribusi'=>'required|numeric|min:0','status'=>'required|max:20']); }
}
