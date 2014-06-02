<?
include "../php/connect_db.php";

$only_no= $_POST['onlyno'];
$no= $_POST['no'];
 
$sql= mysql_query("SELECT `reply` FROM reply WHERE `only_no` = '$only_no'");
$sql = mysql_fetch_array($sql,MYSQL_NUM);
$reply = explode("|",$sql[0]);

$cnt = count($reply);

for($j=1;$j<$cnt;$j++){

if ($j!=$no){
$replydone =  $replydone."|".$reply[$j];}

}

mysql_query("update `zerohouse3`.`reply` set `reply`='$replydone' where only_no='$only_no'");


?>