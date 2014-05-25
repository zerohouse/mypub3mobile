<meta charset="utf-8" />
<?
include "php/connect_db.php";
$ffs = mysql_query("SELECT * FROM user_db  WHERE `userid` = '$user_id'");
$srnn = mysql_fetch_array($ffs,MYSQL_NUM);

if (strlen($user_id)>1)
{

echo "<script>location.replace('main.html')</script>";}
else{
echo "<script>location.replace('login.html')</script>";}
?>