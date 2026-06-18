<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function index()
    {
        return view('admin.memberships.index', ['items' => Membership::with('pengunjung')->latest()->paginate(10)]);
    }
}
