@extends('layouts.app')
<br>
<br>
 @section('content')
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
                                       ?>
                                        
                                     <td>
                                         
                                           {{$querys[0]['rolAdi']}}
                                           
                                      
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
                                                     {!! Form::open(array('url'=>'kullaniciIslemleriUpdate/'.$kullanici->id ,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

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
                                                             <input type="text" class="form-control" id="email" name="email" placeholder="Email giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Rol</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="rol" name="rol" placeholder="Rol giriniz" value="" required>
                                                         </div>
                                                     </div>
                                                    
                                                  
                                                     <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                         {!! Form::submit('Kaydet', array('url'=>'kullaniciIslemleriUpdate/'.$kullanici->id,'class'=>'btn btn-danger')) !!}
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
                                                     {!! Form::open(array('url'=>'kullaniciIslemleriEkle/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
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
                                                             <input type="text" class="form-control" id="email" name="email" placeholder="Email giriniz" value="" required>
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
                                                    
                                                     {!! Form::submit('Kaydet', array('url'=>'kullaniciIslemleriEkle/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                                     {!! Form::close() !!}
                                                 </div>
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
             
    </div>
@endsection