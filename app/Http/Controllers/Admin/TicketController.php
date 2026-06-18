<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() { return view('admin.tickets.index', ['items' => Tiket::latest()->paginate(10)]); }
    public function create() { return view('admin.tickets.form', ['item' => new Tiket()]); }
    public function store(Request $request) { Tiket::create($this->validated($request)); return redirect()->route('admin.tickets.index')->with('success', 'Tiket ditambahkan.'); }
    public function edit(Tiket $ticket) { return view('admin.tickets.form', ['item' => $ticket]); }
    public function update(Request $request, Tiket $ticket) { $ticket->update($this->validated($request)); return redirect()->route('admin.tickets.index')->with('success', 'Tiket diperbarui.'); }
    public function destroy(Tiket $ticket) { $ticket->delete(); return back()->with('success', 'Tiket dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['jenis_tiket'=>'required|max:50','kategori'=>'nullable|max:50','harga'=>'required|numeric|min:0','kapasitas_harian'=>'required|integer|min:1','aktif'=>'nullable|boolean']); }
}
