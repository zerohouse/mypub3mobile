
<?php

include "../php/connect_db.php";
$profile_ext=substr(strrchr($profile_name,"."),1); //파일확장자
if(eregi("jpg|png|gif", $profile_ext)){ //파일확장자 체크
	if ($profile_size<2512000){ //파일 용량 체크
	$prodes = "files/profile".$user_id.".".$profile_ext;
   copy($profile,$prodes);
   $update="http://mypub.me/mypage/".$prodes;
   mysql_query("update user_data set profile='$update' where id='$user_id'") ; 
   
   echo"<script type='text/javascript'>location.replace('mypage.html?id=$user_id');</script>"; 

   }
   else{echo"<script type='text/javascript'>alert('2MB이하의 JPG,PNG,GIF파일만 사용가능합니다.');location.replace('mypage.html?id=$user_id');</script>"; }
   }
   
$back_ext=substr(strrchr($back_name,"."),1); //파일확장자
if(eregi("jpg|png|gif", $back_ext)){ //파일확장자 체크
	if ($back_size<2512000){ //파일 용량 체크
	$backdes = "files/back".$user_id.".".$back_ext;
   copy($back,$backdes);
   $update="http://mypub.me/mypage/".$backdes;
   mysql_query("update user_data set char_url='$update' where id='$user_id'") ; 
   
   echo"<script type='text/javascript'>location.replace('mypage.html?id=$user_id');</script>"; 
   }
   else{
   echo"<script type='text/javascript'>alert('2MB이하의 JPG,PNG,GIF파일만 사용가능합니다.');location.replace('mypage.html?id=$user_id');</script>"; }
   }

  
   
echo"<script type='text/javascript'>alert('2MB이하의 JPG,PNG,GIF파일만 사용가능합니다.');location.replace('mypage.html?id=$user_id');</script>";   



?>