@extends('layouts.appAdmin')
@section('content')
<!DOCTYPE html>
<html lang="en-US" ng-app="adminRecords">
    <head>
        <title>Laravel 5 AngularJS CRUD Example</title>

        <!-- Load Bootstrap CSS -->
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
    </head>
    <body>
        
            <div class="row">
        <div class="col-md-10 col-md-offset-1">
           
            <nav style="background-color:#f5f5f5;border-color:#f5f5f5"class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a style="padding:0px"class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class=""><a href="{{ url('/firmaList')}}">Firma Onayı</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">İlanlarım</a></li>
                                <li><a href="">İlan Oluştur</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Başvurularım</a></li>
                                <li><a href="#">Başvur</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/tablesControl')}}">Tablo İşlemleri</a></li>
                        <li><a href="#">Kullanici İşlemleri</a></li>
                    </ul>
                </div>
            </nav>
            <div class="panel panel-default">
<h2>Admin Tablosu</h2>
        <div  ng-controller="adminsController">
  
            
            <table class="table">
                <thead>
                    <tr>
                       
                        <th>Name</th>
                        <th>Email</th>
                       
                        
                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Yeni Admin Ekle</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="admin in admins">
                        <td>@{{admin.name }}</td>
                        <td>@{{ admin.email }}</td>
                        
                       
                        <td>
                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', admin.id)">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(admin.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
         
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">@{{form_title}}</h4>
                        </div>
                        <div class="modal-body">
                            <form name="frmEmployees" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="@{{name}}" 
                                        ng-model="admin.name" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.name.$invalid && frmEmployees.name.$touched">Name field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="@{{email}}" 
                                        ng-model="admin.email" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="@{{password}}" 
                                        ng-model="admin.password" ng-required="true">
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.password.$invalid && frmEmployees.password.$touched">Contact number field is required</span>
                                    </div>
                                </div>

                                

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEmployees.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
             
            </div>
        </div>
    </div>

        
        

        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="<?= asset('app/libs/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
        
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/admins.js') ?>"></script>
    </body>
</html>
@endsection