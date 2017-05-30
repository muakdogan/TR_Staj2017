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

<script type="text/javascript">
var CLIPBOARD = null;
/*
  SOURCE = [
    {title: "node 1", folder: true, expanded: true, children: [
      {title: "node 1.1", foo: "a"},
      {title: "node 1.2", foo: "b"}
     ]},
    {title: "node 2", folder: true, expanded: false, children: [
      {title: "node 2.1", foo: "c"},
      {title: "node 2.2", foo: "d"}
     ]}
  ];
*/
$(function(){

  $("#tree").fancytree({
    checkbox: false,
    titlesTabbable: true,     // Add all node titles to TAB chain
    quicksearch: true,        // Jump to nodes when pressing first character
    // source: SOURCE,
    source: {
		data:{id:0},
        url: "{{asset('findChildrenTree')}}",
        dataType:'json'
    },
    extensions: ["edit", "dnd", "table", "gridnav"],
    dnd: {
      preventVoidMoves: true,
      preventRecursiveMoves: true,
      autoExpandMS: 400,
      dragStart: function(node, data) {
        return true;
      },
      dragEnter: function(node, data) {
        // return ["before", "after"];
        return true;
      },
      dragDrop: function(node, data) {
        data.otherNode.moveTo(node, data.hitMode);
      }
    },
    edit: {
      triggerStart: ["f2", "shift+click", "mac+enter"],
      close: function(event, data) {
        if( data.save && data.isNew ){
            alert("bune");
          // Quick-enter: add new nodes until we hit [enter] on an empty title
          $("#tree").trigger("nodeCommand", {cmd: "addSibling"});
        }
      }
    },
    table: {
      indentation: 20,
      nodeColumnIdx: 2,
      checkboxColumnIdx: 0
    },
    gridnav: {
      autofocusInput: false,
      handleCursorKeys: true
    },
    lazyLoad: function(event, data){
		var node = data.node;
		console.log(node.key);
        data.result = {
		  url: "{{asset('findChildrenTree')}}",

		  data: {id: node.key},
                  dataType:'json',
          cache: false
        }
      },
    createNode: function(event, data) {
      var node = data.node,
        $tdList = $(node.tr).find(">td");
      // Span the remaining columns if it's a folder.
      // We can do this in createNode instead of renderColumns, because
      // the `isFolder` status is unlikely to change later
      /*if( node.isFolder() ) {
        $tdList.eq(2)
          .prop("colspan", 6)
          .nextAll().remove();
      }*/
    },
    renderColumns: function(event, data) {
      var node = data.node,
        $tdList = $(node.tr).find(">td");
      // (Index #0 is rendered by fancytree by adding the checkbox)
      // Set column #1 info from node data:
      $tdList.eq(0).find("input").prop('checked', node.data.is_aktif);
      $tdList.eq(0).find("input").attr("id", node.key.toString() );
      $tdList.eq(1).text(node.getIndexHier());
      // (Index #2 is rendered by fancytree)
      // Set column #3 info from node data:
      $tdList.eq(3).find("input").val(node.key);
      $tdList.eq(4).find("input").val(node.data.nace_kodu);
      // Static markup (more efficiently defined as html row template):
      // $tdList.eq(3).html("<input type='input' value='" + "" + "'>");
      // ...
    }
  }).on("nodeCommand", function(event, data){
    // Custom event handler that is triggered by keydown-handler and
    // context menu:
    var refNode, moveMode,
      tree = $(this).fancytree("getTree"),
      node = tree.getActiveNode();
    switch( data.cmd ) {
    case "moveUp":
      refNode = node.getPrevSibling();
      if( refNode ) {
        node.moveTo(refNode, "before");
        node.setActive();
      }
      break;
    case "moveDown":
      refNode = node.getNextSibling();
      if( refNode ) {
        node.moveTo(refNode, "after");
        node.setActive();
      }
      break;
    case "indent":
      refNode = node.getPrevSibling();
      if( refNode ) {
        node.moveTo(refNode, "child");
        refNode.setExpanded();
        node.setActive();
      }
      break;
    case "outdent":
      if( !node.isTopLevel() ) {
        node.moveTo(node.getParent(), "after");
        node.setActive();
      }
      break;
    case "rename":
      node.editStart();
      break;
    case "remove":
      refNode = node.getNextSibling() || node.getPrevSibling() || node.getParent();
      node.remove();
      if( refNode ) {
        refNode.setActive();
      }
      break;
    case "addChild":
      node.editCreateNode("child", "");
      break;
    case "addSibling":
      node.editCreateNode("after", "");
      break;
    case "cut":
      CLIPBOARD = {mode: data.cmd, data: node};
      break;
    case "copy":
      CLIPBOARD = {
        mode: data.cmd,
        data: node.toDict(function(n){
          delete n.key;
        })
      };
      break;
    case "clear":
      CLIPBOARD = null;
      break;
    case "paste":
      if( CLIPBOARD.mode === "cut" ) {
        // refNode = node.getPrevSibling();
        CLIPBOARD.data.moveTo(node, "child");
        CLIPBOARD.data.setActive();
      } else if( CLIPBOARD.mode === "copy" ) {
        node.addChildren(CLIPBOARD.data).setActive();
      }
      break;
    default:
      alert("Unhandled command: " + data.cmd);
      return;
    }
    }).on("focusout", function(e){
        var node = $.ui.fancytree.getNode(e);
        var column;
        var value;
        console.log(e.target);
        if(e.target.type === "checkbox"){
            column = "checkbox";
            value = ($(e.target).prop("checked"))?1:0;
            $ajaxCall(value,node.key,column);
        }
        else if(e.target.type === "text"){
            alert("i am in");
            column = "updateName";
            value = e.target.value;
            $ajaxCall(value,node.key,column);
        }
        else if(e.target.name === "input2"){
            column = "updateNaceKodu";
            value = e.target.value;
            $ajaxCall(value,node.key,column);
        }
  }).on("keydown", function(e){
    var cmd = null;
    // console.log(e.type, $.ui.fancytree.eventToString(e));
    switch( $.ui.fancytree.eventToString(e) ) {
    case "ctrl+shift+n":
    case "meta+shift+n": // mac: cmd+shift+n
      cmd = "addChild";
      break;
    case "ctrl+c":
    case "meta+c": // mac
      cmd = "copy";
      break;
    case "ctrl+v":
    case "meta+v": // mac
      cmd = "paste";
      break;
    case "ctrl+x":
    case "meta+x": // mac
      cmd = "cut";
      break;
    case "ctrl+n":
    case "meta+n": // mac
      cmd = "addSibling";
      break;
    case "del":
    case "meta+backspace": // mac
      cmd = "remove";
      break;
    // case "f2":  // already triggered by ext-edit pluging
    //   cmd = "rename";
    //   break;
    case "ctrl+up":
      cmd = "moveUp";
      break;
    case "ctrl+down":
      cmd = "moveDown";
      break;
    case "ctrl+right":
    case "ctrl+shift+right": // mac
      cmd = "indent";
      break;
    case "ctrl+left":
    case "ctrl+shift+left": // mac
      cmd = "outdent";
    }
    if( cmd ){
      $(this).trigger("nodeCommand", {cmd: cmd});
      // e.preventDefault();
      // e.stopPropagation();
      return false;
    }
  });
  /*
   * Tooltips
   */
  // $("#tree").tooltip({
  //   content: function () {
  //     return $(this).attr("title");
  //   }
  // });
  /*
   * Context menu (https://github.com/mar10/jquery-ui-contextmenu)
   */
  $("#tree").contextmenu({
    delegate: "span.fancytree-node",
    menu: [
      {title: "Edit <kbd>[F2]</kbd>", cmd: "rename", uiIcon: "ui-icon-pencil" },
      {title: "Delete <kbd>[Del]</kbd>", cmd: "remove", uiIcon: "ui-icon-trash" },
      {title: "----"},
      {title: "New sibling <kbd>[Ctrl+N]</kbd>", cmd: "addSibling", uiIcon: "ui-icon-plus" },
      {title: "New child <kbd>[Ctrl+Shift+N]</kbd>", cmd: "addChild", uiIcon: "ui-icon-arrowreturn-1-e" },
      {title: "----"},
      {title: "Cut <kbd>Ctrl+X</kbd>", cmd: "cut", uiIcon: "ui-icon-scissors"},
      {title: "Copy <kbd>Ctrl-C</kbd>", cmd: "copy", uiIcon: "ui-icon-copy"},
      {title: "Paste as child<kbd>Ctrl+V</kbd>", cmd: "paste", uiIcon: "ui-icon-clipboard", disabled: true }
      ],
    beforeOpen: function(event, ui) {
      var node = $.ui.fancytree.getNode(ui.target);
      $("#tree").contextmenu("enableEntry", "paste", !!CLIPBOARD);
      node.setActive();
    },
    select: function(event, ui) {
      var that = this;
      // delay the event, so the menu can close and the click event does
      // not interfere with the edit control
      setTimeout(function(){
        $(that).trigger("nodeCommand", {cmd: ui.cmd});
      }, 100);
    }
  });
});
 $ajaxCall=function(value,id,column){
            jQuery.ajax({
                   type: "POST",
                   url: "{{asset('updateTree')}}",
                   data:{value:value, id:id , type: column},
                    success: function(){
                       alert("başarılı");
                    }
                });
        }
</script>
</head>

<body class="example">

        <div class="col-md-10 col-md-offset-1">
             @include('layouts.admin_alt_menu')
            <div class="panel panel-default">
                    <div class="panel-heading">Kalemler Listesi Tabloları</div>

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
</html>
@endsection
