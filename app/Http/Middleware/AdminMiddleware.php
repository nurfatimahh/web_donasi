<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
  /**
   * Handle an incoming request.
   * Allow only users with role 'admin'.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    $user = Auth::user();

    if (! $user || ($user->role ?? 'user') !== 'admin') {
      return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
    }

    return $next($request);
  }
}
