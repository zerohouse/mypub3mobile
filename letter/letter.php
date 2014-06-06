<?
include "../php/connect_db.php";
$group = $_POST['group']; // 타입으로 나눠서 소팅해야댐.
$groupname = $_POST['name'];
$page = $_POST['page'];

$type = explode('||',$group);
$sql = mysql_query("SELECT * FROM user_data  WHERE `id` = '$user_id'");
$user_data = mysql_fetch_array($sql,MYSQL_NUM); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
if ($groupname==null){$groupname="이름없는";}
if ($type[1]==1){


echo "
<iframe class=myframe scrolling='no'  onload='javascript:resizeIframe(this);' src='mypage/mypage.html?id=$type[0]'>
</iframe><div class=wrapping>";
/*<div class=bottom>
	<div class=omenuwrap>
	<div class=omenu>메뉴</div>
	<div class=omenu>메뉴</div>
	<div class=omenu>메뉴</div></div></div>*/

		


	


}else if ($type[1]==2){

		echo "
		<div class=wrapping>
		
            <div id='namewrap'>
               $user_data[2]님 안녕하세요. <font style=font-family:dek>Pub</font> {$groupname}입니다.
            </div>        "; // 인사말


}else{
	$xx = str_split($groupname, 15);
		echo "
		<div class=wrapping>
		
            <div id='namewrap'>
               $user_data[2]님 안녕하세요. <a class=namewid>$xx[0]</a> 그룹입니다. <a class=viewfriends onclick=toggleID('friends')> 친구보기 </a>
            </div>
        "; // 인사말
		echo "<div id=friends class=frwrap><div class=frtitle><strong>{$groupname}그룹의 멤버<br><br></strong></div>";
		$sql = mysql_query("SELECT count(fr_id) FROM g_$user_id  WHERE `sort` = '$type[0]'");
		$frcnt = mysql_fetch_array($sql,MYSQL_NUM);
		if ($frcnt[0]==0){
		echo "<div class=movefr>이 그룹에 친구가 없습니다.</div>";
		}
		else{
		for ($i=0;$i<$frcnt[0];$i++){
		$sql = mysql_query("SELECT fr_id FROM g_$user_id  WHERE `sort` = '$type[0]' order by no desc limit $i,1");
		$friends = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT name FROM user_data  WHERE `id` = '$friends[0]'");
		$frname = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT profile FROM user_data  WHERE `id` = '$friends[0]'");
		$frprofile = mysql_fetch_array($sql,MYSQL_NUM);

		echo "<div class=movefr onclick=friendMove('$friends[0]')><img class=frprofile src=$frprofile[0]><br>$frname[0]($friends[0])</div><div class=movefriends id=move$friends[0]></div>";}}
		echo "</div>";
		

		
		
		
		
		
		
		
		
		
}
		
?>
	
</div>
</div>
<script type="text/javascript">
$(function() {
$("#schtitlearea").autosize();
$("#schtextarea").autosize();
$(".popup").hide();
});
replanony=0;

//$('.mod').fixer({gap: 100});

</script>


<div id=mod>
<ul>
<li onclick='editThis();'>수정</li>
<li onclick='del_confirm();'>삭제</li>
</ul>
</div>

