<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>jQuery Tutorial - Pop-up div on hover</title>
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/heroic-features.css')}}" rel="stylesheet">
    <style>
        table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}




a {
  color: #EB067B;
}


/* HOVER STYLES */
div#pop-up {
  display: none;
  position: absolute;
  width: 280px;
  padding: 10px;
  background: #eeeeee;
  color: #000000;
  border: 1px solid #1a1a1a;
  font-size: 90%;
}
    </style>
  </head>
  <body>
      <div id="container">
        <h1>jQuery Tutorial - Pop-up div on hover</h1>
        <p>
          To show hidden div, simply hover your mouse over
          <a href="#" id="trigger">this link</a>.
        </p>
        <!-- HIDDEN / POP-UP DIV -->
        <div id="pop-up">
          <h3>Pop-up div Successfully Displayed</h3>
          <p>
            This div only appears when the trigger link is hovered over.
            Otherwise it is hidden from view.
          </p>
        </div>
      </div>
  </body>
    <script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
  <script>
      $(function() {
  var moveLeft = 20;
  var moveDown = 10;

  $('a#trigger').hover(function(e) {
    $('div#pop-up').show();
      //.css('top', e.pageY + moveDown)
      //.css('left', e.pageX + moveLeft)
      //.appendTo('body');
  }, function() {
    $('div#pop-up').hide();
  });

  $('a#trigger').mousemove(function(e) {
    $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
  });

});
  </script>


</html>