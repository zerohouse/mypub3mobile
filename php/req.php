<?php
include "connect_db.php";

$fr_g=$_POST['sort'];
$find_id = $_POST['id'];


$sql = "select *from user_data where id = '$find_id'";
$find_db = mysql_query($sql, $connect);
$list = mysql_num_rows($find_db);

$sql2 = "select *from g_$find_id where fr_id = '$user_id'";
$his_db = mysql_query($sql2, $connect);
$onlist = mysql_num_rows($his_db);

$sql3 = "select `fr_on`from g_$user_id where fr_id = '$find_id'";
$fr = mysql_query($sql3, $connect);
$fr_on = mysql_fetch_array($fr);


/* fr_g = 그룹*/


if($list){
	if($onlist){
			if($fr_on[0]==1) {
					echo "100";exit;}
					
			else if($fr_on[0]==2){
					echo "200";exit;}
			else if($fr_on[0]==0){
					echo "300";exit;}


			}
		else{
		
		// fr_on = 1 친구 상태 2 는 대기상태
		$sql = mysql_query("select no from alarm order by no desc limit 0,1");
		$delno = mysql_fetch_array($sql,MYSQL_NUM);
		$request = "insert into g_$user_id (fr_id, sort, fr_on, date)";
		$request.= "values ('$find_id','$fr_g','2',now())";
		mysql_query($request,$connect);
		$request2 = "insert into g_$find_id (fr_id, fr_on, date)";
		$request2.= "values ('$user_id','0',now())";
		mysql_query($request2,$connect);
		mysql_query("insert into alarm (id, message, date, delno) values ('$find_id',\"<li id=nn$user_id onclick=delNo($delno[0]);friendOK('{$user_id}')>{$user_name}님이 친구를 맺고 싶어합니다.</li><li style='display:none;' class=newfriends id=new$user_id></li>\",now(),'$delno[0]')");
		echo "{$fr_g}";
			}
		}
else{
exit;}
?>