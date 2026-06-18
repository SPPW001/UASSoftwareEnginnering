<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventPromo;
use Illuminate\Http\Request;

class EventPromoController extends Controller
{
    public function index() { return view('admin.events.index', ['items' => EventPromo::latest()->paginate(10)]); }
    public function create() { return view('admin.events.form', ['item' => new EventPromo()]); }
    public function store(Request $request) { EventPromo::create($this->validated($request)); return redirect()->route('admin.events.index')->with('success', 'Event/promo ditambahkan.'); }
    public function edit(EventPromo $event) { return view('admin.events.form', ['item' => $event]); }
    public function update(Request $request, EventPromo $event) { $event->update($this->validated($request)); return redirect()->route('admin.events.index')->with('success', 'Event/promo diperbarui.'); }
    public function destroy(EventPromo $event) { $event->delete(); return back()->with('success', 'Event/promo dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['nama_event'=>'required|max:100','tanggal_mulai'=>'required|date','tanggal_selesai'=>'required|date|after_or_equal:tanggal_mulai','diskon_persen'=>'required|numeric|min:0|max:100','deskripsi'=>'nullable','aktif'=>'nullable|boolean']); }
}
