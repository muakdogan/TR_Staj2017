<?php
/**
 * Created by PhpStorm.
 * User: OSMAN
 * Date: 21.08.2017
 * Time: 12:12
 */

namespace App\Http\Middleware;
use App\Ilan;
use Closure;
use Barryvdh\Debugbar\Facade as Debugbar;

class ilanSahibiDogrulama
{
        public function handle($request, Closure $next){

            if($request->ilanID!=null){
                $ilan=Ilan::find($request->ilanID);
            }
            else{
                abort(403, 'eksik bilgi var');
            }

            if($ilan==null || session()->get('firma_id')!= $ilan->firma_id) {
                abort(403, 'ilan sahibi dogrulanmadi');
            }

            $request->merge(array("ilan" => $ilan));

            return $next($request);
        }
}




