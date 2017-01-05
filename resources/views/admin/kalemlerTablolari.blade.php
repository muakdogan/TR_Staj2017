<!DOCTYPE html>
<html>
<head>
<title>jQuery Multi Nested Lists Plugin Demo</title>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
</head>
<body>

<h1 style="margin-top:0px;"></h1>

<div class="container">

    <?php $kalemler = App\Kalem::where("parent_id",'=',0)->get();?>
    <ul>
        @foreach($kalemler as $kalem)
        <li><a href="#">{{$kalem->adi}}&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"  id="{{$kalem->id}}"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="{{$kalem->id}}" value="{{$kalem->nace_kodu}}"/></a>
            <?php $child = $kalem->where("parent_id",'=',"id")->get(); 
                if($child->count() > 0){
            ?>
            <ul id="{{$kalem->adi}}"> 
            </ul>
                <?php }
                ?>
        </li>
        @endforeach
    </ul>
</div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/MultiNestedList.js')}}"></script>