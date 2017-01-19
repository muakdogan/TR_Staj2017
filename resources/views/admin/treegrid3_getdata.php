<?php
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$kalemler = DB::statement('SELECT adi as "title",id as "key", 
(SELECT (CASE WHEN COUNT(*) > 0 THEN "true" ELSE "false" END) from kalemler as k2 where k1.id= k2.parent_id)  as folder,
(SELECT (CASE WHEN COUNT(*) > 0 THEN "true" ELSE "false" END) from kalemler as k2 where k1.id= k2.parent_id)  as lazy
FROM `kalemler` as k1
where k1.parent_id = ' + $id) ;

echo json_encode($kalemler);

?>