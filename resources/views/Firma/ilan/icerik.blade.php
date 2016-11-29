@extends('layouts.app')
<html>
    <body>
    
        <div class='col-sm-9'>
       
          <h3>İlanlar</h3>
                             <hr>
                             @foreach($query as $query)
                                <p>{{$query->adi}}</p>
                                <p>{{$query->firmalar->adi}}</p>
                                <hr>
                             @endforeach
                         
        </div>
    </body>
</html>
<script type="text/javascript">
 
    $(document).ready(function() {
        var il_id= $_POST['il'];
       
      $.ajax({      
          type:"GET",
          url: "ilanAraFiltre",
          data:{"il":il_id},
          cache: false,
          success: function(){
             alert("başarılı");
          } 
        });  
    });
</script>