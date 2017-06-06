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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use DB;
class FirmaIlanController extends Controller
{
  /*public function __construct(){
  $this->middleware('auth', ['only' => 'showFirmaIlanEkle']);
}*/
//
public function showFirmaIlanEkle($id,$ilan_id){
  $firma = Firma::find($id);
  $ilan = Ilan::find($ilan_id);
  if (Gate::denies('show', $firma)) {
    return redirect()->intended();
  }
  /*if (Gate::denies('createIlan')) {
    return redirect()->intended();
  }*/
  $sektorler= \App\ Sektor::all();
  $maliyetler=  \App\Maliyet::all();
  $odeme_turleri= \App\OdemeTuru::all();
  $para_birimleri= \App\ParaBirimi::all();
  $iller = Il::all();
  $birimler=  \App\Birim::all();

  return view('Firma.ilan.firmaIlanEkle', ['firma' => $firma])->with('iller',$iller)->with('sektorler',$sektorler)->with('maliyetler',$maliyetler)->with('odeme_turleri',$odeme_turleri)->with('para_birimleri',$para_birimleri)->with('birimler',$birimler)->with('ilan',$ilan);
}
public function ilanUpdate(Request $request,$id,$ilan_id){
  /*$rules = array('teknik' => 'mimes:pdf|max:100000');
  $validator = Validator::make($file, $rules);
  if ($validator->fails()) {
    return Redirect::to('firmaIlanOlustur/'.$request->id)->withInput()->withErrors($validator);
  }*/
  //else {
    //if ($request->file('teknik')->isValid()) {
      $firma = Firma::find($id);
      $ilan = Ilan::find($ilan_id);
      $ilan->adi=Str::title(strtolower( $request->ilan_adi));
      $ilan->ilan_sektor=$request->firma_sektor;
      $ilan->yayin_tarihi=date('Y-m-d', strtotime($request->yayinlanma_tarihi));
      $ilan->kapanma_tarihi= date('Y-m-d', strtotime($request->kapanma_tarihi));
      $ilan->aciklama =Str::title(strtolower( $request->aciklama));
      $ilan->ilan_turu= $request->ilan_turu;
      $ilan->katilimcilar= $request->katilimcilar;
      $ilan->rekabet_sekli= $request->rekabet_sekli;
      $ilan->sozlesme_turu= $request->sozlesme_turu;
      $ilan->odeme_turu_id=$request->odeme_turu;
      $ilan->para_birimi_id=$request->para_birimi;
      $ilan->kismi_fiyat=$request->kismi_fiyat;
      $ilan->yaklasik_maliyet= $request->maliyet;
      $ilan->komisyon_miktari=$request->yaklasik_maliyet;
      $ilan->teslim_yeri_satici_firma= $request->teslim_yeri;
      $ilan->teslim_yeri_il_id= $request->il_id;
      $ilan->teslim_yeri_ilce_id= $request->ilce_id;
      $ilan->isin_suresi= $request->isin_suresi;
      $ilan->is_baslama_tarihi= date('Y-m-d', strtotime($request->is_baslama_tarihi));
      $ilan->is_bitis_tarihi= date('Y-m-d', strtotime($request->is_bitis_tarihi));
      $ilan->adi= $request->ilan_adi;
      //foreach($request->firma_adi_gizli as $firma_adi_gizli){
      $ilan->goster = $request->firma_adi_gizli;
      //}
      if($request->file('teknik'))
      {
        $file = $request->file('teknik');
        $file = array('teknik' => $request->file('teknik'));
        $destinationPath = 'Teknik';
        $extension = $request->file('teknik')->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        File::delete("Teknik/".$ilan->teknik_sartname);
        $ilan->teknik_sartname = $fileName;
        $request->file('teknik')->move($destinationPath, $fileName);
        Session::flash('success', 'Upload successfully');

      }
      $ilan->statu = 0;

      $firma->ilanlar()->save($ilan);

      if($request->belirli_istekli!=null){
        foreach($request->belirli_istekli as $belirli){
          $belirli_istekliler= new \App\BelirlIstekli();
          $belirli_istekliler->ilan_id = $ilan->id;
          $belirli_istekliler->firma_id=$belirli;
          $belirli_istekliler->save();
        }
      }
      return Redirect::to('ilanEkle/'.$firma->id.'/'.$ilan->id);
    //}
    /*else {
      Session::flash('error', 'uploaded file is not valid');
      return Redirect::to('firmaIlanOlustur/'.$firma->id)->withInput()->withErrors($validator);
    }*/
  }//



public function ilanAdd(Request $request,$id){
  $firma = Firma::find($id);
  $ilan = new Ilan;
  $ilan->adi=Str::title(strtolower( $request->ilan_adi));
  $ilan->ilan_sektor=$request->firma_sektor;
  $ilan->yayin_tarihi=date('Y-m-d', strtotime($request->yayinlanma_tarihi));
  $ilan->kapanma_tarihi= date('Y-m-d', strtotime($request->kapanma_tarihi));
  $ilan->aciklama =Str::title(strtolower( $request->aciklama));
  $ilan->ilan_turu= $request->ilan_turu;
  $ilan->katilimcilar= $request->katilimcilar;
  $ilan->rekabet_sekli= $request->rekabet_sekli;
  $ilan->sozlesme_turu= $request->sozlesme_turu;
  $ilan->odeme_turu_id=$request->odeme_turu;
  $ilan->para_birimi_id=$request->para_birimi;
  $ilan->kismi_fiyat=$request->kismi_fiyat;
  $ilan->yaklasik_maliyet= $request->maliyet;
  $ilan->komisyon_miktari=$request->yaklasik_maliyet;
  $ilan->teslim_yeri_satici_firma= $request->teslim_yeri;
  $ilan->teslim_yeri_il_id= $request->il_id;
  $ilan->teslim_yeri_ilce_id= $request->ilce_id;
  $ilan->isin_suresi= $request->isin_suresi;
  $ilan->is_baslama_tarihi= date('Y-m-d', strtotime($request->is_baslama_tarihi));
  $ilan->is_bitis_tarihi= date('Y-m-d', strtotime($request->is_bitis_tarihi));
  $ilan->adi= $request->ilan_adi;
  //foreach($request->firma_adi_gizli as $firma_adi_gizli){
  $ilan->goster = $request->firma_adi_gizli;
  //}
  if($request->file('teknik'))
  {
    $file = $request->file('teknik');
    $file = array('teknik' => $request->file('teknik'));
    $destinationPath = 'Teknik';
    $extension = $request->file('teknik')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;
    $ilan->teknik_sartname = $fileName;
    $request->file('teknik')->move($destinationPath, $fileName);
    Session::flash('success', 'Upload successfully');

  }
  $ilan->statu = 0;

  $firma->ilanlar()->save($ilan);

  if($request->belirli_istekli!=null){
    foreach($request->belirli_istekli as $belirli){
      $belirli_istekliler= new \App\BelirlIstekli();
      $belirli_istekliler->ilan_id = $ilan->id;
      $belirli_istekliler->firma_id=$belirli;
      $belirli_istekliler->save();
    }
  }
  return Redirect::to('ilanEkle/'.$firma->id.'/'.$ilan->id);
}

public function kalemlerListesiMalUpdate(Request $request,$id){
  DB::beginTransaction();
  try {

    $mallar = \App\IlanMal::find($id);
    //$mallar->sira=$request->sira;
    $mallar->marka=Str::title(strtolower($request->marka));
    $mallar->model=Str::title(strtolower($request->model));
    $mallar->adi=Str::title(strtolower($request->adi));
    $mallar->ambalaj=Str::title(strtolower($request->ambalaj));
    $mallar->miktar=$request->miktar;
    $mallar->birim_id=$request->birim;
    $mallar->save();

    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($request->firma_id,$mallar->ilan_id);
  //return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$mallar->ilan_id);
}
public function kalemlerListesiHizmetUpdate(Request $request,$id){
  DB::beginTransaction();
  try {
    $hizmetler = \App\IlanHizmet::find($id);

    //$hizmetler->sira=$request->sira;
    $hizmetler->adi=Str::title(strtolower($request->adi));
    $hizmetler->fiyat_standardi=$request->fiyat_standardi;
    $hizmetler->fiyat_standardi_birim_id=$request->fiyat_standardi_birimi;
    $hizmetler->miktar=$request->miktar;
    $hizmetler->miktar_birim_id=$request->miktar_birim_id;
    $hizmetler->save();
    DB::commit();
    //all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }

  //return Redirect::back()->with($request->firma_id,$hizmetler->ilan_id);
  // return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$hizmetler->ilan_id);
}
public function kalemlerListesiGoturuUpdate(Request $request,$id){
  DB::beginTransaction();
  try {
    $goturuler = \App\IlanGoturuBedel::find($id);

    //$goturuler->sira=$request->sira;
    $goturuler->isin_adi=Str::title(strtolower($request->isin_adi));
    $goturuler->miktar_turu=$request->miktar_turu;
    $goturuler->save();

    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($request->firma_id,$goturuler->ilan_id);

  //return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$goturuler->ilan_id);
}
public function kalemlerListesiYapimİsiUpdate(Request $request,$id){
  DB::beginTransaction();
  try {


    $yapimlar = \App\IlanYapimIsi::find($id);

    //$yapimlar->sira=$request->sira;
    $yapimlar->adi=Str::title(strtolower($request->adi));
    $yapimlar->miktar=$request->miktar;
    $yapimlar->birim_id=$request->birim;
    $yapimlar->save();
    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($request->firma_id,$yapimlar->ilan_id);
  // return redirect('firmaIlanOlustur/'.$request->firma_id.'/'.$yapimlar->ilan_id);
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
  DB::beginTransaction();
  try {
    $ilan = Ilan::find($request->id);
    $mal= new \App\IlanMal();

    $mal->marka=Str::title(strtolower($request->marka));
    $mal->model=Str::title(strtolower($request->model));
    $mal->adi=Str::title(strtolower($request->adi));
    $mal->ambalaj=Str::title(strtolower($request->ambalaj));
    $mal->miktar=$request->miktar;
    $mal->birim_id=$request->birim;

    $ilan->ilan_mallar()->save($mal);
    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($ilan->firma_id,$mal->ilan_id);

}
public function kalemlerListesiGoturuEkle(Request $request,$id){

  DB::beginTransaction();
  try {

    $ilan = Ilan::find($request->id);
    $goturu= new \App\IlanGoturuBedel();

    $goturu->isin_adi=Str::title(strtolower($request->isin_adi));
    $goturu->miktar_turu=$request->miktar_turu;
    $ilan->ilan_goturu_bedeller()->save($goturu);

    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($ilan->firma_id,$goturu->ilan_id);

}
public function kalemlerListesiHizmetEkle(Request $request,$id){
  DB::beginTransaction();
  try {

    $ilan = Ilan::find($request->id);
    $hizmet=  new \App\IlanHizmet();

    $hizmet->adi=Str::title(strtolower($request->adi));
    $hizmet->fiyat_standardi=$request->fiyat_standardi;
    $hizmet->fiyat_standardi_birim_id=$request->fiyat_standardi_birimi;
    $hizmet->miktar=$request->miktar;
    $hizmet->miktar_birim_id=$request->miktar_birim_id;
    $ilan->ilan_hizmetler()->save($hizmet);

    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($ilan->firma_id,$hizmet->ilan_id);

}
public function kalemlerListesiYapimİsiEkle(Request $request,$id){

  DB::beginTransaction();
  try {
    $ilan = Ilan::find($request->id);
    $yapim=  new \App\IlanYapimIsi();

    $yapim->adi=Str::title(strtolower($request->adi));
    $yapim->miktar=$request->miktar;
    $yapim->birim_id=$request->birim;
    $ilan->ilan_yapim_isleri()->save($yapim);

    DB::commit();
    // all good
  } catch (\Exception $e) {
    $error="error";
    DB::rollback();
    return Response::json($error);
  }
  //return Redirect::back()->with($ilan->firma_id,$yapim->ilan_id);

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
