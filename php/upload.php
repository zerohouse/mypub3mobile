<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($upfile1_name==null)
{
echo"<script type='text/javascript'>alert('파일이 없습니다.');history.go(-1);</script>";
exit;
}

$upfile1_ext=substr(strrchr($upfile1_name,"."),1); //파일확장자
if(eregi("jpg|png|gif", $upfile1_ext)){ //파일확장자 체크
	if ($upfile1_size<512000) //파일 용량 체크
		{
			if(copy($upfile1,"../char/upload/".$user_id."1.".$upfile1_ext))
			{$url1="http://mypub.me/char/upload/".$user_id."1.".$upfile1_ext;}
		}
		else{
	      echo"<script type='text/javascript'>alert('$upfile1_size 1번 파일 용량 초과입니다.');history.go(-1);</script>";
		  exit;
		}
    }
	else{
	      echo"<script type='text/javascript'>alert('$upfile1_ext 1번 파일 업로드가 제한된 파일입니다.');history.go(-1);</script>";
		  exit;
	}
	// 파일1 업로드
	

if($upfile2_name!=null){
$upfile2_ext=substr(strrchr($upfile2_name,"."),1); //파일확장자
if(eregi("jpg|png|gif", $upfile2_ext)){ //파일확장자 체크
	if ($upfile2_size<512000) //파일 용량 체크
		{
			if(copy($upfile2,"../char/upload/".$user_id."2.".$upfile2_ext))
			{$url2="http://mypub.me/char/upload/".$user_id."2.".$upfile2_ext;}
		}
		else{
	      echo"<script type='text/javascript'>alert('$upfile2_size 2번 파일 용량 초과입니다.');history.go(-1);</script>";
		  exit;
		}
    }
	else{
	      echo"<script type='text/javascript'>alert('$upfile2_ext 2번 파일 업로드가 제한된 파일입니다.');history.go(-1);</script>";
		  exit;
	}}
	// 파일2 업로드
	

if($upfile3_name!=null){
$upfile3_ext=substr(strrchr($upfile3_name,"."),1); //파일확장자
if(eregi("jpg|png|gif", $upfile3_ext)){ //파일확장자 체크
	if ($upfile3_size<512000) //파일 용량 체크
		{
			if(copy($upfile3,"../char/upload/".$user_id."3.".$upfile3_ext))
			{$url3="http://mypub.me/char/upload/".$user_id."3.".$upfile3_ext;}
		}
		else{
	      echo"<script type='text/javascript'>alert('$upfile3_size 3번 파일 용량 초과입니다.');history.go(-1);</script>";
		  exit;
		}
    }
	else{
	      echo"<script type='text/javascript'>alert('$upfile3_ext 3번 파일 업로드가 제한된 파일입니다.');history.go(-1);</script>";
		  exit;
	}}
	// 파일3 업로드
	
	// 여기부터 URL 업데이트
if($url1==NULL){echo "<script type='text/javascript'>alert('업로드할 파일이 없습니다.');history.go(-1);</script>";exit;
}else{
if($url2==NULL){$url2=$url1;}
if($url3==NULL){$url3=$url2;}
}
$url = $url1 . "|" . $url2 . "|" . $url3;
include "connect_db.php";
mysql_query("update user_db set char_url='$url' where userid='$user_id'") ;
echo"<script type='text/javascript'>alert('캐릭터 파일 업로드가 완료되었습니다.');location.replace('../main.php');</script>";


?>