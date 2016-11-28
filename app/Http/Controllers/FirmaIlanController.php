<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Firma;
use App\Il;
use App\Ilan;
use App\Kullanici;
use Illuminate\Support\Facades\Validator;
use Session;
use Gate;
use File;
use Illuminate\Support\Facades\Redirect;
class FirmaIlanController extends Controller
{
    //
     public function showFirmaIlan($id,$ilanid){
        $firma = Firma::find($id);
         $ilan = Ilan::find($ilanid);
          if (Gate::denies('show', $firma)) {
              return Redirect::to('/');
        }
        
        $sektorler= \App\ Sektor::all();
        $maliyetler=  \App\Maliyet::all();
        $odeme_turleri= \App\OdemeTuru::all();
        $para_birimleri= \App\ParaBirimi::all();
        $iller = Il::all();
        $birimler=  \App\Birim::all();
       
       
        return view('Firma.ilan.firmailan', ['firma' => $firma])->with('iller',$iller)->with('sektorler',$sektorler)->with('maliyetler',$maliyetler)->with('odeme_turleri',$odeme_turleri)->with('para_birimleri',$para_birimleri)->with('birimler',$birimler)->with('ilan',$ilan);
    }
     public function showFirmaIlanEkle($id,$ilan_id,$kul_id){
        $firma = Firma::find($id);
        $ilan = Ilan::find($ilan_id);
        $kullanici = \App\Kullanici::find($kul_id);
          if (Gate::denies('show', $firma)) {
              return Redirect::to('/');
        }
        $sektorler= \App\ Sektor::all();
        $maliyetler=  \App\Maliyet::all();
        $odeme_turleri= \App\OdemeTuru::all();
        $para_birimleri= \App\ParaBirimi::all();
        $iller = Il::all();
        $birimler=  \App\Birim::all();
       
        return view('Firma.ilan.firmaIlanEkle', ['firma' => $firma])->with('iller',$iller)->with('sektorler',$sektorler)->with('maliyetler',$maliyetler)->with('odeme_turleri',$odeme_turleri)->with('para_birimleri',$para_birimleri)->with('birimler',$birimler)->with('ilan',$ilan)->with('kullanici',$kullanici);
    }
     public function firmaBilgilerimAdd(Request $request,$id){
        $firma = Firma::find($request->id);
          
        $firma->adi = $request->firma_adi;
        $firma->goster = $request->firma_adi_gizli;
        $firma->save();
        
        $sektor = $firma->sektorler ?: new \App\Sektor();
        $sektor->adi=$request->firma_sektor;
        $firma->sektorler()->attach($sektor);
        return redirect('/firmaIlanOlustur/'.$firma->id);
   
         
     }
    
     public function fiyatlandırmaBilgileriAdd(Request $request,$id,$ilan_id){
         $firma = Firma::find($request->id);
         $ilan = Ilan::find($ilan_id);
        
         
         $ilan->kdv_dahil=$request->kdv;
         $ilan->odeme_turu_id=$request->odeme_turu;
         $ilan->para_birimi_id=$request->para_birimi;
         $firma->ilanlar()->save($ilan);
         
         return redirect('ilanEkle/'.$firma->id.'/'.$ilan->id);
         
     }
     public function fiyatlandırmaBilgileriUpdate(Request $request,$id,$ilanid){
         $firma = Firma::find($request->id);
         $ilan = Ilan::find($ilanid);
        
         $ilan->kdv_dahil=$request->kdv;
         $ilan->odeme_turu_id=$request->odeme_turu;
         $ilan->para_birimi_id=$request->para_birimi;
         $firma->ilanlar()->save($ilan);
         
         return redirect('firmaIlanOlustur/'.$firma->id.'/'.$ilan->id);
         
     }
     public function ilanAdd(Request $request){
         $file = $request->file('teknik');
        
        // getting all of the post data
        $file = array('teknik' => $request->file('teknik'));
        // setting up rules
        $rules = array('teknik' => 'mimes:pdf|max:100000'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('firmaIlanOlustur/'.$request->id)->withInput()->withErrors($validator);
        } 
        else {
            // checking file is valid.
            if ($request->file('teknik')->isValid()) {
                $destinationPath = 'Teknik'; // upload path
                $extension = $request->file('teknik')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image

                $firma = Firma::find($request->id);
                
                $firma->goster = $request->firma_adi_gizli;
                $firma->save();
                
                $ilan=  new \App\Ilan();
                
               
                    $ilan->adi= $request->ilan_adi;
                    $ilan->firma_sektor=$request->firma_sektor;
                    $ilan->yayin_tarihi= $request->yayinlama_tarihi;
                    $ilan->kapanma_tarihi= $request->kapanma_tarihi;
                    $ilan->aciklama = $request->aciklama;
                    $ilan->ilan_turu= $request->ilan_turu;
                    $ilan->usulu= $request->ilan_usulu;
                    $ilan->sozlesme_turu= $request->sozlesme_turu;
                    
                    $ilan->teknik_sartname = $fileName;
                 
                    
                    $ilan->yaklasik_maliyet_id= $request->yaklasik_maliyet;
                    $ilan->teslim_yeri_satici_firma= $request->teslim_yeri;
                    $ilan->teslim_yeri_il_id= $request->il_id;
                    $ilan->teslim_yeri_ilce_id= $request->ilce_id;
                    $ilan->isin_suresi= $request->isin_suresi;
                    $ilan->is_baslama_tarihi= $request->is_baslama_tarihi;
                    $ilan->is_bitis_tarihi= $request->is_bitis_tarihi;
                    $ilan->adi= $request->ilan_adi;
                    $firma->ilanlar()->save($ilan);
                
                

                $request->file('teknik')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');
                /*if ($firma->firma_brosurler){
                    
                File::delete("brosur/$oldName");
                }*/
                return Redirect::to('ilanEkle/'.$firma->id.'/'.$ilan->id);
                //return  Redirect::route('commucations')->with('fileName', $fileName);
            } 
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('firmaIlanOlustur/'.$firma->id)->withInput()->withErrors($validator);
            }
        }
         
     }
     public function ilanUpdate(Request $request,$ilan_id){
         $file = $request->file('teknik');
        
        // getting all of the post data
        $file = array('teknik' => $request->file('teknik'));
        // setting up rules
        $rules = array('teknik' => 'mimes:pdf|max:100000'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('firmaIlanOlustur/'.$request->id)->withInput()->withErrors($validator);
        } 
        else {
            // checking file is valid.
            if ($request->file('teknik')->isValid()) {
                $destinationPath = 'Teknik'; // upload path
                $extension = $request->file('teknik')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image

                $firma = Firma::find($request->id);
                $ilanlar = Ilan::find($ilan_id);
                $firma->goster = $request->firma_adi_gizli;
                $firma->save();
                
                $ilan=  $firma->ilanlar ?:new \App\Ilan();
                
               
                    $ilan->adi= $request->ilan_adi;
                    $ilan->firma_sektor=$request->firma_sektor;
                    $ilan->yayin_tarihi= $request->yayinlama_tarihi;
                    $ilan->kapanma_tarihi= $request->kapanma_tarihi;
                    $ilan->aciklama = $request->aciklama;
                    $ilan->ilan_turu= $request->ilan_turu;
                    $ilan->usulu= $request->ilan_usulu;
                    $ilan->sozlesme_turu= $request->sozlesme_turu;
                    
                    $ilan->teknik_sartname = $fileName;
                 
                    
                    $ilan->yaklasik_maliyet_id= $request->yaklasik_maliyet;
                    $ilan->teslim_yeri_satici_firma= $request->teslim_yeri;
                    $ilan->teslim_yeri_il_id= $request->il_id;
                    $ilan->teslim_yeri_ilce_id= $request->ilce_id;
                    $ilan->isin_suresi= $request->isin_suresi;
                    $ilan->is_baslama_tarihi= $request->is_baslama_tarihi;
                    $ilan->is_bitis_tarihi= $request->is_bitis_tarihi;
                    $ilan->adi= $request->ilan_adi;
                    $firma->ilanlar()->save($ilan);
                
                

                $request->file('teknik')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');
                /*if ($firma->firma_brosurler){
                    
                File::delete("brosur/$oldName");
                }*/
                return Redirect::to('firmaIlanOlustur/'.$firma->id.'/'.$ilan->id);
                //return  Redirect::route('commucations')->with('fileName', $fileName);
            } 
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('firmaIlanOlustur/'.$firma->id)->withInput()->withErrors($validator);
            }
        }
         
     }
   
    public function kalemlerListesiMal(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $mal=  new \App\IlanMal();
         
         $mal->sira=$request->sira;
         $mal->marka=$request->marka;
         $mal->model=$request->model;
         $mal->adi=$request->adi;
         $mal->ambalaj=$request->ambalaj;
         $mal->miktar=$request->miktar;
         $mal->birim_id=$request->birim;   
         
         $ilan->ilan_mallar()->save($mal);
         
         return redirect('/firmaIlanOlustur/'.$ilan->firma_id.'/'.$mal->ilan_id);
         
     }
    public function kalemlerListesiHizmet(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $hizmet=  new \App\IlanHizmet();
         $hizmet->sira=$request->sira;
         $hizmet->adi=$request->adi;
         $hizmet->fiyat_standardi=$request->fiyat_standardi;
         $hizmet->fiyat_standardi_birim_id=$request->fiyat_standardi_birimi;
         $hizmet->miktar=$request->miktar;   
         $hizmet->miktar_birim_id=$request->miktar_birim_id;
         $ilan->ilan_hizmetler()->save($hizmet);
         
         return redirect('/firmaIlanOlustur/'.$ilan->firma_id.'/'.$hizmet->ilan_id);
         
     }
    public function kalemlerListesiGoturu(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $goturu= new \App\IlanGoturuBedel();
         $goturu->sira=$request->sira;
         $goturu->isin_adi=$request->isin_adi;
         $goturu->miktar_turu=$request->miktar_turu;
         $ilan->ilan_goturu_bedeller()->save($goturu);
         
         return redirect('/firmaIlanOlustur/'.$ilan->firma_id.'/'.$goturu->ilan_id);
         
     }
    public function kalemlerListesiYapimİsi(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $yapim=  new \App\IlanYapimIsi();
         $yapim->sira=$request->sira;
         $yapim->adi=$request->adi;
         $yapim->miktar=$request->miktar;
         $yapim->birim_id=$request->birim;
         $ilan->ilan_yapim_isleri()->save($yapim);
         
         return redirect('/firmaIlanOlustur/'.$ilan->firma_id.'/'.$yapim->ilan_id);
         
     }
     
    public function kalemlerListesiMalUpdate(Request $request,$id){  
        
         $mallar = \App\IlanMal::find($id);
         $mallar->sira=$request->sira;
         $mallar->marka=$request->marka;
         $mallar->model=$request->model;
         $mallar->adi=$request->adi;
         $mallar->ambalaj=$request->ambalaj;
         $mallar->miktar=$request->miktar;
         $mallar->birim_id=$request->birim; 
         $mallar->save();
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$mallar->ilan_id);
    }  
    public function kalemlerListesiHizmetUpdate(Request $request,$id){  
        
         $hizmetler = \App\IlanHizmet::find($id);
         
         $hizmetler->sira=$request->sira;
         $hizmetler->adi=$request->adi;
         $hizmetler->fiyat_standardi=$request->fiyat_standardi;
         $hizmetler->fiyat_standardi_birim_id=$request->fiyat_standardi_birimi;
         $hizmetler->miktar=$request->miktar;   
         $hizmetler->miktar_birim_id=$request->miktar_birim_id;
         $hizmetler->save();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$hizmetler->ilan_id);
    }
    public function kalemlerListesiGoturuUpdate(Request $request,$id){  
        
         $goturuler = \App\IlanGoturuBedel::find($id);
         
         $goturuler->sira=$request->sira;
         $goturuler->isin_adi=$request->isin_adi;
         $goturuler->miktar_turu=$request->miktar_turu;
         $goturuler->save();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$goturuler->ilan_id);
    }
    public function kalemlerListesiYapimİsiUpdate(Request $request,$id){  
        
         $yapimlar = \App\IlanYapimIsi::find($id);
         
         $yapimlar->sira=$request->sira;
         $yapimlar->adi=$request->adi;
         $yapimlar->miktar=$request->miktar;
         $yapimlar->birim_id=$request->birim;
         $yapimlar->save();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$yapimlar->ilan_id);
    }
    
    public function deleteMal(Request $request,$id){  
        
         $mal = \App\IlanMal::find($id);
         
         $mal->delete();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$mal->ilan_id);
    }
    public function deleteHizmet(Request $request,$id){  
        
         $hizmet = \App\IlanHizmet::find($id);
         
         $hizmet->delete();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$hizmet->ilan_id);
    }
    public function deleteGoturu(Request $request,$id){  
        
         $goturu = \App\IlanGoturuBedel::find($id);
         
         $goturu->delete();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$goturu->ilan_id);
    }
    public function deleteYapim(Request $request,$id){  
        
        $yapim = \App\IlanYapimIsi::find($id);
         
         $yapim ->delete();
         
        return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$yapim->ilan_id);
    }
     
     public function kalemlerListesiMalEkle(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
          $mal= new \App\IlanMal();
         $mal->sira=$request->sira;
         $mal->marka=$request->marka;
         $mal->model=$request->model;
         $mal->adi=$request->adi;
         $mal->ambalaj=$request->ambalaj;
         $mal->miktar=$request->miktar;
         $mal->birim_id=$request->birim;   
         
         $ilan->ilan_mallar()->save($mal);
         
         return redirect('ilanEkle/'.$ilan->firma_id.'/'.$ilan->id);
         
     }
     public function kalemlerListesiGoturuEkle(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $goturu= new \App\IlanGoturuBedel();
         $goturu->sira=$request->sira;
         $goturu->isin_adi=$request->isin_adi;
         $goturu->miktar_turu=$request->miktar_turu;
         $ilan->ilan_goturu_bedeller()->save($goturu);
         
         return redirect('ilanEkle/'.$ilan->firma_id.'/'.$ilan->id);
         
     }
     public function kalemlerListesiHizmetEkle(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $hizmet=  new \App\IlanHizmet();
         $hizmet->sira=$request->sira;
         $hizmet->adi=$request->adi;
         $hizmet->fiyat_standardi=$request->fiyat_standardi;
         $hizmet->fiyat_standardi_birim_id=$request->fiyat_standardi_birimi;
         $hizmet->miktar=$request->miktar;   
         $hizmet->miktar_birim_id=$request->miktar_birim_id;
         $ilan->ilan_hizmetler()->save($hizmet);
         
         return redirect('ilanEkle/'.$ilan->firma_id.'/'.$ilan->id);
         
     }
     public function kalemlerListesiYapimİsiEkle(Request $request,$id){
         
         $ilan = Ilan::find($request->id);
         $yapim=  new \App\IlanYapimIsi();
         $yapim->sira=$request->sira;
         $yapim->adi=$request->adi;
         $yapim->miktar=$request->miktar;
         $yapim->birim_id=$request->birim;
         $ilan->ilan_yapim_isleri()->save($yapim);
         
         return redirect('ilanEkle/'.$ilan->firma_id.'/'.$ilan->id);
         
     }
     
     public function kalemlerListesiMalUpdateEkle(Request $request,$id){  
        
         $mallar = \App\IlanMal::find($id);
         $mallar->sira=$request->sira;
         $mallar->marka=$request->marka;
         $mallar->model=$request->model;
         $mallar->adi=$request->adi;
         $mallar->ambalaj=$request->ambalaj;
         $mallar->miktar=$request->miktar;
         $mallar->birim_id=$request->birim; 
         $mallar->save();
        return redirect('ilanEkle/'.$request->firma_id.'/'.$mallar->ilan_id);
    }
     public function kalemlerListesiHizmetUpdateEkle(Request $request,$id){  
        
         $hizmetler = \App\IlanHizmet::find($id);
         
         $hizmetler->sira=$request->sira;
         $hizmetler->adi=$request->adi;
         $hizmetler->fiyat_standardi=$request->fiyat_standardi;
         $hizmetler->fiyat_standardi_birim_id=$request->fiyat_standardi_birimi;
         $hizmetler->miktar=$request->miktar;   
         $hizmetler->miktar_birim_id=$request->miktar_birim_id;
         $hizmetler->save();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$hizmetler->ilan_id);
    }
     public function kalemlerListesiGoturuUpdateEkle(Request $request,$id){  
        
         $goturuler = \App\IlanGoturuBedel::find($id);
         
         $goturuler->sira=$request->sira;
         $goturuler->isin_adi=$request->isin_adi;
         $goturuler->miktar_turu=$request->miktar_turu;
         $goturuler->save();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$goturuler->ilan_id);
    }
     public function kalemlerListesiYapimİsiUpdateEkle(Request $request,$id){  
        
         $yapimlar = \App\IlanYapimIsi::find($id);
         
         $yapimlar->sira=$request->sira;
         $yapimlar->adi=$request->adi;
         $yapimlar->miktar=$request->miktar;
         $yapimlar->birim_id=$request->birim;
         $yapimlar->save();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$yapimlar->ilan_id);
    }
    
    public function deleteMalEkle(Request $request,$id){  
        
         $mal = \App\IlanMal::find($id);
         
         $mal->delete();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$mal->ilan_id);
    }
    public function deleteHizmetEkle(Request $request,$id){  
        
         $hizmet = \App\IlanHizmet::find($id);
         
         $hizmet->delete();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$hizmet->ilan_id);
    }
    public function deleteGoturuEkle(Request $request,$id){  
        
         $goturu = \App\IlanGoturuBedel::find($id);
         
         $goturu->delete();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$goturu->ilan_id);
    }
    public function deleteYapimEkle(Request $request,$id){  
        
        $yapim = \App\IlanYapimIsi::find($id);
         
         $yapim ->delete();
         
        return redirect('ilanEkle/'.$request->firma_id.'/'.$yapim->ilan_id);
    }
 
}
