
<?
$anony = $_POST['anony'];
$head=$_POST['head'];
$body=$_POST['body'];
$pagesort=$_POST['pagesort'];
$head="<div class='title'>".$head."</div>";
$body="<div class='body'>".$body."</div>";

include "connect_db.php";

$type = explode('||',$pagesort);
if($type[1]==1)
{
if ($user_id==$type[0])
{
echo "자신에게 글을 쓸 수 없습니다.";
exit;
}
}

//온리넘버 가져오기.
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
$allfiles="<p class=fancywrap>";
for ($i=2;$i<$cnt;$i++)
{$allfiles=$allfiles.'<a class=fancybox href=\'php/upload/'.$user_id.'/'.$only_no[0].'/'.$files[$i]. "' data-fancybox-group=gallery title=''><img class=bodyimg src='php/upload/".$user_id."/".$only_no[0].'/'.$files[$i]. "' alt=></a>";}
$allfiles=$allfiles."</p>";

// 토크 생성
$talk=$head.$allfiles.$body;



if ($type[1]==Null) // 그룹에 글쓸때.
{
// 내 DB에서 지금 내가 쓰려는 글이 가야 하는 상대 고름
$sql= mysql_query("SELECT count(`fr_id`) FROM g_$user_id WHERE `sort` = '$pagesort'  and `fr_on` = '1'");
$cnt = mysql_fetch_array($sql,MYSQL_NUM);

for($i=0;$i<$cnt[0];$i++){
$sql= mysql_query("SELECT `fr_id` FROM g_$user_id WHERE `sort` = '$pagesort'  and `fr_on` = '1' order by no desc limit $i, 1");
$id=mysql_fetch_array($sql,MYSQL_NUM);//아디 가져오고
$sql= mysql_query("SELECT `sort` FROM g_$id[0] WHERE `fr_id` = '$user_id' and `fr_on` = '1'");
$sort=mysql_fetch_array($sql,MYSQL_NUM);//그사람 소트값 가져오고
$where = "$where" . "|" . "$id[0]"; // 아이디 모아주고
mysql_query("INSERT INTO `zerohouse3`.`t_$id[0]` (`sort`,`id`,`talk`,`anony`,`date`,`only_no`) values('$sort[0]','$user_id',\"$talk\",'$anony',NOW(),'$only_no[0]');"); //글쓰고
}
$tmp=$pagesort+1;
echo "그룹{$tmp}에 글이 작성되었습니다.";
}


if ($type[1]==1) // 상대에게만 넣을때. $type[0]이 상대 아이디.
{
$id=mysql_fetch_array($sql,MYSQL_NUM);//아디 가져오고
$sql= mysql_query("SELECT `sort` FROM g_$type[0] WHERE `fr_id` = '$user_id' and `fr_on` = '1'");
$sort=mysql_fetch_array($sql,MYSQL_NUM);//그사람 소트값 가져오고
$where = "$where" . "|" . "$id[0]"; // 아이디 모아주고
mysql_query("INSERT INTO `zerohouse3`.`t_$type[0]` (`sort`,`id`,`talk`,`anony`,`date`,`only_no`) values('$sort[0]','$user_id',\"$talk\",'$anony',NOW(),'$only_no[0]');"); //글쓰고

$sql = mysql_query("SELECT `sort`from g_$user_id where fr_id = '$type[0]'");
$sql=mysql_fetch_array($sql,MYSQL_NUM);
$pagesort=$sql[0];
$sql = mysql_query("SELECT `name`from user_data where id = '$type[0]'");
$name=mysql_fetch_array($sql,MYSQL_NUM);
echo "{$name[0]}({$type[0]})님에게 글이 작성되었습니다.";
}

if ($type[1]==2) // pub에 작성하기
{
mysql_query("INSERT INTO `zerohouse3`.`pub_$type[0]` (`sort`,`id`,`talk`,`anony`,`date`,`only_no`) values('$sort[0]','$user_id',\"$talk\",'$anony',NOW(),'$only_no[0]');"); //글쓰고

$where= "!!pub|$type[0]";
echo "PUB{$type[0]}에 글을 작성하였습니다.";
}



//내꺼에도너줌 $pagesort 가 상대 솔트값이 되야 됨..
mysql_query("INSERT INTO `zerohouse3`.`my_$user_id` (`sort`,`name_id`,`date`,`only_no`) values('$pagesort','$where',NOW(),'$only_no[0]');");
mysql_query("INSERT INTO `zerohouse3`.`t_$user_id` (`sort`,`id`,`talk`,`anony`,`date`,`only_no`) values('$pagesort','$user_id',\"$talk\",'$anony',NOW(),'$only_no[0]');");
mysql_query("INSERT INTO `reply` (`id`,`only_no`) values('$user_id','$only_no[0]');");//리플생성
mysql_query("INSERT INTO `score` (`hum`,`sym`,`wow`,`info`,`etc`,`type`,`only_no`) values(15,15,15,15,15,'letter','$only_no[0]');");//스코어생성
?>