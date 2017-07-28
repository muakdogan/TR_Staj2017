<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tam Rekabet</title>

<!-- Bootstrap -->
<link href="../vendor/genvendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="../vendor/genvendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="../vendor/genvendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="../vendor/genvendors/iCheck/skins/flat/green.css" rel="stylesheet">

<!-- bootstrap-progressbar -->
<link href="../vendor/genvendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<!-- JQVMap -->
<link href="../vendor/genvendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
<!-- bootstrap-daterangepicker -->
<link href="../vendor/genvendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="../genbuild/css/custom.min.css" rel="stylesheet">
</head>


<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="{{url('/admin')}}" class="site_title"><i class="fa fa-paw"></i> <span>Tam Rekabet !</span></a> <!-- Ana sayfadaki proje isminin yazdıgı yer -->
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="profile_pic">
            <img src="../resources/views/admin/genproduction/images/img.jpg" alt="..." class="img-circle profile_img">
          </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2>John Doe</h2>
          </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
               <li><a href="{{ url('/admin') }}"><i class="fa fa-home"></i> Anasayfa </a> <!-- If you delete the span stuff the arrow on the right side is removed -->
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

              <li><a href="{{ url('/firmaList')}}"><i class="fa fa-desktop"></i> Firma Onayı </a>
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
              <li><a href="{{ url('/yorumList')}}"><i class="fa fa-table"></i> Yorum Onayı </a>
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
                  <li><a href="{{ url('/tablesControl')}}">Admin Tablosu</a></li>
                  <li><a href="{{ url('/kalemlerTablolari')}}">Kalemler Tabloları İşlemleri</a></li>
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
