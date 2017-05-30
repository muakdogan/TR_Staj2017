<script type="text/javascript">
glyph_opts = {
  map: {
    checkbox: "glyphicon glyphicon-unchecked",
    checkboxSelected: "glyphicon glyphicon-check",
    checkboxUnknown: "glyphicon glyphicon-share",
    dragHelper: "glyphicon glyphicon-play",
    dropMarker: "glyphicon glyphicon-arrow-right",
    error: "glyphicon glyphicon-warning-sign",
    expanderClosed: "glyphicon glyphicon-plus",
    expanderLazy: "glyphicon glyphicon-plus",  // glyphicon-plus-sign
    expanderOpen: "glyphicon glyphicon-minus",  // glyphicon-collapse-down
    //folder: "glyphicon glyphicon-plus",
    //folderOpen: "glyphicon glyphicon-minus",
    loading: "glyphicon glyphicon-refresh glyphicon-spin"
  }
};
$(function(){
  // Initialize Fancytree
  $("#tree").fancytree({
    extensions: ["filter", "glyph"],
    quicksearch: true,
    checkbox: true,
    glyph: glyph_opts,
    selectMode: 1,
    source: {
      data:{id:0},
      url: "{{asset('findChildrenTree')}}",
      dataType:'json', debugDelay: 1000
    },
    filter: {
      autoApply: true,   // Re-apply last filter if lazy data is loaded
      autoExpand: true, // Expand all branches that contain matches while filtered
      counter: false,     // Show a badge with number of matching child nodes near parent icons
      fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
      hideExpandedCounter: true,  // Hide counter badge if parent is expanded
      hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
      highlight: true,   // Highlight matches by wrapping inside <mark> tags
      leavesOnly: false, // Match end nodes only
      nodata: true,      // Display a 'no data' status node if result is empty
      mode: "hide"       // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
    },
    toggleEffect: { effect: "drop", options: {direction: "left"}, duration: 200 },

    activate: function(event, data) {
//        alert("activate " + data.node);
    },
    lazyLoad: function(event, data){
		var node = data.node;
		console.log(node.key);
        data.result = {
		  url: "{{asset('findChildrenTree')}}",
      debugDelay: 1000,
		  data: {id: node.key},
                  dataType:'json',
          cache: false
        }
      }
  });
  $(".fancytree-container").toggleClass("fancytree-connectors");
  $("input[name=search]").keyup(function(e){
    var n,
      tree = $.ui.fancytree.getTree(),
      args = "autoApply autoExpand fuzzy hideExpanders highlight leavesOnly nodata".split(" "),
      opts = {},
      filterFunc = $("#branchMode").is(":checked") ? tree.filterBranches : tree.filterNodes,
      match = $(this).val();

    $.each(args, function(i, o) {
      opts[o] = $("#" + o).is(":checked");
    });
    opts.mode = $("#hideMode").is(":checked") ? "hide" : "dimm";

    if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
      $("button#btnResetSearch").click();
      return;
    }
    if($("#regex").is(":checked")) {
      // Pass function to perform match
      n = filterFunc.call(tree, function(node) {
        return new RegExp(match, "i").test(node.title);
      }, opts);
    } else {
      // Pass a string to perform case insensitive matching
      n = filterFunc.call(tree, match, opts);
    }
    $("button#btnResetSearch").attr("disabled", false);
    $("span#matches").text("(" + n + " matches)");
  }).focus();
  $("button#btnResetSearch").click(function(e){
    $("input[name=search]").val("");
    $("span#matches").text("");
    tree.clearFilter();
  }).attr("disabled", true);
  $("fieldset input:checkbox").change(function(e){
      var id = $(this).attr("id"),
        flag = $(this).is(":checked");

      // Some options can only be set with general filter options (not method args):
      switch( id ){
      case "counter":
      case "hideExpandedCounter":
        tree.options.filter[id] = flag;
        break;
      }
      tree.clearFilter();
      $("input[name=search]").keyup();
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
                          <input name="search" placeholder="Filter..." autocomplete="off">
                          <button id="btnResetSearch">&times;</button>
                          <span id="matches"></span>
                          <div class="panel-body">
                              <div id="tree" class="panel-body fancytree-colorize-hover ">
                              </div>
                          </div>
                      </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
