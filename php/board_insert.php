
<?
$anony = $_POST['anony'];
$head=$_POST['head'];
$body=$_POST['body'];
$pagesort=$_POST['pagesort'];
$talk=$body . "|+|". $head;
include "connect_db.php";


echo $pagesort;

// ($talk!= ""){

// 내 DB에서 지금 내가 쓰려는 글이 가야 하는 상대 고름
$sql= mysql_query("SELECT count(`fr_id`) FROM g_$user_id WHERE `sort` = '$pagesort'  and `fr_on` = '1'");
$cnt = mysql_fetch_array($sql,MYSQL_NUM);


//다 집어너줌
$sql = mysql_query("SELECT `no`from only order by no desc limit 0, 1");
$only_no = mysql_fetch_array($sql,MYSQL_NUM); //온리넘버
mysql_query("INSERT INTO `zerohouse3`.`only` (`no`)VALUES (NULL);"); //온리넘버 증가
$where="";

// 사진데이터 생성
$sql= mysql_query("SELECT no FROM t_$user_id order by no desc limit 0, 1");
$no = mysql_fetch_array($sql,MYSQL_NUM);
$no[0] = "temp".$no[0]; 
$dir = "./upload/".'temp'."/".$user_id.'/'.$no[0];
$files = scandir($dir);
mkdir("./upload/".$user_id, 0700);
rename($dir,"upload/$user_id/$only_no[0]");
$cnt = count($files);
$allfiles="";
for ($i=2;$i<$cnt;$i++)
{$allfiles=$allfiles.'||'.'php/upload/'.$user_id."/".$only_no[0].'/'.$files[$i];}


for($i=0;$i<$cnt[0];$i++){
$sql= mysql_query("SELECT `fr_id` FROM g_$user_id WHERE `sort` = '$pagesort'  and `fr_on` = '1' order by no desc limit $i, 1");
$id=mysql_fetch_array($sql,MYSQL_NUM);//아디 가져오고
$sql= mysql_query("SELECT `sort` FROM g_$id[0] WHERE `fr_id` = '$user_id' and `fr_on` = '1'");
$sort=mysql_fetch_array($sql,MYSQL_NUM);//그사람 소트값 가져오고
$sql = mysql_query("SELECT `no`from only order by no desc limit 0, 1");
$where = "$where" . "|" . "$id[0]"; // 아이디 모아주고
mysql_query("INSERT INTO `zerohouse3`.`t_$id[0]` (`sort`,`id`,`name`,`talk`,`anony`,`date`,`only_no`,`name`) values('$sort[0]','$user_id','$user_name','$talk','$anony',NOW(),'$only_no[0]','$allfiles');"); //글쓰고
}

//내꺼에도너줌
$sql = mysql_query("SELECT `sort$pagesort` FROM user_db WHERE `userid` = '$user_id'");
$sort_name = mysql_fetch_array($sql,MYSQL_NUM);
mysql_query("INSERT INTO `zerohouse3`.`my_$user_id` (`sort`,`sort_name`,`name_id`,`date`,`only_no`) values('$pagesort','$sort_name[0]','$where',NOW(),'$only_no[0]');");
mysql_query("INSERT INTO `zerohouse3`.`t_$user_id` (`sort`,`id`,`talk`,`anony`,`date`,`only_no`,`name`) values('$pagesort','$user_id','$talk','$anony',NOW(),'$only_no[0]','$allfiles');");
mysql_query("INSERT INTO `reply` (`id`,`only_no`) values('$user_id','$only_no[0]');");//리플생성
mysql_query("INSERT INTO `score` (`type`,`only_no`,`score`) values('letter','$only_no[0]','15|15|15|15|15');");//스코어생성

?>
