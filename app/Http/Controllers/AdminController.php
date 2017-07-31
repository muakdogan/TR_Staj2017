<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Firma;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
    	$firmalar=Firma::all();
    	return view('admin.genproduction.index')->with('firmalar',$firmalar);
      // "admin.genproduction.index is the new template "Gentelella Aletta". The old one is "admin.dashboard"   "
    }

    public function onayBekleyenFirmalar () {

        $onay = DB::table('firmalar')
        ->join('firma_kullanicilar', 'firmalar.id', '=', 'firma_kullanicilar.firma_id')
        ->join('kullanicilar', 'kullanicilar.id', '=', 'firma_kullanicilar.kullanici_id')
        ->select('firmalar.*')
        ->where([['firmalar.onay', 0], ['kullanicilar.onayli', 1]])
        ->distinct()
        ->orderBy('olusturmaTarihi', 'desc')->paginate(2, ['*'], '1pagination');

        $onayli = DB::table('firmalar')
        ->where('onay', 1)->orderBy('olusturmaTarihi', 'desc') ->paginate(2, ['*'], '2pagination');

        return View::make('admin.genproduction.firmaListele')-> with('onay',$onay)-> with('onayli',$onayli);

    }

    public function firmaOnay(Request $request){

        //Onay türünü belirle. 0: standart, 1: ödemesiz, 2: özel, 3: ret
        $onayTuru = Input::get('onay_turu');
        $firma = \App\Firma::find(Input::get('firma_id'));
        $kullanici = $firma->kullanicilar()->first();

        $subject;
        $message;

        switch ($onayTuru)
        {
            case 0://standart
            $firma->onay = 1;
            $firma->save();

            $subject = "Firmanız Onaylandı";
            $message = "Sayın $kullanici->adi $kullanici->soyadi, $firma->adi adlı firma onaylanmıştır.";
            break;

            case 1://ödemesiz
            $firma->uyelik_bitis_tarihi = date_create(NULL)->add(new DateInterval("P"+Input::get('uyelik_bitis_suresi')+"M"));//şu ana uyelik_bitis_suresi field'ını ay olarak ekle
            $firma->onay = 1;
            $firma->save();
            
            $subject = "Firmanız Onaylandı";
            $message = "Sayın $kullanici->adi $kullanici->soyadi, $firma->adi adlı firmanın üyeliği,
            $firma->uyelik_bitis_tarihi tarihine kadar onaylanmıştır.";
            break;

            case 2://özel
            $odeme = new \App\Odeme();
            $odeme->firma_id = $firma->id;
            $odeme->sistem_kullanici_id = session()->get('admin_id');
            $odeme->miktar = Input::get('miktar');
            /*ay türünden*/$odeme->sure = Input::get('sure');
            /*ay türünden*/$odeme->gecerlilik_sure = Input::get('gecerlilik_sure');
            $odeme->kullanici_id = $kullanici->id;
            $odeme->save();

            $firma->uyelik_bitis_tarihi = date_create(NULL)->add(new DateInterval("P"+Input::get('sure')+"M"));//şu ana sure field'ını ay olarak ekle
            $teklifBitisTarihi = date_create(NULL)->add(new DateInterval("P"+Input::get('gecerlilik_sure')+"M"));//şu ana gecerlilik_sure field'ını ay olarak ekle

            $firma->onay = 1;
            $firma->save();

            $subject = "Firmanız Onaylandı";
            $message = "Sayın $kullanici->adi $kullanici->soyadi, $firma->adi adlı firmanın üyeliği,
            $odeme->miktar karşılığında, son ödeme tarihi $teklifBitisTarihi olmak üzere
            $firma->uyelik_bitis_tarihi tarihine kadar onaylanmıştır.";
            break;

            case 3://ret
            $firma->onay = -1;
            $firma->save();

            $subject = "Firmanız Reddedildi";
            $message = "Sayın $kullanici->adi $kullanici->soyadi, $firma->adi adlı firmanın üyeliği reddedilmiştir.";
            break;

            default:

            break;
        }

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($kullanici->email)->subject($subject);
        });

    }
    
    public function firmaOnayla ($id) {

        $firmas = Firma::find($id);
        $firmas->onay=1;
        $firma_kul = App\FirmaKullanici::where('firma_id',$id)->get();
        foreach ($firma_kul as $firmaKul){

        }

        $firmaOnay=  \App\Kullanici::find($firmaKul->kullanici_id);

        $data = ['ad' => $firmaOnay->adi, 'soyad' => $firmaOnay->soyadi];

        Mail::send('auth.emails.yorum_mesaj', $data, function($message) use($data,$firmaOnay)
        {
            $message->to($firmaOnay->email, $data['ad'])
            ->subject('FİRMANIZ ONAYLANDI!');

        });
        $firmas->save();
        return view('admin.genproduction.firmaListele');
    }

    public function yorumList() {
        return view('admin.genproduction.yorumListele');
    }
}