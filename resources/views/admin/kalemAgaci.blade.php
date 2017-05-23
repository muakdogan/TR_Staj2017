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
  glyph_opts = {
    map: {
      doc: "glyphicon glyphicon-file",
      docOpen: "glyphicon glyphicon-file",
      checkbox: "glyphicon glyphicon-unchecked",
      checkboxSelected: "glyphicon glyphicon-check",
      checkboxUnknown: "glyphicon glyphicon-share",
      dragHelper: "glyphicon glyphicon-play",
      dropMarker: "glyphicon glyphicon-arrow-right",
      error: "glyphicon glyphicon-warning-sign",
      expanderClosed: "glyphicon glyphicon-menu-right",
      expanderLazy: "glyphicon glyphicon-menu-right",  // glyphicon-plus-sign
      expanderOpen: "glyphicon glyphicon-menu-down",  // glyphicon-collapse-down
      folder: "glyphicon glyphicon-folder-close",
      folderOpen: "glyphicon glyphicon-folder-open",
      loading: "glyphicon glyphicon-refresh glyphicon-spin"
    }
  };
  $("#tree").fancytree({
    activeVisible: true, // Make sure, active nodes are visible (expanded)
    aria: false, // Enable WAI-ARIA support
    autoActivate: true, // Automatically activate a node when it is focused using keyboard
    autoCollapse: false, // Automatically collapse all siblings, when a node is expanded
    autoScroll: true, // Automatically scroll nodes into visible area
    clickFolderMode: 4, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
    checkbox: true, // Show checkboxes
    debugLevel: 2, // 0:quiet, 1:normal, 2:debug
    disabled: false, // Disable control
    focusOnSelect: false, // Set focus when node is checked by a mouse click
    escapeTitles: false, // Escape `node.title` content for display
    generateIds: true, // Generate id attributes like <span id='fancytree-id-KEY'>
    idPrefix: "ft_", // Used to generate node id´s like <span id='fancytree-id-<key>'>
    icon: false, // Display node icons
    keyboard: false, // Support keyboard navigation
    keyPathSeparator: "/", // Used by node.getKeyPath() and tree.loadKeyPath()
    minExpandLevel: 1, // 1: root node is not collapsible
    quicksearch: false, // Navigate to next node by typing the first letters
    rtl: false, // Enable RTL (right-to-left) mode
    selectMode: 2, // 1:single, 2:multi, 3:multi-hier
    tabindex: "0", // Whole tree behaves as one single control
    titlesTabbable: false, // Node titles can receive keyboard focus
    tooltip: false, // Use title as tooltip (also a callback could be specified)
    //checkbox: false,
    //titlesTabbable: true,     // Add all node titles to TAB chain
    //quicksearch: true,        // Jump to nodes when pressing first character
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
      indentation: 5,
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



});

</script>



<div class="modal fade" id="m_kalemAgaci" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Kalem Ağacı</h4>
            </div>
            <div class="modal-body">
              <div class="col-md-10 col-md-offset-1">
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
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
