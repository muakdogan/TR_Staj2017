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
        $firma = \App\Firma::find(session()->get('firma_id'));

        if (!$firma)//null ise
        {
            abort(403, 'Forbidden');
        }

        if ($firma->onay != '1')
        {
            abort(403, 'Forbidden');
            //echo "Onaylanmış bir firmaya ait değilsiniz.";

            //return redirect('/');
        }

        //date fonksiyonları PHP 5 gerektiriyor.

        $uyelikBitis = date_create($firma->uyelik_bitis_tarihi);//firmanın üyelik bitiş tarihini php date nesnesine al

        //echo "'<script>console.log('bitiş tarihi:'); console.log( \"$firma->uyelik_bitis_tarihi\" );</script>'";

        if ($firma->uyelik_bitis_tarihi != NULL && $uyelikBitis < date_create(NULL))
        {
            abort(403, 'Forbidden');
            //echo "Üyeliğiniz sona ermiştir.";

            //return redirect('/');
        }

        else if ($firma->uyelik_bitis_tarihi == NULL)
        {
            echo "'<script>console.log(\"Üyelik bitiş tarihi NULL.\")</script>'";
        }

        echo "<script>console.log( 'Yetki onaylandı' );</script>";
        return $next($request);
    }
}
