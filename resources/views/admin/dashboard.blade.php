@extends('layouts.appAdmin')
@section('content')
<div class="container">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
     
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Auth::guard('admin')->user())
             @include('layouts.admin_alt_menu') 
            
              <?php
                    $onayFirma = DB::table('firmalar')
                    ->where('onay', '')->count();
                    
                     $onayYorum = DB::table('yorumlar')
                     ->where('onay', ' ')->count();
             ?>
            <div class="panel panel-default">

                <div class="panel-heading">Hoşgeldiniz &nbsp;&nbsp; {{ Auth::guard('admin')->user()->name }}</div>
                @else
                <div class="panel panel-default">

                    <div class="panel-heading">Giriş Yapınız</div>
                    @endif
                    <div class="panel-body">
                        
                     <div class="row">
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$onayFirma}}</div>
                                        <div>Yeni Firmalar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('/admin/firmaList')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">Firmaları Onaylayın</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$onayYorum}}</div>
                                        <div>Yeni Yorumlar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('/admin/yorumList')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">Yorumları Onaylayın</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-spinner fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div>
                                        <div>Support Tickets!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection