<?
include "connect_db.php";
$id = $_POST['id'];

$sql = mysql_query("SELECT name FROM user_data  WHERE `id` = '$id'");
$name = mysql_fetch_array($sql,MYSQL_NUM);
echo $name[0];
?>
