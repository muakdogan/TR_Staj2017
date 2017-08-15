

@extends('layouts.app')
<br>
 <br>
 @section('content')
  
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}




		
		
#container{			
	width:600px;
	margin:0 auto;
	background:#ffffff;
	padding:20px;
}

#header{
	text-align:center;
	margin:20px 0 40px;
}
		
#footer{
	text-align:center;
	margin-top:40px;
}

#register {
	margin-left:100px;	
}
#register label{
	margin-right:5px;
}
#register input {
	padding:5px 7px;
	border:1px solid #d5d9da;
	box-shadow: 0 0 5px #e8e9eb inset;
	width:250px;
	font-size:1em;
	outline:0;
}

#result{
	margin-left:5px;
}

#register .short{
	color:#FF0000;
}

#register .weak{
	color:#E66C2C;
}

#register .good{
	color:#2D98F3;
}

#register .strong{
	color:#006400;
}
 
</style>

     <div class="container">
         
           @include('layouts.alt_menu') 
           
          <div class="col-sm-12">
             <?php                                   
               $kullanici = Auth::user();
                                      
              ?>
                                
              <h3><strong>Hoşgeldiniz {{$kullanici->adi}} {{$kullanici->soyadi}}</strong></h3>
             <hr>
            
             <p><strong>Adınız:&nbsp;&nbsp;</strong>{{$kullanici->adi}}</p>
             <p><strong>Kullanıcı Adınız:&nbsp;&nbsp;</strong>{{Auth::user()->name}}</p>
             <p><strong>Soyadınız:&nbsp;&nbsp;</strong>{{$kullanici->soyadi}}</p>
             <p><strong>Email:&nbsp;&nbsp;</strong>{{$kullanici->email}}</p>
             <p><strong>Telefon:&nbsp;&nbsp;</strong>{{$kullanici->telefon}}</p>
              <p></p>
              
              
              <div class="modal fade" id="myModal-kullanici" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4 class="modal-title" id="myModalLabel">Kullanıcı Bilgilerini Düzenle</h4>
                          </div>
                          <div class="modal-body">
                              {!! Form::open(array('url'=>'kullaniciBilgileriUpdate/'.$firma->id.'/'.$kullanici->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                              {!! csrf_field() !!}
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı giriniz" value="{{$kullanici->adi}}" required>
                                  </div>
                              </div>
                                 <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">Kullanıcı Adı</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="kul_adi" name="kul_adi" placeholder="Kullanıcı Adınızı giriniz" value="{{Auth::user()->kullanici_adi}}" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">Soyadı</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="soyadi" name="soyadi" placeholder="Soyadı giriniz" value="{{$kullanici->soyadi}}" required>
                                  </div>
                              </div>
                             
                              
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                  <div class="col-sm-9">
                                      <input type="email" class="form-control" id="email" name="email" placeholder="Email giriniz" disabled value="{{$kullanici->email}}" required>
                                  </div>
                              </div>
                               <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">Telefon</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon giriniz" value="{{$kullanici->telefon}}" required>
                                  </div>
                              </div>
                             
                              {!! Form::submit('Kaydet', array('url'=>'kullaniciBilgileriUpdate/'.$firma->id.'/'.$kullanici->id,'class'=>'btn btn-danger')) !!}
                              {!! Form::close() !!}
                          </div>
                          <div class="modal-footer">                                                            
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="modal fade" id="myModal-sifre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4 class="modal-title" id="myModalLabel">Kullanıcı Şifresini Düzenle</h4>
                          </div>
                          <div class="modal-body">
                              {!! Form::open(array('url'=>'kullaniciBilgileriSifre/'.$firma->id.'/'.Auth::user()->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                              {!! csrf_field() !!}
                            
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="email" name="email" placeholder="Email giriniz" disabled value="{{Auth::user()->email}}" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                 
                                       <label for="inputEmail3" class="col-sm-3 control-label">Şifre</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control sifre" id="sifre" name="sifre" placeholder="Sifre giriniz" value="" required>
                                                <span id="result"></span>
                                        </div>
                                  
                                     
                              </div>
                              <div class="form-group">
                                     
                                       <label for="inputEmail3" class="col-sm-3 control-label">Şifre Tekrar</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control  " id="sifre_tekrar" name="sifre_tekrar" placeholder="Sifreyi Tekrar giriniz" onfocusout="Validate()" value="" required>
                                        </div>
                                    
                              </div>
     	
		
                              {!! Form::submit('Kaydet', array('url'=>'kullaniciBilgileriSifre/'.$firma->id.'/'.Auth::user()->id,'class'=>'btn btn-danger')) !!}
                              {!! Form::close() !!}
  
                          </div>
                          <div class="modal-footer">                                                            
                          </div>
                      </div>
                  </div>
              </div>
              
              <br>
              <br>
                  <button href="#" id="btn-add-kullanici" name="btn-add-kullanici" class="btn btn-primary btn-xs" >Düzenle</button>
                  <button href="#" id="btn-add-sifre" name="btn-add-sifre" class="btn btn-primary btn-xs" >Sifre Düzenle</button>
               <br>
               <hr>
              
              
                                          
         </div>
             
    </div>

<script >
    
 function Validate() {
     
        var password = document.getElementById("sifre").value;
        var confirmPassword = document.getElementById("sifre_tekrar").value;
        if (password != confirmPassword) {
            
            alert("Şifreler uyuşmuyor.Lütfen Tekrar Kontrol Ediniz");
            return false;
        }
        return true;
    }
$(document).ready(function()
{

	$('#sifre').keyup(function()
	{
		$('#result').html(checkStrength($('#sifre').val()))
	})	
	
	
	function checkStrength(password)
	{
		var strength = 0
		if (password.length < 6) { 
			$('#result').removeClass()
			$('#result').addClass('short')
			return 'Şifreniz Kısa Kabul Edilemez!' 
		}
		
		if (password.length > 8) strength += 1
		
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		if (strength < 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('weak')
			return 'Zayıf'			
		}
		else if (strength == 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('good')
			return 'İyi'		
		}
		else
		{
			$('#result').removeClass()
			$('#result').addClass('strong')
			return 'Güçlü'
		}
	}
    
});
    
</script>
@endsection

