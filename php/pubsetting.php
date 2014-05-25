<?
include "connect_db.php";

$menupan=$_POST['menu'];
$groupdata=$_POST['group'];
$pubdata=$_POST['pub'];
$pubid=$_POST['pubids'];


$groups=explode("|+|",$groupdata);
$pubs=explode("|+|",$pubdata);

$cnt = count($menupan);
for($i=1;$i<$cnt;$i++){
$on = explode("m",$menupan[$i]);
if ($on[0] == 'g'){
$num=$on[1];
$onmenu = $onmenu . "0".";+;". $num .";+;". $groups[$num]."||";
} else if ($on[0] == 'p'){
$num=$on[1];
$onmenu = $onmenu . "1".";+;". $pubid[$num] .";+;". $pubs[$num]."||";
}
}


mysql_query("update user_data set onmenu='$onmenu' where `id`='$user_id'");
mysql_query("update user_data set pub='$pubdata' where `id`='$user_id'");
mysql_query("update user_data set groupdata='$groupdata' where `id`='$user_id'");

echo $pubdata;
echo $groupdata;
echo $onmenu;
?>