<?
include "connect_db.php";
$plus = $_POST['type'];
$only_no = $_POST['onlyno'];


$sql = mysql_query("SELECT * FROM score WHERE `only_no` = '$only_no'");
$alldata = mysql_fetch_array($sql,MYSQL_NUM);
$score=$alldata[4];

$sql=explode("||",$alldata[2]);
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

$score = explode("|",$score);
if (!isset($been)){
$score[$plus]=$score[$plus]+3;}
else{
$score[$plus] = $score[$plus]+3;
$score[$minu] = $score[$minu]-3;
}
$scoredone = $score[0] . "|" .$score[1] . "|" .$score[2] . "|" .$score[3] . "|" .$score[4];

/*$sql = mysql_query("SELECT id FROM t_$user_id  WHERE `only_no` = '$only_no'");
$id = mysql_fetch_array($sql,MYSQL_NUM);
if($user_id==$id[0]){echo "자신의 점수는 올릴 수 없습니다"; exit;}*/

mysql_query("update `zerohouse3`.`score` set `score`='$scoredone' where `only_no` = '$only_no'") ;
mysql_query("update `zerohouse3`.`score` set `who`='$newdone' where `only_no` = '$only_no'") ;

?>
