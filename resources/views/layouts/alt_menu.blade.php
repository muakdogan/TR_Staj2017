<style>
    .deneme{
        width: 160px;
        height: 50px;
        background: yellowgreen;
    }
</style>
<nav class="navbar navbar-inverse">
             <div class="container-fluid">
                 <div class="navbar-header">
                      <?php $firmaAdi = session()->get('firma_adi');
                            ?>
                     <a class="navbar-brand" href="{{ URL::to('firmaIslemleri', array($firma->id), false)}}"><img src='{{asset('images/anasayfa.png')}}'></a>
                 </div>
                 <ul class="nav navbar-nav">
                     
                     <li class=""><a href="{{ URL::to('firmaProfili', array($firma->id), false)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ URL::to('ilanlarim', array($firma->id), false)}}">İlanlarım</a></li>
                             
                             <li><a href="{{ URL::to('ilanEkle', array($firma->id,'0'), false)}}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             
                            
                             <li><a href="{{ URL::to('basvurularim', array($firma->id), false)}}">Başvurularım</a></li>
                          
                             
                             <li><a href="{{url('ilanAra/')}}">Başvur</a></li>
                             
                         </ul>
                     </li>
                     <li class=""><a href="{{ URL::to('davetEdildigim', array($firma->id), false)}}">Davet Edildiğim İlanlar</a></li>
                     <!--li><a href="#">Mesajlar</a></li-->
                     <li><a href="{{ URL::to('kullaniciIslemleri', array($firma->id), false)}}">Kullanıcı İşlemleri</a></li>
                     <li><div class="deneme">
                             <a><p style="padding-top: 15px; padding-left: 25px;font-size: 16px; color:white"  class="firmaDavet" id="firmaDavetButton">Firma Davet Et !</p></a>
                                  <div class="modal fade" id="FirmaDavet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div style="background-color: #fcf8e3;" class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 style="font-size:14px" class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Firma Davet Et</strong></h4>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(array('id'=>'davetFirma','url'=>'firmaDavet','method'=>'POST', 'files'=>true)) !!}
                                                        <div class='row'>
                                                           <div class=" form-group">
                                                                <label class="col-lg-4 control-label">Davet Edeceğiniz Firmanın İsmi:</label>
                                                                <div class='col-lg-8'>
                                                                    <input type="text" class="form-control" id="isim" name="isim" placeholder="Firma İsmi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <input type="hidden" class="form-control" id="firma_id" name="firma_id" value='{{$firma->id}}'>
                                                                </div>
                                                           </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                          <div class="form-group">
                                                                <label class="col-sm-4 control-label">Davet Edeceğiniz Firmanın Mail Adresi:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="mail" class="form-control" id="mailAdres" name="mailAdres" placeholder="Mail Adres" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                           </div>
                                                        </div>    
                                                      {!! Form::submit('Davet Et', array('url'=>'firmaProfili/iletisimAdd/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                      <br>
                                                {{ Form::close() }}
                                            </div>
                                            <div class="modal-footer">                                                            
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                         </div>
                     </li>
                 </ul>
             </div>
</nav>
<script>
$('.firmaDavet').click(function(){
        $('#FirmaDavet').modal('show');
    });
 $("#davetFirma").submit(function(e)
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
                    alert(data);
                    $('#FirmaDavet').modal('hide');
                    
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault(); //STOP default action
        });   
</script>