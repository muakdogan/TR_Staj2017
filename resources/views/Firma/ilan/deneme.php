 var levelChange=$this.next().next().attr("id");
  var id = $this.next().children().next().attr("id");
  
  jQuery.ajax({
      type: "GET",
      url:"findChildrenTree",
      data:{id:id},
      success: function(data){
          console.log("level "+levelChange);
          console.log("id "+id);
          console.log(data);
           var ul = document.getElementById(levelChange);
            
          for(var i=0; i< data.length ; i++){
              
            var li = document.createElement("li");
            var a2 = document.createElement("a");
            a2.setAttribute("href","#");
            a2.setAttribute("class","toggle");
            var i1=document.createElement("i");
            i1.setAttribute("style","display:none;");
            i1.setAttribute("class","fa fa-minus-circle");
            a2.appendChild(i1);
            var i2=document.createElement("i");
            i2.setAttribute("class","fa fa-plus-circle");
            a2.appendChild(i2);
            li.appendChild(a2);
            var a = document.createElement("a");
            a.setAttribute("href","#");
            a.appendChild(document.createTextNode(data[i].adi+"    "));
            var checkbox = document.createElement("input");
            checkbox.setAttribute("type","checkbox");
            checkbox.setAttribute("id",data[i].id);
            a.appendChild(document.createTextNode("    "));
            a.appendChild(checkbox);
            var text = document.createElement("input");
            text.setAttribute("type","text");
            text.setAttribute("id",data[i].id);
            text.setAttribute("value",data[i].nace_kodu);
            
            a.appendChild(text);
            var ul2 = document.createElement("ul");
            li.setAttribute("class","hasSubmenu");
            li.setAttribute("style","border-left: 1px solid gray;");
            li.appendChild(a);
            li.appendChild(ul2);
            ul.appendChild(li);
           }
           
      }
  });

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
