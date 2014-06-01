
<?
$anony = $_POST['anony'];
$talk=$_POST['talk'];
$only_no=$_POST['onlyno'];
include "connect_db.php";

$sql = mysql_query("SELECT `sort` FROM my_$user_id  WHERE `only_no` = '$only_no'");
$sql = mysql_fetch_array($sql,MYSQL_NUM);
$type = explode('||',$sql[0]);

if ($talk!= ""){


if ($type[1]==1){//타입 2 는 펍 1은 상대페이지


mysql_query("update `zerohouse3`.`t_$type[0]` set `talk`='$talk',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");
mysql_query("update `zerohouse3`.`t_$type[0]` set `img`='',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");

}

if ($type[1]==2){

mysql_query("update `zerohouse3`.`pub_$type[0]` set `talk`='$talk',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");
mysql_query("update `zerohouse3`.`pub_$type[0]` set `img`='',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");




}

else{

/* 내 DB에서 고쳐야 되는 상대 고름*/
$sql = mysql_query("SELECT `name_id` FROM my_$user_id  WHERE `only_no` = '$only_no'");
$where = mysql_fetch_array($sql,MYSQL_NUM);
$id = explode('|',$n2[0]);
$cnt = count($id);

for($i=0;$i<$cnt[0];$i++){
mysql_query("update `zerohouse3`.`t_$id[$i]` set `talk`='$talk',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");
mysql_query("update `zerohouse3`.`t_$id[$i]` set `img`='',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");
}//고침

}




/*내꺼도 고침*/
mysql_query("update `zerohouse3`.`t_$user_id` set `talk`='$talk',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'");
mysql_query("update `zerohouse3`.`t_$user_id` set `img`='',`anony`='$anony',`date`=now() where id='$user_id' and only_no='$only_no'"); 


















}
//마이테이블의 데이트는 처음 남긴시간, 토크의 데이트는 고친시간.
?>