
@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Name Here - Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">  
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!-- Remove this Robots Meta Tag, to allow indexing of site -->
    
    <link href="{{asset('yeniTemplate/scripts/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('yeniTemplate/scripts/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">

    <link href="{{asset('yeniTemplate/scripts/icons/general/stylesheets/general_foundicons.css')}}" media="screen" rel="stylesheet" type="text/css" />  
    <link href="{{asset('yeniTemplate/scripts/icons/social/stylesheets/social_foundicons.css')}}" media="screen" rel="stylesheet" type="text/css" />
    <link href="{{asset('yeniTemplate/styles/custom.css')}}" rel="stylesheet" type="text/css" />


      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
   
   


    <!-- Owl Carousel Assets -->
    <link href="{{asset('owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('owl-carousel/owl.theme.css')}}" rel="stylesheet">

    <!-- Prettify -->
     
     
        
        
</head>
<body id="pageBody">
 <script src="{{asset('assets/js/bootstrap-transition.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-tab.js')}}"></script>
<script src="{{asset('assets/js/jquery-1.9.1.min.js')}}"></script> 
<script src="{{asset('owl-carousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/google-code-prettify/prettify.js')}}"></script>
<script src="{{asset('assets/js/application.js')}}"></script>
<script>
 $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        autoPlay: 3000,
        items : 7,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
     
      });
      

    });
    </script>

<style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
    width: 100%;
        height: auto;
    }
 
.form-wrapper {
	background-color: #f6f6f6;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#f6f6f6), to(#eae8e8));
	background-image: -webkit-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: -moz-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: -ms-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: -o-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: linear-gradient(top, #f6f6f6, #eae8e8);
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	
	overflow: hidden;
	padding: 8px;
	width: 600px;
}

.form-wrapper #search {
	border: 1px solid #CCC;
	-webkit-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	-moz-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
  color: #999;
	float: left;
	font: 16px Lucida Sans, Trebuchet MS, Tahoma, sans-serif;
	height: 42px;
	padding: 10px;
	width: 100px;
}
.form-wrapper #searchKeyword {
	border: 1px solid #CCC;
	-webkit-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	-moz-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
  color: #999;
	float: left;
	font: 16px Lucida Sans, Trebuchet MS, Tahoma, sans-serif;
	height: 42px;
	padding: 10px;
	width: 380px;
}

.form-wrapper #search:focus {
	border-color: #aaa;
	-webkit-box-shadow: 0 1px 1px #bbb inset;
	-moz-box-shadow: 0 1px 1px #bbb inset;
	box-shadow: 0 1px 1px #bbb inset;
	outline: 0;
}
.form-wrapper #searchKeyword:focus {
	border-color: #aaa;
	-webkit-box-shadow: 0 1px 1px #bbb inset;
	-moz-box-shadow: 0 1px 1px #bbb inset;
	box-shadow: 0 1px 1px #bbb inset;
	outline: 0;
}

.form-wrapper #search:-moz-placeholder,
.form-wrapper #search:-ms-input-placeholder,
.form-wrapper #search::-webkit-input-placeholder {
	color: #999;
	font-weight: normal;
}

.form-wrapper #submit {
	background-color: #0483a0;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#31b2c3), to(#0483a0));
	background-image: -webkit-linear-gradient(top, #31b2c3, #0483a0);
	background-image: -moz-linear-gradient(top, #31b2c3, #0483a0);
	background-image: -ms-linear-gradient(top, #31b2c3, #0483a0);
	background-image: -o-linear-gradient(top, #31b2c3, #0483a0);
	background-image: linear-gradient(top, #31b2c3, #0483a0);
	border: 1px solid #00748f;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
	-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
	color: #fafafa;
	cursor: pointer;
	height: 42px;
	float: right;
	font: 15px Arial, Helvetica;
	padding: 0;
	text-transform: uppercase;
	text-shadow: 0 1px 0 rgba(0, 0 ,0, .3);
	width: 100px;
}

.form-wrapper #submit:hover,
.form-wrapper #submit:focus {
	background-color: #31b2c3;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#0483a0), to(#31b2c3));
	background-image: -webkit-linear-gradient(top, #0483a0, #31b2c3);
	background-image: -moz-linear-gradient(top, #0483a0, #31b2c3);
	background-image: -ms-linear-gradient(top, #0483a0, #31b2c3);
	background-image: -o-linear-gradient(top, #0483a0, #31b2c3);
	background-image: linear-gradient(top, #0483a0, #31b2c3);
}

.form-wrapper #submit:active {
	-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	outline: 0;
}

.form-wrapper #submit::-moz-focus-inner {
	border: 0;
}

.div-main{
    background-color: white;
    width:390px;
    height: 164px;
    margin: 2px 2px 2px 2px;
    text-color: black;
}

.div-main:hover {
    background-color:grey;
}  



 </style>
<div id="decorative1" style="position:relative;height:350px">
    
    <div class="container">
        <div class="divPanel headerArea">
            <div class="row-fluid">
               
            
                <div class="span12">
                     <?php $ilan = DB::table('ilanlar')->count();?>
                    <h1 style="color:#ccc">
                        Sizin için  burada {{$ilan}} ilan var!
                    </h1>
               <form class="form-wrapper">
                    <div>
                      <select id="search" name="ilAdi" class="select2" placeholder="Şehir">
                         <option value="" disabled selected>Şehir</option>
                        <option value="">Adana</option>
                        <option value="">Bursa</option>
                        <option value="">İstanbul</option>
                        <option value="">Trabzon</option>
                        <option value="">Manisa</option>
                       </select>
                    </div>
                    <input type="text" id="searchKeyword" placeholder="Firma Adı,İlan Adı,Sektör">
                      <input type="submit" value="İLAN BUL" id="submit">
               </form>
                        
                   
               <div id="owl-demo" class="owl-carousel" style="top: 100px;">
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/1.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/2.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/3.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/4.png')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/5.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/1.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/2.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/3.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/4.png')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/5.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'" src="{{asset('reklam/1.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img  style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'"src="{{asset('reklam/2.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img  style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'"src="{{asset('reklam/3.jpg')}}" alt="Owl Image"></div>
                <div class="item"><img  style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'"src="{{asset('reklam/4.png')}}" alt="Owl Image"></div>
                <div class="item"><img  style="filter:grayscale();" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale()'"src="{{asset('reklam/5.jpg')}}" alt="Owl Image"></div>
               
              </div>
           
   
                    
             
              
         

                </div>
            </div>

        </div>

    </div>
 
</div>
 <br>
 <br>

<div id="contentOuterSeparator"></div>

<br>
<br>

<div class="container">
  <div class="row">
      <a href="#">
        <div class="menu col-sm-4 div-main">
          <h3>Lojistik</h3>
          <p>74 İlan</p>
          <p>İNCELEMEK İÇİN TIKLA ></p>
        </div>
      </a>
      <a href="#">
        <div class="col-sm-4 div-main">
          <h3>Temizlik</h3>
          <p>112 İlan</p>
          <p>İNCELEMEK İÇİN TIKLA ></p>
        </div>
      </a>
      <a href="#">
        <div class="col-sm-4 div-main">
          <h3>Catering</h3>        
          <p>54 İlan</p>
          <p>İNCELEMEK İÇİN TIKLA ></p>
        </div>
      </a>
  </div>
    <div class="row">
      <a href="#">
        <div class="col-sm-4 div-main">
          <h3>İş Kıyafetleri</h3>
          <p>89 İlan</p>
          <p>İNCELEMEK İÇİN TIKLA ></p>
        </div>
      </a>
      <a href="#">
        <div class="col-sm-4 div-main">
          <h3>Tarım</h3>
          <p>34 İlan</p>
          <p>İNCELEMEK İÇİN TIKLA ></p>
        </div>
      </a>
      <a href="#">
        <div class="col-sm-4 div-main">
          <h3>Hizmet</h3>        
          <p>215 İlan</p>
          <p>İNCELEMEK İÇİN TIKLA ></p>
        </div>
      </a>
  </div>
</div>


<div id="footerOuterSeparator"></div>

<div id="divFooter" class="footerArea">

    <div class="container">

        <div class="divPanel">

            <div class="row-fluid">
                <div class="span3" id="footerArea1">
                
                    <h3>About Company</h3>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>
                    
                    <p> 
                        <a href="#" title="Terms of Use">Terms of Use</a><br />
                        <a href="#" title="Privacy Policy">Privacy Policy</a><br />
                        <a href="#" title="FAQ">FAQ</a><br />
                        <a href="#" title="Sitemap">Sitemap</a>
                    </p>

                </div>
                <div class="span3" id="footerArea2">

                    <h3>Recent Blog Posts</h3> 
                    <p>
                        <a href="#" title="">Lorem Ipsum is simply dummy text</a><br />
                        <span style="text-transform:none;">2 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">Duis mollis, est non commodo luctus</a><br />
                        <span style="text-transform:none;">5 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">Maecenas sed diam eget risus varius</a><br />
                        <span style="text-transform:none;">19 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">VIEW ALL POSTS</a>
                    </p>

                </div>
                <div class="span3" id="footerArea3">

                    <h3>Sample Content</h3> 
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s. 
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.
                    </p>

                </div>
                <div class="span3" id="footerArea4">

                    <h3>Get in Touch</h3>  
                                                               
                    <ul id="contact-info">
                    <li>                                    
                        <i class="general foundicon-phone icon"></i>
                        <span class="field">Phone:</span>
                        <br />
                        (123) 456 7890 / 456 7891                                                                      
                    </li>
                    <li>
                        <i class="general foundicon-mail icon"></i>
                        <span class="field">Email:</span>
                        <br />
                        <a href="mailto:info@yourdomain.com" title="Email">info@yourdomain.com</a>
                    </li>
                    <li>
                        <i class="general foundicon-home icon" style="margin-bottom:50px"></i>
                        <span class="field">Address:</span>
                        <br />
                        123 Street<br />
                        12345 City, State<br />
                        Country
                    </li>
                    </ul>

                </div>
            </div>

            <br /><br />
            <div class="row-fluid">
                <div class="span12">
                    <p class="copyright">
                        Copyright © 2013 Your Company. All Rights Reserved.
                    </p>

                    <p class="social_bookmarks">
                        <a href="#"><i class="social foundicon-facebook"></i> Facebook</a>
			<a href=""><i class="social foundicon-twitter"></i> Twitter</a>
			<a href="#"><i class="social foundicon-pinterest"></i> Pinterest</a>
			<a href="#"><i class="social foundicon-rss"></i> Rss</a>
                    </p>
                </div>
            </div>
            <br />

        </div>

    </div>
    
</div>

 







</body>
</html>
@endsection