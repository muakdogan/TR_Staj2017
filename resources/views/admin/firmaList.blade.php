
@extends('layouts.appAdmin')
@section('content')
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <div class="row">
         @include('layouts.admin_alt_menu')
        <div class="panel panel-default">
                    <div class="panel-heading">KULLANICI FİRMA İŞLEMLERİ</div>
                    <div class="panel-body">
                        <div  id="exTab2"  >
                             <ul class="nav nav-tabs">
                                <li class="active"><a  href="#1" data-toggle="tab">Onaylanmayı Bekleyen Firmalar</a>
                                </li>
                                <li><a href="#2" data-toggle="tab">Onaylanmış Firmalar</a>
                                </li>
                             </ul>
                            <div class="tab-content">
                                <div class="tab-pane active onaysız" id="1">
                                  <br>
                                       @include('admin.firmaListTable')
                                </div>
                                <div class="tab-pane onayli" id="2">
                                    <br>
                                      @include('admin.firmaListOnayli')
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
        </div>


   </div>
</div>
<script>
     $(document).on('click', '.pagination a', function (e){

       if($(this).attr('href').indexOf("1pagination=")!= -1){

            firmaListOnaysız($(this).attr('href').split('1pagination=')[1]);
        }
        else{
            firmaListOnaylı($(this).attr('href').split('2pagination=')[1]);
            alert($(this).attr('href').split('2pagination=')[1]);
        }
        e.preventDefault();
     });

     function firmaListOnaysız(){
           $.ajax({
            type:"GET",
            url:"{{asset('firmaListeleme')}}",
            data:{},
            cache: false,
            success: function(data){
                console.log(data);
                $('.onaysiz').html(data);
            },
            error: function (error) {
                  **alert('error; ' + eval(error));**
            }

        });
    }
    function firmaListOnaylı(){

           $.ajax({
            type:"GET",
            url:"{{asset('firmaListeOnaylı')}}",
            data:{},
            cache: false,
            success: function(data){
                console.log(data);
                $('.onayli').html(data);
            }
             error: function (error) {
                  **alert('error; ' + eval(error));**
            }
        });
    }
</script>
@endsection
