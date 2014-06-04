<?php
include "connect_db.php";

$delno = $_POST['no'];
$id = $_POST['id'];
$sort = $_POST['sort'];

$sql = mysql_query("select name from user_data where id='$id'");
$name = mysql_fetch_array($sql, MYSQL_NUM);

/*$sql = mysql_query("select fr_on from g_$user_id where id='$id'");
$move = mysql_fetch_array($sql, MYSQL_NUM);*/

mysql_query("update g_$user_id set fr_on='1' where fr_id='$id'");
mysql_query("update g_$user_id set sort='$sort' where fr_id='$id'");
mysql_query("update g_$user_id set date='now()' where fr_id='$id'");

mysql_query("update g_$id set fr_on='1' where fr_id='$user_id'");
mysql_query("update g_$id set date='now()' where fr_id='$user_id'");
mysql_query("DELETE FROM alarm WHERE delno = '$delno'");
	$sortq=$sort+1;
/*if ($move[0]==1){
	if ($sort=='50'){
	echo "{$name[0]}($id)님을 무인도로 옮겼습니다!";
	}else{
	echo "{$name[0]}($id)님을 그룹 groupnumbernow[{$sortq}]으로 옮겼습니다!";}



}
else{*/
	if ($sort=='50'){
	echo "{$name[0]}($id)님이";
	}else{
	echo "{$name[0]}($id)님이";}
//}



?>

