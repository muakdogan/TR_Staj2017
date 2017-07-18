<?php

namespace App\Http\Middleware;

use Closure;

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
        $firma = \App\Firma::find($request->id);

        if ($firma->onay != '1')
        {
            abort(403, 'Forbidden');
            //echo "Onaylanmış bir firmaya ait değilsiniz.";

            //return redirect('/');
        }

        //date fonksiyonları PHP 5 gerektiriyor.

        //TODO: uyelikBitisTarihi adını güncelle
        //$uyelikBitis = date_create($firma->uyelikBitisTarihi);//firmanın üyelik bitiş tarihini php date nesnesine al

        /*if ($uyelikBitis < date_create(NULL))
        {
            abort(403, 'Forbidden');
            //echo "Üyeliğiniz sona ermiştir.";

            //return redirect('/');
        }*/

        return $next($request);
    }
}
