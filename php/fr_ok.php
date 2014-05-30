<meta charset="utf-8" />

<?php
include "connect_db.php";

$delno = $_GET['no'];
$id = $_GET['id'];
$sort = $_GET['sort'];

$sql = mysql_query("select name from user_data where id='$id'");
$name = mysql_fetch_array($sql, MYSQL_NUM);
mysql_query("update g_$user_id set fr_on='1' where fr_id='$id'");
mysql_query("update g_$user_id set sort='$sort' where fr_id='$id'");
mysql_query("update g_$user_id set date='now()' where fr_id='$id'");

mysql_query("update g_$id set fr_on='1' where fr_id='$user_id'");
mysql_query("update g_$id set date='now()' where fr_id='$user_id'");
mysql_query("DELETE FROM alarm WHERE delno = '$delno'");
if ($sort=='50'){
echo "<script language='javascript'>
		alert('{$name[0]}($id)님을 무인도에 추가하였습니다!');
		location.replace('../main.html');
</script>";}else{
echo "<script language='javascript'>
		alert('{$name[0]}($id)님과 친구가 되었어요!');
		location.replace('../main.html');
</script>";}



?>

