@extends('layouts.appAdmin')

@section('content')
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">

  <link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script src="//cdn.jsdelivr.net/jquery.ui-contextmenu/1/jquery.ui-contextmenu.min.js"></script>
  <link href="{{asset('../resources/views/admin/skin-lion/ui.fancytree.css')}}" rel="stylesheet">
  <script src="{{asset('../resources/views/admin/js/jquery.fancytree.js')}}"></script>
  <script src="{{asset('../resources/views/admin/js/jquery.fancytree.dnd.js')}}"></script>
  <script src="{{asset('../resources/views/admin/js/jquery.fancytree.edit.js')}}"></script>
  <script src="{{asset('../resources/views/admin/js/jquery.fancytree.gridnav.js')}}"></script>
  <script src="{{asset('../resources/views/admin/js/jquery.fancytree.table.js')}}"></script>


<style type="text/css">
  .ui-menu {
    width: 180px;
    font-size: 63%;
  }
  .ui-menu kbd { /* Keyboard shortcuts for ui-contextmenu titles */
    float: right;
  }
  /* custom alignment (set by 'renderColumns'' event) */
  td.alignRight {
     text-align: right;
  }
  td.alignCenter {
     text-align: center;
  }
  td input[type=input] {
    width: 40px;
  }
</style>


</head>

<body class="example">

        <div class="col-md-10 col-md-offset-1">
             @include('layouts.admin_alt_menu')
             @include('admin.kalemAgaci')
            <div class="panel panel-default">
                    <div class="panel-heading">Kalemler Listesi Tabloları</div>
                    <div>
                      <input type="button" id="btnKalemAgaci" class="btn btn-danger" value="Kalem Ağacı">
                    </div>

                    <div class="panel-body">
                        <table id="tree" style="width: 60%">
                            <colgroup>
                            <col width="7%">
                            <col width="7%">
                            <col width="51%">
                            <col width="7%">
                            <col width="7%">
                            </colgroup>
                            <thead>
                              <tr> <th></th> <th></th> <th></th> <th>Id</th> <th>Nace Kodu</th> </tr>
                            </thead>
                            <tbody>
                              <!-- Define a row template for all invariant markup: -->
                              <tr>
                                <td class="alignCenter"><input class="cbx" name="aktif" id="dummy" type="checkbox"></td>
                                <td></td>
                                <td></td>
                                <td><input name="input1" type="input" disabled></td>
                                <td><input name="input2" type="input"></td>
                                <!--td class="alignCenter"><input name="cb1" type="checkbox"></td>
                                <td class="alignCenter"><input name="cb2" type="checkbox"></td>
                                <td>
                                  <select name="sel1" id="">
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                  </select>
                                </td-->
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

</body>
<script>
  $('#btnKalemAgaci').click(function(){
    $('#m_kalemAgaci').modal('show');
  });
</script>
</html>
@endsection
