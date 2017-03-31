@extends('layouts.appAdmin')
@section('content')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css"></link>
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>


<div class="container">
     @include('layouts.admin_alt_menu')
    <div style="width:80%;padding:5px 5px 15px 80px;">
        <div class="panel panel-info" >
            <div class="panel-heading"><h1>Activity Log</h1></div>
            <div class="panel-body">
                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style=" font-size: 120%;">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th>Delete</th>
                                <th>Deneme</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestActivities as $key => $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->user_id }}</td>
                                <td>{{ $activity->text}}</td>
                                <td>{{ $activity->created_at }}</td>
                                <td>
                                    {!! Form::model( $activity, [ 'method' => 'DELETE', 'route' => ['kullaniciLog.destroy',$activity->id] ,'class'=>'delete']) !!}
                                    <button class='btn btn-danger' type='submit' id="btnDelete" >Delete
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                                <?php
                                 
                                
                                 activity()->log("hi");
                                 $deneme=\Spatie\Activitylog\Models\Activity::all()->last();
                                 ?>
                                 <td>{{$deneme->description}}</td>
                                <!-- we will also add show, edit, and delete buttons -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
