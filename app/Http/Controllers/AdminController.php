<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Firma;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateInterval;
use Barryvdh\Debugbar\Facade as Debugbar;

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

    public function firmaList (Request $request) {

        /*$onay = DB::table('firmalar')
        ->join('firma_kullanicilar', 'firmalar.id', '=', 'firma_kullanicilar.firma_id')
        ->join('kullanicilar', 'kullanicilar.id', '=', 'firma_kullanicilar.kullanici_id')
        ->select('firmalar.*')
        ->where([['firmalar.onay', 0], ['kullanicilar.onayli', 1]])
        ->distinct()
        ->orderBy('olusturmaTarihi', 'desc')->paginate(5, ['*'], '1pagination');*/

        $onayBekleyenFirmalar = \App\Firma::where('onay', '0')
        ->whereHas('kullanicilar', function($query){ $query->where('onayli', '1');})->with(
            ['kullanicilar',//whereHas olmasına rağmen with'e kullanicilar yazılmazsa eager loading olmuyor
            'sektorler',
            'iletisim_bilgileri',
            'adresler.iller',
            'adresler.ilceler',
            'adresler.semtler',
            'adresler.adres_turleri'])->get();

        $onayli = DB::table('firmalar')
        ->where('onay', 1)->orderBy('olusturmaTarihi', 'desc') ->paginate(5, ['*'], '2pagination');

        //$tab değişkeni son view'da jQuery ile tab index'i olarak kullanılacağı için 0'dan başlıyor

        if ($request->get('2pagination'))
        {
            $tabStates['tab1'] = "";
            $tabStates['tab1_content'] = "";
            $tabStates['tab2'] = "active";
            $tabStates['tab2_content'] = "active in";
        }
        
        else
        {
            $tabStates['tab1'] = "active";
            $tabStates['tab1_content'] = "active in";
            $tabStates['tab2'] = "";
            $tabStates['tab2_content'] = "";
        }


        return View::make('admin.genproduction.firmaListele')
        ->with(['onayBekleyen' => $onayBekleyenFirmalar,
        'onayli' => $onayli,
        'tabStates' => $tabStates]);

    }

    public function firmaOnay(Request $request){

        DB::beginTransaction();

        try {
            //Onay türünü belirle. 0: standart, 1: ödemesiz, 2: özel, 3: ret
            $onayTuru = $request->input('onay_turu');
            $firma_id = $request->input('firma_id');
            $firma = \App\Firma::find($firma_id);
            $kullanici = $firma->kullanicilar()->first();

            $subject;
            $message;

            switch ($onayTuru)
            {
                case 0://standart
                $firma->onay = 1;
                $firma->uyelik_baslangic_tarihi = NULL;
                $firma->uyelik_bitis_tarihi = NULL;
                $firma->save();
                
                //standart onayda, firma onaylandıktan sonra üyeliği başlatma ödemesini ne zaman yaparsa
                //o zaman geçerli olan miktar ve üyelik süresi ile üye olacak.
                //o yüzden burada miktar ve sure'ye atama yapılmıyor.
                $odeme = new \App\Odeme();
                $odeme->firma_id = $firma->id;
                $odeme->sistem_kullanici_id = Auth::guard('admin')->user()->id;
                $odeme->kullanici_id = $kullanici->id;
                $odeme->save();

                $subject = "Firmanız Onaylandı";
                $message = "Sayın $kullanici->adi $kullanici->soyadi, $firma->adi adlı firma onaylanmıştır.";
                break;

                case 1://ödemesiz
                $firma->uyelik_baslangic_tarihi = date_create(NULL);
                $firma->uyelik_bitis_tarihi = date_create(NULL)->add(new DateInterval("P".$request->input('uyelik_bitis_suresi')."M"))->format('Y-m-d');//şu ana uyelik_bitis_suresi field'ını ay olarak ekle
                $firma->onay = 1;
                $firma->save();

                $odeme = new \App\Odeme();
                $odeme->firma_id = $firma->id;
                $odeme->sistem_kullanici_id = Auth::guard('admin')->user()->id;
                $odeme->miktar = 0;
                $odeme->odeme_durumu = 1;
                $odeme->odeme_tarihi = date_create(NULL);
                /*ay türünden*/$odeme->sure = $request->input('uyelik_bitis_suresi');
                $odeme->kullanici_id = $kullanici->id;
                $odeme->save();

                $subject = "Firmanız Onaylandı";
                $message = "Sayın $kullanici->adi $kullanici->soyadi, $firma->adi adlı firmanın üyeliği,
                $firma->uyelik_bitis_tarihi tarihine kadar onaylanmıştır.";
                break;

                case 2://özel
                $odeme = new \App\Odeme();
                $odeme->firma_id = $firma->id;
                $odeme->sistem_kullanici_id = Auth::guard('admin')->user()->id;
                $odeme->miktar = $request->input('miktar');
                /*ay türünden*/$odeme->sure = $request->input('sure');
                /*ay türünden*/$odeme->gecerlilik_sure = $request->input('gecerlilik_sure');
                $odeme->kullanici_id = $kullanici->id;
                $odeme->save();

                //üyelik, firma teklif edilen ödemeyi yaptığında başlayacak
                $firma->uyelik_baslangic_tarihi = NULL;
                $firma->uyelik_bitis_tarihi = NULL;
                //$firma->uyelik_bitis_tarihi = date_create(NULL)->add(new DateInterval("P".$request->input('sure')."M"))->format('Y-m-d');//şu ana sure field'ını ay olarak ekle

                $teklifBitisTarihi = date_create(NULL)->add(new DateInterval("P".$request->input('gecerlilik_sure')."M"))->format('Y-m-d');//şu ana gecerlilik_sure field'ını ay olarak ekle

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

            DB::commit();
            
            /*$this->mailer->raw($message, function (Message $m) use ($user) {
                $m->to($kullanici->email)->subject($subject);
            });*/

            return redirect('admin/firmaList');

        }
        catch (\Exception $e)
        {
            DB::rollback();
            return response()->json($e);
        }

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

    public function yorumOnay($id,$yorum_kul_id) {

        $yorumlar = App\Yorum::find($id);
        $yorumlar->onay=1;

        $yorum_kul = App\Kullanici::find($yorum_kul_id);

        $data = ['ad' => $yorum_kul->adi, 'soyad' => $yorum_kul->soyadi];

        Mail::send('auth.emails.yorum_mesaj', $data, function($message) use($data,$yorum_kul)
        {
            $message->to($yorum_kul->email, $data['ad'])
            ->subject('YORUMUNUZ YAYINLANDI!');

        });
        $yorumlar->save();
        return view('admin.yorumList');
    }
}
