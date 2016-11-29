@extends('layouts.app')
 @section('content')
    <style>
           input[type=text] {
               width: 300px;
               box-sizing: border-box;
               border: 2px solid #ccc;
               border-radius: 4px;
               font-size: 16px;
               background-color: white;
               background-image: url("{{asset('images/search.png')}}");
               background-position: 10px 10px;
               background-repeat: no-repeat;
               padding: 12px 20px 12px 40px;
               -webkit-transition: width 0.4s ease-in-out;
               transition: width 0.4s ease-in-out;
           }

           input[type=text]:focus {
               width: 50%;
           }
           input[type=button] {
               background-color: #63b8ff;
               border: 2px solid #ccc;
               color: white;
               border-radius: 4px;
               padding: 12px 20px 12px 20px;
               text-decoration: none;
               margin: 4px 2px;
               cursor: pointer;
           }
   </style>
     <div class="container">
        
        
         <hr>
        <header class="jumbotron hero-spacer">
            <h3>İlan Bul!</h3>
            <input type="text" name="search" placeholder="Search.."><input type="button"  value="ARA">
        </header>
        <hr>
      
       
    </div>
  
@endsection
