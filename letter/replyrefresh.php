<?
include "../php/connect_db.php";
$only_no = $_POST['onlyno'];
	$sql = mysql_query("SELECT *from user_data where `id` = '$user_id'");
	$user_data = mysql_fetch_array($sql,MYSQL_NUM); // 리플 가져오기
	$sql = mysql_query("SELECT `reply`from reply where `only_no` = '$only_no'");
	$sql = mysql_fetch_array($sql,MYSQL_NUM); // 리플 가져오기
	$reply = explode("|",$sql[0]); // 리플
	$cnt = count($reply);

		if($reply[1]!=null){
		for ($j=1;$j<$cnt;$j++) {		
		$replydata = explode("&*$",$reply[$j]); // 익명/실명 , 이름 , ID, 내용, 데이트
		$sql = mysql_query("SELECT `profile`from user_data where `id` = '$replydata[2]'");
		$profile = mysql_fetch_array($sql,MYSQL_NUM); // 리플작성자 프로필 가져오기
		
		
		$f = "";
				if ($replydata[0]==1){$profile[0]= "icon/anony.png";$replydata[1]="익명";$f="return false;";}//리플 익명첵
		
		
		echo "
        <div class=replyonwrap>
            <a class='profileimg' style=\"background-image: url($profile[0])\"></a><div class=replywrap><a class=replydate onclick=\"{$f}swipeLetter(100, 0, '$replydata[2]')\">$replydata[1] $replydata[4]</a><div class=reply readonly>$replydata[3]";
			
			if ($replydata[2]==$user_id){ echo "<a class=delreply onclick=delReply($only_no,$j)>삭제<a>";}
			
			echo "</div>
        </div></div>";}}
		
		echo "
        <div class=replyonwrap >
                <a class='profileimg' id='anonyimg$only_no' onclick='replyToggle($only_no)' style='background-image: url($user_data[10])'></a><div class=replywrap><span id='anony$only_no' class=reply>$user_data[2]</span> : <input id='replywriteform$only_no' class=makereply type='text' placeholder='댓글을 남겨주세요^-^' onKeyDown='javascript:if (event.keyCode == 13) writeReply(replybox$only_no, $only_no, replywriteform$only_no, anony$only_no);'>
            </div></div>"; // 글끝
		
		
		
		?>

	