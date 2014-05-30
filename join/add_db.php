<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<?

$fuserid = $_POST['fuserid'];
$fname = $_POST['fname'];
$fpasswd = $_POST['fpasswd'];
$fpasswd_re = $_POST['fpasswd_re'];
$fsex = $_POST['fsex'];
$femail = $_POST['femail'];
$phone = $_POST['phone'];
/*$g1c = $_POST['group1c'];
$g2c = $_POST['group2c'];
$g3c = $_POST['group3c'];
$g4c = $_POST['group4c'];
$myc = $_POST['myc'];
$g1n = $_POST['group1'];
$g2n = $_POST['group2'];
$g3n = $_POST['group3'];
$g4n = $_POST['group4'];
$url1 = $_POST['url1'];
$url2 = $_POST['url2'];
$url3 = $_POST['url3'];
$rand = rand(1,10);

if($url1==NULL){
$url1="http://mypub.me/char/random/".$rand."/1.png";
$url2="http://mypub.me/char/random/".$rand."/2.png";
$url3="http://mypub.me/char/random/".$rand."/3.png";
}
else{
if($url2==NULL){$url2=$url1;}
if($url3==NULL){$url3=$url2;}
}

$url = $url1 . "|" . $url2 . "|" . $url3;*/



include "../php/connect_db.php";

$ss = mysql_query("select `id` from user_data where `id` = '$fuserid'");
$r = mysql_fetch_array($ss);
$r2 = strlen($r[0]);

if($fuserid=="" || $fname=="" || $fpasswd == "" || $fpasswd_re == "" || $fpasswd!=$fpasswd_re)
{
echo "<script>
alert('*필수 입력 사항은 반드시 입력해야 합니다.');
history.back();
</script>";
die;
}
else if($r2 >= 1)
{
echo "<script>
alert('$r[0] 아이디가 이미 존재합니다.');
history.back();
</script>";
die;
}

setcookie('user_id',$fuserid);
setcookie('user_name',$fname);

$sql = "insert into user_data (id, name, passwd, sex, email, date, phone, onmenu, char_url, score, groupdata, pub) values ('$fuserid','$fname','$fpasswd','$fsex','$femail',now(),'$phone','0;+;0;+;친구;+;2929FF||0;+;1;+;가족;+;2929FF||0;+;2;+;동료;+;2929FF||1;+;humor;+;유머;+;FF4079||','$url','15|15|15|15|15', '친구;+;2929FF|+|가족;+;2929FF|+|동료;+;2929FF|+|;+;2929FF|+|;+;2929FF|+|;+;2929FF|+|;+;2929FF|+|;+;2929FF|+|;+;2929FF|+|;+;2929FF|+|', ';+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|;+;FF4079|+|')";
$res = mysql_query($sql,$connect);
$tot_row = mysql_affected_rows();



/* 유저 친구 그룹핑 설정 테이블 설정 (상대가 어떤 그룹을 설정했는지 설정)*/

if($flag != "ok")
{
$sql = "create table g_$fuserid(
no int primary key not null auto_increment,
fr_id varchar(12) not null,
sort varchar(12) not null, 
fr_on char(1),
only char(1),
date datetime)";
/* fr_id : 친구 ID, fr_sort : 친구가 나를 설정한 그룹, sort : 친구가 나 분류, fr_on : 친구 추가 여부 */

$result = mysql_query($sql, $connect) or die("error
<script> alert(' 중복 아이디 입니다.');
location.replace('new.php');
</script>");
}

/* 내가 남긴 글*/

if($flag != "ok")
{
$sql = "create table my_$fuserid(
no int primary key not null auto_increment,
name_id text(65536),
sort varchar(12) not null, 
sort_name varchar(12) not null,
score varchar(12) not null,
only_no int(12) not null,
date datetime)";

/* fr_id : 친구 ID, fr_sort : 친구가 나를 설정한 그룹, sort : 친구가 나 분류, fr_on : 친구 추가 여부 */

$result = mysql_query($sql, $connect) or die("error
<script> alert(' 중복 아이디 입니다.');
location.replace('index.html');
</script>");
}



/* 글남길 데이터베이스*/
if($flag != "ok")
{
$sql = "create table t_$fuserid(
no int primary key not null auto_increment,
sort varchar(12) not null,
id varchar(12) not null,
img varchar(5000) not null,
talk text(65536),
score varchar(12) not null,
anony varchar(12) not null,
talk_sort varchar(12) not null,
only_no int(12) not null,
date datetime)";

$result = mysql_query($sql, $connect) or die("error
<script> alert(' 테이블이 이미 존재 합니다.');
location.replace('new.php');
</script>");
}


/* sort : 글남길 그룹, talk : 글 */
mysql_close($connect);



if($tot_row > 0){
	echo "<script>
	alert('My Republic, My PUB\\r\\n 회원이 되신 것을 환영합니다. ');
	location.replace('../index.php');
	</script>";
	}
else{
	echo "<script>
	alert('[등록 실패]\\r\\n 오류가 발생하여 회원 등록에 실패했습니다. ');
	history.back();
	</script>";
	}

	
	
	
	









?>
</html>