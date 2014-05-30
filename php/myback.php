<?php

if (!empty($_FILES)) {
	include "connect_db.php";
	$sql= mysql_query("SELECT no FROM t_$user_id order by no desc limit 0, 1");
	$no = mysql_fetch_array($sql,MYSQL_NUM);
	$rm = $no[0] -1;
	$rm = "temp".$rm;
	$no[0] = "temp".$no[0]; 
	rmdir("./upload/"."temp"."/".$user_id."/".$rm);
	$tempFile = $_FILES['file']['tmp_name'];
	mkdir("./upload/"."temp", 0700);
	mkdir("./upload/"."temp"."/".$user_id, 0700);
	mkdir("./upload/"."temp"."/".$user_id."/".$no[0], 0700);
	$targetFile = "./upload/".'temp'."/".$user_id."/".$no[0]."/".$_FILES['file']['name'];
	
    move_uploaded_file($tempFile,$targetFile);
}

?>     

adsf