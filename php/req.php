
<?php
include "connect_db.php";

$fr_g=$_POST['sort'];
$find_id = $_POST['id'];

$sql = "select *from user_db where userid = '$find_id'";
$find_db = mysql_query($sql, $connect);
$list = mysql_num_rows($find_db);

$sql2 = "select *from g_$find_id where fr_id = '$user_id'";
$his_db = mysql_query($sql2, $connect);
$onlist = mysql_num_rows($his_db);

$sql3 = "select `fr_on`from g_$user_id where fr_id = '$find_id'";
$fr = mysql_query($sql3, $connect);
$fr_on = mysql_fetch_array($fr);

if ($fr_g==0){$fr_g=1;}

/* fr_g = 그룹*/


if($list){
	if($onlist){
			if($fr_on[0]==1) {
					echo "이미 친구시네요~!";exit;}
					
			else if($fr_on[0]==2){
					echo "친구 요청 대기중입니다!";exit;}
			else if($fr_on[0]==0){
					echo "새로운 친구를 클릭해보세요!";exit;}


			}
		else{
		
		// fr_on = 1 친구 상태 2 는 대기상태
		$request = "insert into g_$user_id (fr_id, sort, fr_on, date)";
		$request.= "values ('$find_id','$fr_g','2',now())";
		mysql_query($request,$connect);
		$request2 = "insert into g_$find_id (fr_id, fr_on, date)";
		$request2.= "values ('$user_id','0',now())";
		mysql_query($request2,$connect);
		echo "친구요청 했어요~!";
	
			}
		}
else{
exit;}
?>