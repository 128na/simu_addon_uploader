<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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
    $lang = $request->query('lang', config('app.fallback_locale'));

    if (array_key_exists($lang, config('app.languages'))) {
      logger('locale:'.$lang);
      \App::setLocale($lang);
    }
    return $next($request);
  }
}
