<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Hellotreedigital\Cms\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $language = Language::where('slug', $request->locale)->first();
        if(!$language){
            return response()->json(['404' => true]);
        }else{
            App::setLocale($language->slug);
            URL::defaults(['locale' => $language->slug]);
        }


        return $next($request);
    }
}
