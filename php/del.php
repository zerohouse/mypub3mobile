<?
include "connect_db.php";
$only_no = $_POST['no'];

$sql = mysql_query("SELECT `sort` FROM my_$user_id  WHERE `only_no` = '$only_no'");
$sql = mysql_fetch_array($sql,MYSQL_NUM);
$type = explode('||',$sql[0]);



if ($type[1]==1){//타입 2 는 펍 1은 상대페이지
mysql_query("delete from t_$type[0] where only_no='$only_no'");
}
if ($type[1]==2){
mysql_query("delete from pub_$type[0] where only_no='$only_no'");
}
else{

$sql = mysql_query("SELECT `name_id` FROM my_$user_id  WHERE `only_no` = '$only_no'");
$where = mysql_fetch_array($sql,MYSQL_NUM);
$id = explode('|',$where[0]);

$cnt = count($id);

for ($i=0;$i<$cnt;$i++){
mysql_query("delete from t_$id[$i] where only_no='$only_no'");
}

}

mysql_query("delete from t_$user_id where only_no='$only_no'"); //내꺼 지우기.
mysql_query("delete from reply where only_no='$only_no'");
mysql_query("delete from my_$user_id where only_no='$only_no'");









$dir = 'upload/'.$user_id.'/'.$only_no;
delete_all($dir);
function delete_all($name){
if(is_dir($name)){
$ch=0;
$data_list = opendir($name);
while($file = readdir($data_list)){
if ($file != "." && $file != ".."){$ch++;}
}
closedir($data_list);
if($ch){
$data_list = opendir($name);
while($file = readdir($data_list)){
if ($file != "." && $file != ".."){delete_all($name."/".$file);}
}
closedir($data_list);
}
rmdir($name);
}
else{
unlink($name);
}
}


?>	   
글이 삭제되었습니다.
