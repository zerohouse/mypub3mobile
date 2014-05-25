<?
$host = "localhost";
$user = "zerohouse3";
$passwd = "qkrtjdgh1";

$connect = mysql_connect($host, $user, $passwd) or die ("mysql Server Connection Error");
mysql_select_db('zerohouse3',$connect) or die ("DB Connection Error");
?>