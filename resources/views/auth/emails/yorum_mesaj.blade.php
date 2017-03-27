<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
        <title>TamRekabet</title>
        <style>
        div.container {
            width: 100%;
            border: 1px solid gray;
        }

        header, footer {
            padding: 1em;
            color: white;
            background-color: #63b8ff;
            clear: left;
            text-align: center;
        }

        nav {
            float: left;
            max-width: 160px;
            margin: 0;
            padding: 1em;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul a {
            text-decoration: none;
        }

        article {
            margin-left: 170px;
            border-left: 1px solid gray;
            padding: 1em;
            overflow: hidden;
        }
        </style>
</head>
<body>

<div class="container">

<header>
   <h1>TamRekabet</h1>
</header>
  
<article>
  <h1>  Sevgili {{ $ad }} {{ $soyad }},</h1>
  <p>Yaptığınız Yorum Tamrekabet Admin Tarafından Onaylanmıştır.</p>
  <p>Sevgiler..</p>
</article>

<footer>Copyright © 2016
<li>
    <a href="#"><img src="{{asset('images/f.png')}}"></a>
    <a href="#"><img src="{{asset('images/t.png')}}"></a>
    <a href="#"><img src="{{asset('images/y.png')}}"></a>
    <a href="#"><img src="{{asset('images/m.png')}}"></a>
</li>
</footer>

</div>

</body>
</html>