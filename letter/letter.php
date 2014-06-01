<?
include "../php/connect_db.php";
$group = $_POST['group']; // 타입으로 나눠서 소팅해야댐.
$groupname = $_POST['name'];
$page = $_POST['page'];

$type = explode('||',$group);
$sql = mysql_query("SELECT * FROM user_data  WHERE `id` = '$user_id'");
$user_data = mysql_fetch_array($sql,MYSQL_NUM); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
if ($groupname==null){$groupname="이름없는";}
if ($type[1]==1){


echo "<div id='topblock'></div>
<iframe class=myframe scrolling='no'  onload='javascript:resizeIframe(this);' src='mypage/mypage.html?id=$type[0]'>
</iframe><div class=wrapping>";
/*<div class=bottom>
	<div class=omenuwrap>
	<div class=omenu>메뉴</div>
	<div class=omenu>메뉴</div>
	<div class=omenu>메뉴</div></div></div>*/

		


	


}else if ($type[1]==2){

		echo "
		<div class=wrapping>
		<div id='topblock'></div>
            <div id='namewrap'>
               $user_data[2]님 안녕하세요. <font style=font-family:dek>Pub</font> {$groupname}입니다.
            </div>        "; // 인사말


}else{

		echo "
		<div class=wrapping>
		<div id='topblock'></div>
            <div id='namewrap'>
               $user_data[2]님 안녕하세요. $groupname 그룹입니다. $friends[0]<a class=viewfriends onclick=toggleID('friends')> 친구보기 </a>
            </div>
        "; // 인사말
		echo "<div id=friends>";
		$sql = mysql_query("SELECT count(fr_id) FROM g_$user_id  WHERE `sort` = '$type[0]'");
		$frcnt = mysql_fetch_array($sql,MYSQL_NUM);
		if ($frcnt[0]==0){
		echo "<div class=movefr>이 그룹에 친구가 없습니다.</div>";
		}
		for ($i=0;$i<$frcnt[0];$i++){
		$sql = mysql_query("SELECT fr_id FROM g_$user_id  WHERE `sort` = '$type[0]' order by no desc limit $i,1");
		$friends = mysql_fetch_array($sql,MYSQL_NUM);
		$sql = mysql_query("SELECT name FROM user_data  WHERE `id` = '$friends[0]'");
		$friendsname = mysql_fetch_array($sql,MYSQL_NUM);

		echo "<div class=movefr onclick=friendMove('$friends[0]')>$friendsname[0]($friends[0])</div><div class=movefriends id=move$friends[0]></div>";}
		echo "</div>";
		
}
		

//여기부터 글컨테이너.
echo "
<div id='container'>
";

	
// 여기부터 글	

	for ($i=0;$i<4;$i++){
	
	if($type[1]==1){
	
	
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

	}else if($type[1]==2){
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

	}else{
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
		$f="";
				if ($data[6]==1){
				$writer_data[10] = "icon/anony.png";
				$writer_data[2] = "익명";
				$f="return false;";
				} //익명 체크
		
		
if ($data[0]!=null){

	echo "
    <article class='letter'>";
				if ($data[2]==$user_id){echo "<a id=mod$only_no[0] onclick='modLetter($only_no[0])' class=mod></a>";}

		

				
	if($type[1]!=2){
    echo "    <div class=replyonwrap>
                <a class='profileimg' style='background-image: url($writer_data[10])'></a><div class=replywrap><span onclick=\"{$f}swipeLetter(100, 0, '$data[2]')\" class=reply>$writer_data[2]</span><br><span class=replydate>$data[9]</span>";
				

				
        echo "</div></div>";}
		
	echo "<div id=edit$only_no[0]>"; //수정 에디터블
		
		echo "$data[4]";

	echo "</div>"; //수정 에디터블
	
	echo "<div id=editbtn$only_no[0]></div>"; //수정버튼 에디터블
	
	
	
	
	
		$onscore = $score[0] + $score[1] + $score[2] + $score[3] + $score[4];
		$cnt = count($reply);
		$rc = $cnt-1;
	    echo "
		<div class='replycall' onclick=toggleID('replybox$data[8]');><a id=comments$data[8]>{$rc}</a> comments</div><div class='feelingcall' onclick=toggleID('easing$data[8]');><a id=points$data[8]>{$onscore}</a> points</div>";
		
		if($type[1]==2){echo "<div class='writercall' onclick=toggleID('writerinfo$data[8]')>writer</div>";}
		
		echo "<div class=replybox id=replybox$data[8]>";
		

		
		
		
		
		
		
		if($reply[1]!=null){
		for ($j=1;$j<$cnt;$j++) {		
		$replydata = explode("&*$",$reply[$j]); // 익명/실명 , 이름 , ID, 내용, 데이트
		$sql = mysql_query("SELECT `profile`from user_data where `id` = '$replydata[2]'");
		$profile = mysql_fetch_array($sql,MYSQL_NUM); // 리플작성자 프로필 가져오기	
		
				$f='';
				if ($replydata[0]==1){$profile[0]= "icon/anony.png";$replydata[1]="익명";$f="return false;";}//리플 익명첵
				
				

		echo "
        <div class=replyonwrap>
            <a class='profileimg' style=\"background-image: url($profile[0])\"></a><div class=replywrap><a class=replydate onclick=\"{$f}swipeLetter(100, 0, '$replydata[2]')\">$replydata[1] $replydata[4]</a><div class=reply>$replydata[3]";
			
			
			
			if ($replydata[2]==$user_id){ echo "<a class=delreply>삭제<a>";}
			
			echo "</div>
        </div></div>";}}
		
		echo "
                <div class=replyonwrap >
                <a class='profileimg' id='anonyimg$only_no[0]' onclick='replyToggle($only_no[0])' style='background-image: url($user_data[10])'></a><div class=replywrap><span id='anony$only_no[0]' class=reply>$user_data[2]</span> : <input id='replywriteform$only_no[0]' class=makereply type='text' placeholder='댓글을 남겨주세요^-^' onKeyDown='javascript:if (event.keyCode == 13) writeReply(replybox$only_no[0], $only_no[0], replywriteform$only_no[0], anony$only_no[0]);'>
            </div></div></div>"; // 글끝
		

		
		
		
		
		
		
		
		if($type[1]==2){
						
		
		echo "<div id=writerinfo$data[8] style=display:none> <div class=replyonwrap>
                <a class='profileimg' style='background-image: url($writer_data[10])'></a><div class=replywrap><span onclick=\"swipeLetter(100, 0, '$data[2]')\" class=reply>$writer_data[2]</span><br><span class=replydate>$data[9]</span>
				
				
				
				
            </div></div></div>";}
		
		
        echo "
        <div class='easing' id='easing$data[8]'>
            <br><br>
            <a class='pointbtnsym' onclick='scorePlus(4, $only_no[0]);'>공감+</a><a class='pointbtnwow' onclick='scorePlus(0, $only_no[0]);'>우와+</a><a class='pointbtnwow' onclick='scorePlus(1, $only_no[0]);'>지식+</a><a class='pointbtnwow' onclick='scorePlus(2, $only_no[0]);'>감동+</a><a class='pointbtnhum' onclick='scorePlus(3, $only_no[0]);'>ㅋㅋ+</a><br>
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
    </article>";}}?>
	
<div id=morebtn style='cursor:hand' onclick='ajaxMore();'>더보기</div>
</div>
</div>
<script type="text/javascript">
$(function() {
$(".replybox").hide();
$(".easing").hide();


$(".popup").hide();

});
replanony=0;

//$('.mod').fixer({gap: 100});

</script>


<div id=mod>
<ul>
<li onclick='editThis();'>수정</li>
<li onclick='del_confirm();'>삭제</li>
</ul>
</div>

