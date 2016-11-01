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