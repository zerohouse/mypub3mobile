<?
include "connect_db.php";
$plus = $_POST['type'];
$only_no = $_POST['onlyno'];

$sql = mysql_query("SELECT * FROM score WHERE `only_no` = '$only_no'");
$score = mysql_fetch_array($sql,MYSQL_NUM);

$sql=explode("||",$score[6]);
$id = explode(';',$sql[0]);
$extype = explode(';',$sql[1]);
$cnt = count($id);
for($i=0;$i<$cnt-1;$i++){
if ($id[$i] == $user_id){
$been = $i;
}
else{
$newtype = $extype[$i] . ";" . $newtype;
$newid = $id[$i] . ";" . $newid;
}
}
$minu = $extype[$been];
$newid = $newid. $user_id. ';';
$newtype = $newtype.$plus. ';';
$newdone = $newid . "||" . $newtype;

if (!isset($been)){
$score[$plus]=$score[$plus]+3;}
else{
$score[$plus] = $score[$plus]+3;
$score[$minu] = $score[$minu]-3;
}

/*$sql = mysql_query("SELECT id FROM t_$user_id  WHERE `only_no` = '$only_no'");
$id = mysql_fetch_array($sql,MYSQL_NUM);
if($user_id==$id[0]){echo "자신의 점수는 올릴 수 없습니다"; exit;}*/
mysql_query("update `zerohouse3`.`score` set `hum`='$score[0]' where `only_no` = '$only_no'") ;
mysql_query("update `zerohouse3`.`score` set `sym`='$score[1]' where `only_no` = '$only_no'") ;
mysql_query("update `zerohouse3`.`score` set `wow`='$score[2]' where `only_no` = '$only_no'") ;
mysql_query("update `zerohouse3`.`score` set `info`='$score[3]' where `only_no` = '$only_no'") ;
mysql_query("update `zerohouse3`.`score` set `etc`='$score[4]' where `only_no` = '$only_no'") ;
mysql_query("update `zerohouse3`.`score` set `who`='$newdone' where `only_no` = '$only_no'") ;

$scoredone = $score[0] + $score[1] + $score[2] + $score[3] + $score[4];
echo $scoredone;
?>
