<?
include "../php/connect_db.php";
 
$only_no= $_POST['onlyno'];
$where= $_POST['who'];
$reply= $_POST['reply'];
$anony= $_POST['anony'];



$sql= mysql_query("SELECT `id` FROM t_$user_id WHERE `only_no` = '$only_no'");
$writer = mysql_fetch_array($sql,MYSQL_NUM);
$sql= mysql_query("SELECT `reply` FROM reply WHERE `only_no` = '$only_no'");
$ori = mysql_fetch_array($sql,MYSQL_NUM);
$no2 = explode("|",$ori[0]);
$no = count($no2);

$date= date( 'Y-m-d H:i:s', time() );
$replydone = "$ori[0]". "|" . "$anony"."&*$"."$user_name"."&*$"."$user_id"."&*$"."$reply"."&*$"."$date"; //1은 익명


mysql_query("update `zerohouse3`.`reply` set `reply`='$replydone' where only_no='$only_no'");




?>