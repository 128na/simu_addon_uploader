<?php

namespace App\Http\Middleware;

use Closure;

class SelectLocale
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $lang = $request->cookie('lang', 'en');
    \App::setLocale($lang);
    return $next($request);
  }
}
