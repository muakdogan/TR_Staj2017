<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic Tree - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/demo1.css')}}">
    <script type="text/javascript" src="{{asset('js/jqueryss.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.easyui.min.js')}}"></script>
</head>
<body>
    <h2>Editable Tree</h2>
    <p>Click the node to begin edit, press enter key to stop edit or esc key to cancel edit.</p>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" style="padding:5px">
        
        <input type="checkbox" checked onchange="$('#tt').tree({cascadeCheck:$(this).is(':checked')})">CascadeCheck 
        <input type="checkbox" onchange="$('#tt').tree({onlyLeafCheck:$(this).is(':checked')})">OnlyLeafCheck

        <ul id="tt" class="easyui-tree" data-options="
                url: 'findChildrenTree',
                method: 'get',
                loadFilter:myLoadFilter,
                animate: true,
                checkbox:true,
                onClick: function(node){
                    $(this).tree('beginEdit',node.target); }">
                
        </ul>
            
            
        <script>
        function myLoadFilter(data, parent){
            var state = $.data(this, 'tree');
            
            function setData(){
                var serno = 1;
                var todo = [];
                for(var i=0; i<data.length; i++){
                    todo.push(data[i]);
                }
                while(todo.length){
                    var node = todo.shift();
                    if (node.id == undefined){
                        node.id = '_node_' + (serno++);
                    }
                    if (node.children){
                        node.state = 'closed';
                        node.children1 = node.children;
                        node.children = undefined;
                        todo = todo.concat(node.children1);
                    }
                }
                state.tdata = data;
            }
            function find(id){
                var data = state.tdata;
                var cc = [data];
                while(cc.length){
                    var c = cc.shift();
                    for(var i=0; i<c.length; i++){
                        var node = c[i];
                        if (node.id == id){
                            return node;
                        } else if (node.children1){
                            cc.push(node.children1);
                        }
                    }
                }
                return null;
            }
            
            setData();
            
            var t = $(this);
            var opts = t.tree('options');
            opts.onBeforeExpand = function(node){
                var n = find(node.id);
                if (n.children && n.children.length){return}
                if (n.children1){
                    var filter = opts.loadFilter;
                    opts.loadFilter = function(data){return data;};
                    t.tree('append',{
                        parent:node.target,
                        data:n.children1
                    });
                    opts.loadFilter = filter;
                    n.children = n.children1;
                }
            };
            return data;
        }
    </script>
            
    <script type="text/javascript">
        function getChecked(){
            var nodes = $('#tt').tree('getChecked');
            var s = '';
            for(var i=0; i<nodes.length; i++){
                if (s != '') s += ',';
                s += nodes[i].text;
            }
            alert(s);
        }
    </script>
            
    </div>
 
</body>
</html>