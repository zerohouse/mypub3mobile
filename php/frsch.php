
<?php
include "connect_db.php";

if(!isset($_POST['find_id'])) exit;
$fr_g=$_POST['pagesort'];
$find_id = $_POST['find_id'];

/*아이디로 찾기*/
$sql = "select `name` from user_data where `id` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$name_id = mysql_fetch_array($find_db);

$sql = "select `id` from user_data where `id` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$id_id = mysql_fetch_array($find_db);

$sql = "select `phone` from user_data where `id` = '$find_id'  and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$number_id = mysql_fetch_array($find_db);

/*이름으로 찾기*/
$sql = "select GROUP_CONCAT(name SEPARATOR ';') `name` from user_data where `name` = '$find_id'  and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$name_n1 = mysql_fetch_array($find_db);
$name_n = explode(';',$name_n1[0]);

$sql = "select GROUP_CONCAT(id SEPARATOR ';') `id` from user_data where `name` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$id_n1 = mysql_fetch_array($find_db);
$id_n = explode(';',$id_n1[0]);

$sql = "select GROUP_CONCAT(phone SEPARATOR ';') `phone` from user_data where `name` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$number_n1 = mysql_fetch_array($find_db);
$number_n = explode(';',$number_n1[0]);

/*번호로 찾기*/
$sql = "select GROUP_CONCAT(name SEPARATOR ';') `name` from user_data where `phone` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$name_p1 = mysql_fetch_array($find_db);
$name_p = explode(';',$name_p1[0]);

$sql = "select GROUP_CONCAT(id SEPARATOR ';') `id` from user_data where `phone` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$id_p1 = mysql_fetch_array($find_db);
$id_p = explode(';',$id_p1[0]);

$sql = "select GROUP_CONCAT(phone SEPARATOR ';') `phone` from user_data where `phone` = '$find_id' and `id` != '$user_id'";
$find_db = mysql_query($sql, $connect);
$number_p1 = mysql_fetch_array($find_db);
$number_p = explode(';',$number_p1[0]);
echo "<ul id='reqwrap'><li class='line'>친구 검색 결과<li>";
/*아이디 검색 결과 출력*/
if($id_id[0]==""){
echo "<li>&nbsp;&nbsp;일치하는 ID가 없습니다.</li>";}
else{
echo "<li>ID 검색결과<script>friend = '$id_id[0]'; sort = '$fr_g';</script></li>";
echo "<li class='frname'> $name_id[0]($id_id[0])님 </a><a class='reqbtn' onclick='friendReq(friend, sort);'>친구요청하기</a></li>";}

/*이름 검색 결과 출력*/
if($id_n[0]==""){
echo "<li>&nbsp;&nbsp;일치하는 이름이 없습니다.</li>";}
else {
$cnt = count($id_n);
echo "<li>이름이 {$find_id}인 친구 {$cnt}명</li>";
for ($i=0;$i<$cnt;$i++){
echo "<li><script>friend = '$id_n[$i]'; sort = '$fr_g';</script><a class='frname'> $name_n[$i]($id_n[$i])님 </a><a class='reqbtn' onclick='friendReq(friend, sort);'>친구요청하기</a></li>";}}

/*번호 검색 결과 출력*/
if($id_p[0]==""){
echo "<li>&nbsp;&nbsp;일치하는 번호가 없습니다.</li>";}
else {
$cnt = count($id_p);
echo "<li>전호번호 마지막자리가 {$find_id}인 친구 {$cnt}명<script>friend = '$id_id[0]'; sort = '$fr_g';</script></li>";
for ($i=0;$i<$cnt;$i++){
echo "<li><script>friend = '$id_p[$i]'; sort = '$fr_g';</script><a class='frname'> $name_p[$i]($id_p[$i])님 </a><a class='reqbtn' onclick='friendReq(friend, sort);'>친구요청하기</a></li>";}}echo "</ul>";

?></div>








