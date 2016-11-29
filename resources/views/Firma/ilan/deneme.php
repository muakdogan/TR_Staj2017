<nav id="header" class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="top: 95px">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="padding:25px 30px"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="float:right">
                    
                   
                    
                    <li>
                        <a href="#"></a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                     <li>
                         <a href="#"></a>
                    </li>
                 
                      
                      <li>
                          <a href="#"></a>
                     </li>
               
                </ul>
                 <ul class="nav navbar-nav" style="padding-left: 30px" >
                    <li>
                     <p class="multiSel"></p>
                    </li>
                   
                    
                </ul>
            </div>
         
        </div>
    
    </nav>

        $userdata = array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password')
      );

    
    if (Auth::attempt($userdata)) {
        
         return view('Firma.ilan.ilanTeklifVer')->with('firma', $firma)->with('birimler',$birimler);
           

    } else {     
   
     return Redirect::tol('login');

    }
<a  href=ilanTeklifVer/"+data[key].firma_id+"><button style='float:right' type='button' class='btn btn-info'>Teklif Ver</button></a><br><br><hr />

 <button id="btn-add-fiyatlandırmaBilgileri" name="btn-add-fiyatlandırmaBilgileri" class="btn btn-primary btn-xs" >LOGIN</button>
 
    <li><a href="{{url('ilanTeklifVer/'.$kullanicifirma->id)}}">{{$kullanicifirma->adi}}</a></li>
    
     <ul style="list-style-type:square">
             <li ><a href="{{url('firmaIslemleri/'.$kullanicifirma->id)}}">{{$kullanicifirma->adi}}</a></li>
        </ul>
    
    
    
     protected function authenticated($request, $user)
    {
        if($user->role === 'admin') {
            return redirect()->intended('/admin_path_here');
        }

        return redirect()->intended('/path_for_normal_user');
    }
    
    
    
    
     $detaylar = DB::table('teklifler')
                        ->where( 'teklifler.id', '=',  $teklif_id)
                        ->join('mal_teklifler', 'mal_teklifler.teklif_id', '=', 'teklifler.id')
                        ->join('hizmet_teklifler', 'hizmet_teklifler.teklif_id', '=', 'teklifler.id')
                        ->join('yapim_isi_teklifler', 'yapim_isi_teklifler.teklif_id', '=', 'teklifler.id')
                        ->join('firma_kullanicilar', 'firma_kullanicilar.id', '=', 'mal_teklifler.firma_kullanicilar_id')
                        ->join('users', 'users.kullanici_id', '=', 'firma_kullanicilar.kullanici_id')
                        ->join('firma_kullanicilar', 'firma_kullanicilar.id', '=', 'hizmet_teklifler.firma_kullanicilar_id')
                        ->join('users', 'users.kullanici_id', '=', 'firma_kullanicilar.kullanici_id')
                       
                        ->join('firma_kullanicilar', 'firma_kullanicilar.id', '=', 'yapim_isi_teklifler.firma_kullanicilar_id')
                        ->join('users', 'users.kullanici_id', '=', 'firma_kullanicilar.kullanici_id')
                       
                        ->select('mal_teklifler.*','hizmet_teklifler.*','yapim_isi_teklifler.*')   ; 
                        
                        
                        
                        
                        
                          function func(){
        
            alert("mmm");                 
            $.ajax({
            type:"GET",
            url:"../basvuruDetay",
            data:{teklif_id:detay
       
            },
            cache: false,
            success: function(data){
            console.log(data);
            
            
            for(var key=0; key <Object.keys(data).length;key++)
             {
                $("#sira").append(data[key].sira);
                $("#marka").append(data[key].marka);
                $("#model").append(data[key].model);
                $("#adi").append(data[key].adi);
                $("#ambalaj").append(data[key].ambalaj);
                $("#miktar").append(data[key].miktar);
                $("#birim").append(data[key].birimadi);
                $("#ilan_adi").append(data[key].ilanadi);
             }
         }

        });
    }