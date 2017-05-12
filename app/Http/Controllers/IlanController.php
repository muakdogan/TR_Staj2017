<?php

namespace App\Http\Controllers;
use Request;
use App\Il;
use App\Firma;
use App\OdemeTuru;
use App\Sektor;
use App\BelirlIstekli;
use DB;
use App\Ilan;
use Input;
use View;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Str;
class IlanController extends Controller
{
    //
    public function showIlan(){
        $dt = Carbon::now();
        $dt->toDateString();  
        $iller = Il::all();
        $firma=  Firma::all();
        $sektorler= Sektor::all();
        $odeme_turleri= OdemeTuru::all();
        $teklifler= \App\Teklif::all();
        if(session()->get('firma_id') == null){ 
            $sektor_id = 0;
            $davetEdildigimIlanlar = null;
        }else{
            $fId = session()->get('firma_id');
            $firmaSektor = Firma::find($fId);
            foreach($firmaSektor->sektorler as $sektor){
                        $sektor_id = $sektor->id;
            }
            $davetEdildigimIlanlar = BelirlIstekli::where('firma_id',$fId)->get();
        }
        $ilanlar = Ilan::join('firmalar', 'ilanlar.firma_id', '=', 'firmalar.id')
                ->join('adresler', 'adresler.firma_id', '=', 'firmalar.id')
                ->join('iller', 'adresler.il_id', '=', 'iller.id')
                ->where('adresler.tur_id', '=' , 1)
                ->where('ilanlar.yayin_tarihi', '<=' , $dt->today())
                ->where('ilanlar.kapanma_tarihi', '>=' , $dt->today())
                ->orderBy('ilanlar.yayin_tarihi', 'DESC')
                ->select('ilanlar.id as ilan_id','ilanlar.adi as ilanadi', 'ilanlar.*','firmalar.id as firmaid', 'firmalar.*','adresler.id as adresid','adresler.*','iller.adi as iladi'); 
        $ilId = Input::get('ilAdi');
        $keyword = Input::get('keyword');
        $il_id = Input::get('il');
        $bas_tar = Input::get('bas_tar');
        $bit_tar = Input::get('bit_tar');   
        $sektorlerInput = Input::get('sektor');
        $tur = Input::get('tur');
        $usul= Input::get('usul');
        $radSearch= Input::get('radSearch');
        $input= Input::get('input');
        $sozlesme= Input::get('sozles');
        $odeme= Input::get('odeme');
        
        if($radSearch != NULL){
            if($radSearch == "tum"){
                $sektorler = Sektor::all();
                foreach ($sektorler as $sektor){
                    if($sektor->adi == $input){
                        $sektor_id = $sektor->id;
                    }
                    else{
                        $sektor_id = 0;
                    }
                }
                $ilanlar->where('ilanlar.adi',$input )->where('ilanlar.goster',1);
                        //->orWhere('ilanlar.ilan_turu',$input)->orWhere('ilanlar.yayin_tarihi',$input )
                        //->orWhere('ilanlar.kapanma_tarihi', $input )
                        //->orWhere('firmalar.adi',$input )
                        //->orWhere('ilanlar.firma_sektor',$sektor_id)
                        //->orWhere('ilanlar.sozlesme_turu',$input)->orWhere('ilanlar.usulu', $input);
            }
            else if($radSearch == "ilan_baslık"){
                $ilanlar->where('ilanlar.adi', $input);
            }
            else{
                $ilanlar->where('firmalar.adi', $input);                
            }
        }
        if($ilId != NULL){
            $ilanlar->where('adresler.il_id',$ilId);
        }
        if($keyword != NULL){
            $sektorler = Sektor::all();
            foreach ($sektorler as $sektor){
                if($sektor->adi == $keyword){
                    $sektor_id = $sektor->id;
                }
                else{
                    $sektor_id = 0;
                }
            }
            //$ilanlar->where('ilanlar.adi' ,$keyword )
            //->Where('firmalar.adi',$keyword )->where('ilanlar.goster',1)
            //->Where('ilanlar.firma_sektor',$sektor_id);
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
            $ilanlar->whereIn('ilanlar.ilan_sektor',$sektorlerInput);
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
        
        return View::make('Firma.ilan.ilanAra')-> with('ilanlar',$ilanlar)
                ->with('iller', $iller)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)
                ->with('firma',$firma)->with('teklifler',$teklifler)->with('sektorler',$sektorler)->with('odeme_turleri',$odeme_turleri)
                ->with('ilId',$ilId)->with('keyword',$keyword)->with('sektor_id',$sektor_id)->with('davetEdildigimIlanlar',$davetEdildigimIlanlar);
    
    }
}
