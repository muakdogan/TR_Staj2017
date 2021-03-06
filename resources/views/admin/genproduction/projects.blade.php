<!DOCTYPE html>
<html lang="en" ng-app="adminRecords">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tam Rekabet</title>

    <!-- Bootstrap -->
    <link href="genvendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="genvendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="genvendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="genvendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="genvendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="genvendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="genvendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../genbuild/css/custom.min.css" rel="stylesheet">
    </head>


    <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/admin/dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>Tam Rekabet !</span></a> <!-- Ana sayfadaki proje isminin yazdıgı yer -->
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_pic">
                <img src="../../resources/views/admin/genproduction/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Hoş Geldin,</span>
                @if(Auth::guard('admin')->user())
                <h2>{{ Auth::guard('admin')->user()->name }}</h2>
                @else
                <h2>John Mu Doe</h2>
                @endif
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                   <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-home"></i> Anasayfa </a> <!-- If you delete the span stuff the arrow on the right side is removed -->
                     <!-- <ul class="nav child_menu">

                      <li><a href="index.blade.php">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>

                     </ul> -->
                  </li>

                  <!-- <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li> -->

                  <li><a href="{{ url('/admin/firmaList')}}"><i class="fa fa-desktop"></i> Firma Onayı </a>
                    <ul class="nav child_menu">
                      <!--<li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li> -->
                    </ul>
                  </li>
                  <li><a href="{{ url('/admin/yorumList')}}"><i class="fa fa-table"></i> Yorum Onayı </a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li> -->
                    </ul>
                  </li>
                  <li><a href="{{ url('/kullaniciLog')}}"><i class="fa fa-bar-chart-o"></i> Kullanıcı Hareketleri </a>
                    <!-- <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul> -->
                  </li>
                  <li><a><i class="fa fa-clone"></i>Tablo İşlemleri <span class="fa fa-chevron-down"></a>
                     <ul class="nav child_menu">
                      <li><a href="{{ url('/admin/tablesControl')}}">Admin Tablosu</a></li>
                      <li><a href="{{ url('/admin/kalemlerTablolari')}}">Kalemler Tabloları İşlemleri</a></li>
                    </ul>
                  </li>
                </ul>
              </div>



              <!-- <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div> -->

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Auth::guard('admin')->user())
                    {{ Auth::guard('admin')->user()->name }}
                    @else
                    Kullanıcı Tanınamadı !!!
                    @endif
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{{ url('/admin/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <!-- <li>
                      <a>
                        <span class="image"><img src=../../resources/views/admin/genproduction/images/img.jpg alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src=../../resources/views/admin/genproduction/images/img.jpg alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src=../../resources/views/admin/genproduction/images/img.jpg alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src=../../resources/views/admin/genproduction/images/img.jpg alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li> -->
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->



        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Projects <small>Listing design</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Projects</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-controller="adminsController">

                    <p>Simple table with project listing with progress and editing options</p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Name</th>
                          <th>Email</th>
                          <th>Team Members</th>
                          <th>Project Progress</th>
                          <th>Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>


                      <button id="btn-add" class="btn btn-primary btn-xs" style="float: right;" ng-click="toggle('add', 0)">Yeni Admin Ekle</button>
                      <tbody>


                          <!-- @if(Auth::guard('admin')->user())
                          <tr ng-repeat="admin in admins">
                              <td>@{{admin.name }}</td>
                              <td>@{{admin.email }}</td>
                              <td>
                                  <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', admin.id)">Düzenle</button>
                                  <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(admin.id)">Sil</button>
                              </td>
                          </tr>
                          @else

                              <li><a href="{{ url('/admi') }}">Giriş Admin</a></li>

                          @endif -->

                          <tr ng-repeat="admin in admins">
                          <td>#</td>
                          <td>
                            <a>@{{admin.name}}</a>
                            <br />
                            <small>Created 01.01.2015</small>
                          </td>
                          <td>@{{admin.email}}</td>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="../../resources/views/admin/genproduction/images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="../../resources/views/admin/genproduction/images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="../../resources/views/admin/genproduction/images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="../../resources/views/admin/genproduction/images/user.png" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                            </div>
                            <small>57% Complete</small>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">Success</button>
                          </td>
                          <td>
                            <button class="btn btn-info btn-xs" ng-click="toggle('edit', admin.id)"><i class="fa fa-pencil"></i> Düzenle </button>
                            <button class="btn btn-danger btn-xs"ng-click="confirmDelete(admin.id)"><i class="fa fa-trash-o"></i> Sil </button>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                    <!-- end project list -->


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
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>





    <!-- jQuery -->
    <script src="genvendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="genvendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="genvendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="genvendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="genvendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../genbuild/js/custom.min.js"></script>

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="<?= asset('app/libs/angular/angular.min.js') ?>"></script>
    <!--script src="<?= asset('js/bootstrap.min.js') ?>"></script-->
    <script src="<?= asset('app/app.js') ?>"></script>
    <script src="<?= asset('app/controllers/admins.js') ?>"></script>

  </body>
</html>
