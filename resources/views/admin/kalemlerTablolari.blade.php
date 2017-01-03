<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editable Tree - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="<?= asset('css/icon.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('css/demo1.css') ?>">
    <script type="text/javascript" src="<?= asset('js/jqueryss.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('js/jquery.easyui.min.js') ?>"></script>
</head>
<body>
    <h2>Editable Tree</h2>
    <p>Click the node to begin edit, press enter key to stop edit or esc key to cancel edit.</p>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree" data-options="
                url: 'http://localhost:8080/22.11.2016tamrekabet/resources/views/admin/ajax-tree-products.json',
                method: 'get',
                animate: true,
                onClick: function(node){
                    $(this).tree('beginEdit',node.target);
                }
            "></ul>
    </div>
</body>
</html>