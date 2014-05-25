<?
include "../php/connect_db.php";
 
$only_no= $_POST['onlyno'];
$where= $_POST['who'];
$reply= $_POST['reply'];
$anony= $_POST['anony'];
echo $only_no;
echo $where;
echo $reply;
echo $anony;


$sql= mysql_query("SELECT `id` FROM t_$user_id WHERE `only_no` = '$only_no'");
$writer = mysql_fetch_array($sql,MYSQL_NUM);
$sql= mysql_query("SELECT `reply` FROM reply WHERE `only_no` = '$only_no'");
$ori = mysql_fetch_array($sql,MYSQL_NUM);
$no2 = explode("|",$ori[0]);
$no = count($no2);
$s = explode("|",$score[0]);
$kindness = explode(":",$s[3]);

$date= date( 'Y-m-d H:i:s', time() );
$replydone = "$ori[0]". "|" . "$anony"."&*$"."$user_name"."&*$"."$user_id"."&*$"."$reply"."&*$"."$date"; //1은 익명


mysql_query("update `zerohouse3`.`reply` set `reply`='$replydone' where only_no='$only_no'");


if ($anony==0){
echo "<div class='reply'>$user_name($user_id) : $reply <font size='1' color='#a5a5a5'>$date</font> <a onclick='delReply($only_no[0], $no)' class='link'>지우기</a></div>";}
else {
echo "<div class='reply'>익명(anonymous) : $reply <font size='1' color='#a5a5a5'>$date</font> <a onclick='delReply($only_no[0], $no)' class='link'>지우기</a></div>";}


?>