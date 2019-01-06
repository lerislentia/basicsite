<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;

class Localization
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
            if(Session::has('locale')){
                $locale = Session::get('locale');
            }
            else{
                $locale = Config::get('app.locale');
            }
            \App::setlocale($locale);
            Session(['locale' => $locale]);
            // if(!Session::has('locales')){
            //     $locales = $localesService->index()->get()->toarray();
            // }
            return $next($request);
        }
}
