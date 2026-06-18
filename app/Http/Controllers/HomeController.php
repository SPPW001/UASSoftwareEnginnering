<?php

namespace App\Http\Controllers;

use App\Models\EventPromo;
use App\Models\Merchandise;
use App\Models\Tiket;
use App\Models\UpsellPackage;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home', [
            'tikets' => Tiket::where('aktif', true)->take(3)->get(),
            'merchandises' => Merchandise::take(3)->get(),
            'events' => EventPromo::where('aktif', true)->latest()->take(3)->get(),
            'upsells' => UpsellPackage::where('aktif', true)->take(3)->get(),
        ]);
    }

    public function membership() { return view('public.membership'); }
    public function merchandise() { return view('public.merchandise', ['merchandises' => Merchandise::all()]); }
    public function events() { return view('public.events', ['events' => EventPromo::latest()->get()]); }
    public function partnership() { return view('public.partnership'); }
    public function faq() { return view('public.faq'); }
}
