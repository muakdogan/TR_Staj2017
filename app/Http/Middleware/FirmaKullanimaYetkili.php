<?php

namespace App\Http\Middleware;

use Closure;
use Barryvdh\Debugbar\Facade as Debugbar;

class FirmaKullanimaYetkili
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
        $firma = \App\Firma::find(session()->get('firma_id'));

        if (!$firma)//null ise
        {
            abort(403, 'Forbidden');
        }

        if ($firma->onay != '1')
        {
            abort(403, 'Forbidden');
        }

        //date fonksiyonları PHP 5 gerektiriyor.

        $uyelikBitis = date_create($firma->uyelik_bitis_tarihi);//firmanın üyelik bitiş tarihini php date nesnesine al

        if ($firma->uyelik_bitis_tarihi == NULL || $uyelikBitis < date_create(NULL))
        {
            abort(403, 'Forbidden');
        }

        Debugbar::info("Yetki onaylandı");

        return $next($request);
    }
}
