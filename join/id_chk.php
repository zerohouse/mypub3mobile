<?php
include "../php/connect_db.php";

if(!isset($_POST['id'])) exit;
$is_ajax=$_POST['is_ajax'];
$user_id = $_POST['id'];

$sql = "select *from user_data where userid = '$user_id'";
$res = mysql_query($sql, $connect);
$list = mysql_num_rows($res);

if($list)
{
echo "no"; 
}
else{
echo "ok";
}
?>