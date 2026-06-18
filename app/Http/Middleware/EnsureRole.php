<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = User::find(session('user_id'));

        if (!$user || !in_array($user->role, $roles, true)) {
            abort(403, 'Akses ditolak. Role Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
