<?
include "../php/connect_db.php";
$group = $_POST['group'];
$groupname = $_POST['name'];
$page = $_POST['page'];

$sql = mysql_query("SELECT * FROM user_data  WHERE `id` = '$user_id'");
$user_data = mysql_fetch_array($sql,MYSQL_NUM); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
if ($groupname==null){$groupname="이름없는";}

$type = explode('||',$group);
	
// 여기부터 글	

	for ($i=$page*4;$i<$page*4+4;$i++){
	
	if($type[1]==1){ // 어느 게시판인지.타입알아보기. //타입 1은 상대페이지

if ($type[0]==$user_id){
$sql = mysql_query("SELECT * from t_$user_id where `id` = '$type[0]' order by no desc limit $i, 1");
}else{
$sql = mysql_query("SELECT * from t_$user_id where `id` = '$type[0]' and not `anony` = '1' order by no desc limit $i, 1");} //no  sort  id  name  talk  score  anony  talk_sort  only_no  date
	
	
	$data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT * from user_data where `id` = '$data[2]'"); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
	$writer_data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT `reply`from reply where `only_no` = '$data[8]'");
	$sql = mysql_fetch_array($sql,MYSQL_NUM); // 리플 가져오기
	$reply = explode("|",$sql[0]); // 리플
	$only_no[0] = $data[8];
	$sql = mysql_query("SELECT * from score where `only_no` = '$only_no[0]'"); 
	$score = mysql_fetch_array($sql,MYSQL_NUM);

	
	
	}
	else if($type[1]==2){ //타입 2 는 펍
	$sql = mysql_query("SELECT * from pub_$type[0] order by no desc limit $i, 1"); //no  sort  id  name  talk  score  anony  talk_sort  only_no  date
	$data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT * from user_data where `id` = '$data[2]'"); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
	$writer_data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT `reply`from reply where `only_no` = '$data[8]'");
	$sql = mysql_fetch_array($sql,MYSQL_NUM); // 리플 가져오기
	$reply = explode("|",$sql[0]); // 리플
	$only_no[0] = $data[8];
	$sql = mysql_query("SELECT * from score where `only_no` = '$only_no[0]'"); 
	$score = mysql_fetch_array($sql,MYSQL_NUM);
	
	
	}
	
	else{
	$sql = mysql_query("SELECT * from t_$user_id where `sort` = '$group' order by no desc limit $i, 1"); //no  sort  id  name  talk  score  anony  talk_sort  only_no  date
	$data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT * from user_data where `id` = '$data[2]'"); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
	$writer_data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT `reply`from reply where `only_no` = '$data[8]'");
	$sql = mysql_fetch_array($sql,MYSQL_NUM); // 리플 가져오기
	$reply = explode("|",$sql[0]); // 리플
	$only_no[0] = $data[8];
	$sql = mysql_query("SELECT * from score where `only_no` = '$only_no[0]'"); 
	$score = mysql_fetch_array($sql,MYSQL_NUM);
	}
	
	/*$leng = mb_strlen($talk[0]); // 길이따른 폰트 크기 지정
	if ( $leng < 100 ){$fs = 8;}
		else if ( $leng < 200 ) {$fs = 7;}
		else if ( $leng < 400) {$fs = 6;}
		else if ( $leng < 600) {$fs = 5;}
		else if ( $leng < 1000) {$fs = 4;}
		else {$fs = 3;}*/
		$f ="";
				if ($data[6]==1){
				$writer_data[10] = "icon/anony.png";
				$writer_data[2] = "익명";
				$f="return false;";
				} //익명 체크
				
		

if ($data[0]!=null){

	echo "<div class=wrapping>
    <article class='letter'>";
	
	
		if($type[1]!=2){
    echo "    <div class=replyonwrap>
                <a class='profileimg' style='background-image: url($writer_data[10])'></a><div class=replywrap><span onclick=\"{$f}swipeLetter(100, 0, '$writer_data[1]', '$writer_data[2]')\" class=reply>$writer_data[2]</span><br><span class=replydate>$data[9]</span>";
				
			if ($data[2]==$user_id){echo "<a id=mod$only_no[0] onclick='modLetter($only_no[0])' class=mod></a>";}
				
        echo "</div></div>";}
	

	
	
	echo "<div id=edit$only_no[0] class=overflow>"; //수정 에디터블
		


	echo "$data[4]";
	
		echo "</div>"; //수정 에디터블
	echo "<div id=editbtn$only_no[0]></div>"; //수정버튼 에디터블
	

		$onscore = $score[0] + $score[1] + $score[2] + $score[3] + $score[4];
		$cnt = count($reply);
		$rc = $cnt-1;
	    echo "
		<div class='replycall' id=cr$data[8]
		onclick=\"toggleID('replybox$data[8]');callAdds('cr$data[8]', 1);\">
		
		<a id=comments$data[8]>{$rc}</a> comments</div><div class='feelingcall' id=cf$data[8] onclick=\"toggleID('easing$data[8]');callAdds('cf$data[8]',2 );\"><a id=points$data[8]>{$onscore}</a> points</div>";
		
		if($type[1]==2){echo "<div id=cw$data[8] class='writercall' onclick=\"toggleID('writerinfo$data[8]');callAdds('cw$data[8]',3);\">writer</div>";}
		

		
		
		
		
						if($type[1]==2){
								
		if ($data[2]==$user_id){echo "<a id=mod$only_no[0] onclick='modLetter($only_no[0])' class=mod></a>";}
							
		echo "<div id=writerinfo$data[8] style='display:none;padding-top:10px;margin-top:10px;border-top:1px solid #f4f4f4'> <div class=replyonwrap>
                <a class='profileimg' style='background-image: url($writer_data[10])'></a><div class=replywrap><span onclick=\"swipeLetter(100, 0, '$writer_data[1]', '$writer_data[2]')\" class=reply>$writer_data[2]</span><br><span class=replydate>$data[9]</span>";
				

				
				
            echo "</div></div></div>";}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		echo "<div class=replybox style='display:none'; id=replybox$data[8]>";
		
		if($reply[1]!=null){
		for ($j=1;$j<$cnt;$j++) {		
		$replydata = explode("&*$",$reply[$j]); // 익명/실명 , 이름 , ID, 내용, 데이트
		$sql = mysql_query("SELECT `profile`from user_data where `id` = '$replydata[2]'");
		$profile = mysql_fetch_array($sql,MYSQL_NUM); // 리플작성자 프로필 가져오기
		
		
		$f = "";
				if ($replydata[0]==1){$profile[0]= "icon/anony.png";$replydata[1]="익명";$f="return false;";}//리플 익명첵
		
		
		echo "
        <div class=replyonwrap>
            <a class='profileimg' style=\"background-image: url($profile[0])\"></a><div class=replywrap><a class=replydate onclick=\"{$f}swipeLetter(100, 0, '$replydata[2]','$replydata[1]')\">$replydata[1] $replydata[4]</a><div class=reply readonly>$replydata[3]";
			
			
			if ($replydata[2]==$user_id){ echo "<a class=delreply onclick=delReply($only_no[0],$j)>삭제<a>";}
			
			
			echo "</div>
        </div></div>";}}
		
		echo "
        <div class=replyonwrap >
                <a class='profileimg' id='anonyimg$only_no[0]' onclick='replyToggle($only_no[0])' style='background-image: url($user_data[10])'></a><div class=replywrap><span id='anony$only_no[0]' class=reply>$user_data[2]</span> : <input id='replywriteform$only_no[0]' class=makereply type='text' placeholder='댓글을 남겨주세요^-^' onKeyDown='javascript:if (event.keyCode == 13) writeReply(replybox$only_no[0], $only_no[0], replywriteform$only_no[0], anony$only_no[0]);'>
            </div></div></div>"; // 글끝
		
		
		
		

		
		
		
		
		
		
		
		
        echo "
                <div class='easing' style='display:none;' id='easing$data[8]'>
              <br>
			<div class=pointwrap>
			<div class='pointbtnhum' onclick='scorePlus(4, $only_no[0]);'><a class=points>$score[4]</a><br> ㅋㅋ+</div>
			<div class='pointbtnsym' onclick='scorePlus(0, $only_no[0]);'><a class=points>$score[0]</a><br> 공감+</div>
			<div class='pointbtnwow' onclick='scorePlus(1, $only_no[0]);'><a class=points>$score[1]</a><br> 우와+</div>
			<div class='pointbtngood' onclick='scorePlus(2, $only_no[0]);'><a class=points>$score[2]</a><br> 지식+</div>
			<div class='pointbtnsad' onclick='scorePlus(3, $only_no[0]);'><a class=points>$score[3]</a><br> 감동+</div>
			<br>
			</div>
			</div></article>";
		
		/*echo "
			<canvas id='radar$data[8]' data-type='Radar' width='250' height='250'></canvas><br>
        <script type='text/javascript'>
            var data$data[8] = {
                labels : ['공감','우와','지식','감동','ㅋㅋ'],
                datasets : [
                    {
                        fillColor : 'rgba(151,187,205,0.5)',
                        strokeColor : 'rgba(151,187,205,1)',
                        pointColor : 'rgba(151,187,205,1)',
                        pointStrokeColor : '#fff',
                        data : [$score[0],$score[1],$score[2],$score[3],$score[4]]
                    }
                ]
            }
        </script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $('#radar$data[8]').each(function(){
                    eval(\"new Chart(this.getContext('2d')).\" + $(this).data('type') + '(data$data[8],options);');
                });
            });
        </script>
        </div>
    </article></div>";*/}	echo "</div>";}?>

<script>
pagerightnow++;
</script>

	