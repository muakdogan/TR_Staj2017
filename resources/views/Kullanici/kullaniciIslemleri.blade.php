@extends('layouts.app')
<br>
<br>
 @section('content')
 
 <style>
     .popup, .popup2, .bMulti {
            background-color: #fff;
            border-radius: 10px 10px 10px 10px;
            box-shadow: 0 0 25px 5px #999;
            color: #111;
            display: none;
            min-width: 450px;
            padding: 25px;
            text-align: center;
            }
            .popup, .bMulti {
                min-height: 150px;
            }
            .button.b-close, .button.bClose {
                border-radius: 7px 7px 7px 7px;
                box-shadow: none;
                font: bold 131% sans-serif;
                padding: 0 6px 2px;
                position: absolute;
                right: -7px;
                top: -7px;
            }
            .button {
                background-color: #2b91af;
                border-radius: 10px;
                box-shadow: 0 2px 3px rgba(0,0,0,0.3);
                color: #fff;
                cursor: pointer;
                display: inline-block;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
            }
     
 </style>
     <div class="container">
         
           @include('layouts.alt_menu') 
           
            <div class="col-sm-12">                
              <h3>Kullanıcılar &nbsp;&nbsp;&nbsp;</h3>
           <hr>
           <div id="mal"   class="panel panel-default">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Kullanici Listesi</a>
                     </h4>
                 </div>
                 <div id="collapse4">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
                                  <tr>
                                     <th>Adı:</th>
                                     <th>Soyadı:</th>
                                     <th>Email:</th>
                                     <th>Role:</th>
                                     <th>Ünvan</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 @foreach($firma->kullanicilar as $kullanici)
                                 <tr>
                                     <td>
                                        {{$kullanici->adi}}
                                     </td>
                                     <td>
                                        {{$kullanici->soyadi}}
                                     </td>
                                     <td>
                                         {{$kullanici->email}}
                                     </td>
                                       <?php
                                        $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici->id)
                                                ->where( 'firma_id', '=', $firma->id)
                                                  ->select('rol_id')->get();
                                        $rol_id=$rol_id->toArray();
                                        
                                        $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                                        ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                                        ->select('roller.adi as rolAdi')->get();
                                         $querys=$querys->toArray();
                                         
                                         $queryUnvan = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici->id)
                                                ->where( 'firma_id', '=', $firma->id)
                                                ->select('unvan')->get();
                                         $queryUnvan= $queryUnvan->toArray();
                                         
                                       ?>
                                     
                                     <td>
                                           {{$querys[0]['rolAdi']}}
                                     </td>
                                     <td>
                                           {{$queryUnvan[0]['unvan']}}
                                     </td>
                                     <td> <button name="open-modal-kullanici"  value="{{$kullanici->id}}" class="btn btn-primary btn-xs open-modal-kullanici" >Düzenle</button></td>
                                     <td>
                                              {{ Form::open(array('url'=>'kullaniciDelete/'.$kullanici->id.'/'.$firma->id,'method' => 'DELETE', 'files'=>true)) }}
                                               <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                              {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                              {{ Form::close() }}
                                    </td>
                                   <input type="hidden" name="kullanici_id"  id="kullanici_id" value="{{$kullanici->id}}"> 
                                </tr>
                                @endforeach
                                     <div class="modal fade" id="myModal-kullaniciDüzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kullanıcı Düzenle</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('id'=>'kullanici_up_kayit','url'=>'kullaniciIslemleriUpdate/'.$firma->id.'/'.$kullanici->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Soyadı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="soyadi" name="soyadi" placeholder="Soyadı giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control " id="email" name="email" placeholder="Email giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                    <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Rol</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="rol" id="rol" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($roller as $rol)
                                                                 <option  value="{{$rol->id}}" >{{$rol->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                      <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Ünvan</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="unvan" name="unvan" placeholder="Ünvan giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                         {!! Form::submit('Kaydet', array('url'=>'kullaniciIslemleriUpdate/'.$firma->id.'/'.$kullanici->id ,'class'=>'btn btn-danger')) !!}
                                                         {!! Form::close() !!}
                                                 </div>
                                                 <div class="modal-footer">                                                            
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </thead>
                                     </table>
                                     <div class="modal fade" id="myModal-kullanici" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kullanıcı Ekle</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('id'=>'kullanici_add_kayit','url'=>'kullaniciIslemleriEkle/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                                            {!! csrf_field() !!}
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Soyadı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="soyadi" name="soyadi" placeholder="Soyadı giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                                         <div class="col-sm-9">
                                                             <input type="email" class="form-control email_control" onfocusout="email_control();" id="email" name="email" placeholder="Email giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Rol</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="rol" id="rol" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($roller as $rol)
                                                                 <option  value="{{$rol->id}}" >{{$rol->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                       <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Ünvan</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="unvan" name="unvan" placeholder="Ünvan giriniz" value="" required>
                                                         </div>
                                                     </div>       
                                                     {!! Form::submit('Kaydet', array('url'=>'kullaniciIslemleriEkle/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                     {!! Form::close() !!}
                                                 </div>
                                                 <br>
                                                 <br>
                                                 <div class="modal-footer">                                                            
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                        <button href="{{ url('/password/reset') }}" id="btn-add-kullanici" name="btn-add-kullanici" class="btn btn-primary btn-xs" >Ekle</button>
                                    
                                     </div>
                                     </div>
                                     </div>
             
         </div>
           <div id="mesaj" class="popup">
            <span class="button b-close"><span>X</span></span>
            <h2 style="color:red"> Üzgünüz.. !!!</h2>
            <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
         </div>
          <div  id="kayit_msg"  class='popup'>
            <span class="button b-close"><span>X</span></span>
            <p style="color:green;font-size:18px">Bilgilendirme</p>
            <p style="font-size:12px">Kayıdınız Alınmıştır Lütfen E-mailinizi Kontrol ediniz. </p>
        </div>
        <div id="email2"  class='popup'>
            <span class="button b-close"><span>X</span></span>
            <p style="color:red;font-size:18px"> Üzgünüz..!!!</p>
            <p style="font-size:12px">Bu email sistemimize kayıtlıdır.Lütfen başka email ile tekrar deneyiniz.</p>
        </div>
            <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
    </div>
 <script>

    $(document).ready(function(){
        $('#btn-add-kullanici').click(function () {
            $('#btn-save-kullanici').val("add");
            $('#myModal-kullanici').modal('show');
        });
        $('#btn-add-sifre').click(function () {
            $('#btn-save-sifre').val("add");
            $('#myModal-sifre').modal('show');
        });

    });


        var url = "kullanici";
        $('.open-modal-kullanici').click(function(){
            var kullanici_id = $(this).val();
            $.get(url + '/'  + kullanici_id, function (data) {
                //success data
            console.log(data);
                $('#kullanici_id').val(data.id);
                $('#adi').val(data.adi);
                $('#soyadi').val(data.soyadi);
                $('#email').val(data.email);
                $('#rol').val(data.rol_id);
                $('#unvan').val(data.unvan);
                $('#myModal-kullaniciDüzenle').modal('show');
                
            }) 
        });

    var email;
    function email_control(){
         email= $('.email_control').val();
         email_Get();
    }
    function email_Get(){
        $.ajax({
            type:"GET",
            url:"{{asset('email_girisControl')}}",
            data:{email_giris:email},

            cache: false,
            success: function(data){
                console.log(data);
                if(data==1){
                    $('#email2').bPopup({
                                speed: 650,
                                transition: 'slideIn',
                                transitionClose: 'slideBack',
                                autoClose: 5000 
                            });

                    $('.email_control').val("");
                }   
            }
        });
    }
    
 var firmaId='{{$firma->id}}';   
 $("#kullanici_up_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
            $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR) 
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('kullaniciIslemleri')}}"}, 5000);
                    }
                    else{
                        $('#kayit_msg').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        
                        setTimeout(function(){ location.href="{{asset('kullaniciIslemleri')}}"}, 5000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault(); //STOP default action
        });
        
  $("#kullanici_add_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
            $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR) 
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('kullaniciIslemleri')}}"}, 5000);
                    }
                    else{
                        $('#kayit_msg').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        
                        setTimeout(function(){ location.href="{{asset('kullaniciIslemleri')}}"}, 5000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault(); //STOP default action
        });
 </script>
@endsection