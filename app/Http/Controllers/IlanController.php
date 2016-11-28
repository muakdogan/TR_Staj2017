<?php

namespace App\Http\Controllers;

use Request;
use App\Il;
use App\Firma;
use App\OdemeTuru;
use App\Sektor;
use DB;
use Input;
use View;
use Response;
use Illuminate\Support\Str;

class IlanController extends Controller
{
    //
    public function showIlan(){
        $iller = Il::all();
        $firma=  Firma::all();
        $sektorler= Sektor::all();
        $odeme_turleri= OdemeTuru::all();
        
        $ilanlar = DB::table('ilanlar')
                ->join('firmalar', 'ilanlar.firma_id', '=', 'firmalar.id')
                ->join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->select(DB::raw('count(*) as ilan_count'))
                ->select('ilanlar.id as ilan_id',
                        'ilanlar.adi as ilanadi', 'ilanlar.*','firmalar.id as firmaid', 
                        'firmalar.*','adresler.id as adresid','adresler.*','iller.adi as iladi'
                        ); 
       
            $il_id = Input::get('il');
            $bas_tar = Input::get('bas_tar');
            $bit_tar = Input::get('bit_tar');   
            $sektorlerInput = Input::get('sektor');
            $tur = Input::get('tur');
            $usul= Input::get('usul');
            $radSearch= Input::get('radSearch');
            $input= Str::lower(Input::get('input'));
            $sozlesme= Input::get('sozles');
            $odeme= Input::get('odeme');
        if($radSearch != NULL){
            if($radSearch == "tum"){
                $ilanlar->where('LOWER(`ilanlar.adi`)' ,$input )->orWhere('LOWER(`ilanlar.usulu`) ',$input )
                        ->orWhere('LOWER(`ilanlar.ilan_turu`) ','LIKE', '%' . $input . '%')->orWhere('LOWER(`ilanlar.yayin_tarihi`) ','LIKE', '%' . $input . '%')
                        ->orWhere('LOWER(`ilanlar.kapanma_tarihi`) ','LIKE', '%' . $input . '%')
                        ->orWhere('LOWER(`ilanlar.sozlesme_turu`) ','LIKE', '%' . $input . '%')->orWhere('LOWER(`ilanlar.usulu`) ','LIKE', '%' . $input . '%');
            }
            else if($radSearch == "ilan_baslık"){
                $ilanlar->where('LOWER(`ilanlar.adi`) like ?', $input);
            }
            else{
                $ilanlar->where('LOWER(`firmalar.adi`) like ?', $input);
                
            }
        }
        if($il_id != NULL)
            {
             $ilanlar->whereIn('adresler.il_id',$il_id);
            }
        if ($bas_tar != NULL) {
            $ilanlar->where('ilanlar.yayin_tarihi','>=', $bas_tar);
        }
        if ($bit_tar != NULL) {
            $ilanlar->where('ilanlar.kapanma_tarihi','<=',$bit_tar);
        }
        if($sektorlerInput != NULL){
            $ilanlar->whereIn('ilanlar.firma_sektor',$sektorlerInput);
        }
        if($tur != NULL){
            $ilanlar->where('ilanlar.ilan_turu',$tur);
        }
        if($usul != NULL){
            $ilanlar->where('ilanlar.usulu',$usul);
        }
        if($sozlesme != NULL){
            $ilanlar->where('ilanlar.sozlesme_turu',$sozlesme);
        }
        if($odeme != NULL){
            $ilanlar->whereIn('ilanlar.odeme_turu_id',$odeme);
        }
        $ilanlar=$ilanlar->paginate(5);
        
        if (Request::ajax()) {
            return Response::json(View::make('Firma.ilan.ilanlar',array('ilanlar'=> $ilanlar))->render());
        }
        return View::make('Firma.ilan.deneme')-> with('ilanlar',$ilanlar)->with('iller', $iller)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)->with('firma',$firma);
    
    }
}
