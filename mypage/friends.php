<style>
#groupall{display:none;}
#groupall ul{margin-top:30px;margin-left:20px;
z-index: 5;
position:absolute;
list-style-type: none;
padding: 0;
background-color: #fff;
box-shadow: 0 5px 10px rgba(0,0,0,0.2);
border: 1px solid #ccc;min-width:70;text-align:center;}
#groupall li{cursor:hand;color:#777777;min-width:30px;padding:0px 15px;font-size:15px;height:30;line-height:30px;}
#groupall li:hover{color:#000;background-color:#f4f4f4}
</style>
<script>

</script>
<div class=wrapping>
<center><font size='4'><strong>마이펍 친구 관리</strong></font></center>
<?
include "../php/connect_db.php";

$sql = mysql_query("SELECT groupdata FROM user_data  WHERE `id` = '$user_id'");
$group_data = mysql_fetch_array($sql,MYSQL_NUM); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive

$group_data = explode("|+|",$group_data[0]);



for($i=0;$i<10;$i++) // 10개 세고;
{
$sql = mysql_query("SELECT count(fr_id) FROM g_$user_id  WHERE `sort` = '$i'");
$cnt = mysql_fetch_array($sql,MYSQL_NUM);

$group = explode(";+;",$group_data[$i]);
$xxx = $i+1;
$gn[$i] = $group[0];

if ($group[0]=="")
{
$group[0]="무제";
}


		echo "<div id=friends$i class=frwrap><div class=frtitle><strong>그룹{$xxx} <font color=#$group[1]>{$group[0]}</font>의 멤버<br><br></strong></div>";

		for ($j=0;$j<$cnt[0];$j++){
		$sql = mysql_query("SELECT fr_id FROM g_$user_id  WHERE `sort` = '$i' order by no desc limit $j,1");
		$friends = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT name FROM user_data  WHERE `id` = '$friends[0]'");
		$frname = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT profile FROM user_data  WHERE `id` = '$friends[0]'");
		$frprofile = mysql_fetch_array($sql,MYSQL_NUM);

		echo "<div id=go$friends[0]><div class=movefr onclick=friendMoveAllgroup('$friends[0]')><img class=frprofile src=$frprofile[0]><br>$frname[0]($friends[0])</div><div class=movefriends id=move$friends[0]></div></div>";}
		echo "</div>";

}

		echo "<div id=friends50 class=frwrap><div class=frtitle><strong>무인도에서 혼자 노는 사람들 <br><br></strong></div>";

		for ($j=0;$j<$cnt[0];$j++){
		$sql = mysql_query("SELECT fr_id FROM g_$user_id  WHERE `sort` = '50' order by no desc limit $j,1");
		$friends = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT name FROM user_data  WHERE `id` = '$friends[0]'");
		$frname = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT profile FROM user_data  WHERE `id` = '$friends[0]'");
		$frprofile = mysql_fetch_array($sql,MYSQL_NUM);

		echo "<div class=movefr onclick=friendMove('$friends[0]')><img class=frprofile src=$frprofile[0]><br>$frname[0]($friends[0])</div><div class=movefriends id=move$friends[0]></div>";}
		echo "</div>";
		
?></div>


<div id=groupall class=popup>
<ul>
<li onclick="swipeLetter(100, 0, addid)">페이지로 이동</li>
<?

for($i=0;$i<10;$i++)
{
$k = $i+1;
echo "<li onclick=\"addFriends($i, '{$gn[$i]}')\">그룹{$k} {$gn[$i]}(으)로 이동</li>";
}
?>
<li onclick=addFriends(50)>무인도로 이동</li>
</ul>
</div><br><br>


