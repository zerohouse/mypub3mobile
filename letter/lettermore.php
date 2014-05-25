<?
include "../php/connect_db.php";
$group = $_POST['group'];
$groupname = $_POST['name'];
$page = $_POST['page'];

$sql = mysql_query("SELECT * FROM user_data  WHERE `id` = '$user_id'");
$user_data = mysql_fetch_array($sql,MYSQL_NUM); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
if ($groupname==null){$groupname="이름없는";}


		


	
// 여기부터 글	

	for ($i=$page*4;$i<$page*4+4;$i++){
	$sql = mysql_query("SELECT * from t_$user_id where `sort` = '$group' order by no desc limit $i, 1"); //no  sort  id  name  talk  score  anony  talk_sort  only_no  date
	$data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT * from user_data where `id` = '$data[2]'"); // no, id, name, passwd, sex, email, date, group, phone, char_url, profile, score, attractive
	$writer_data = mysql_fetch_array($sql,MYSQL_NUM);
	$sql = mysql_query("SELECT `reply`from reply where `only_no` = '$data[8]'");
	$sql = mysql_fetch_array($sql,MYSQL_NUM); // 리플 가져오기
	$reply = explode("|",$sql[0]); // 리플
	$talk = explode("|+|",$data[4]); // 제목 글 분리
	$photo = explode("||", $data[3]);
	$only_no[0] = $data[8];
	$sql = mysql_query("SELECT score from score where `only_no` = '$only_no[0]'"); 
	$sql = mysql_fetch_array($sql,MYSQL_NUM);
	$score = explode("|",$sql[0]);
	
	$leng = mb_strlen($talk[0]); // 길이따른 폰트 크기 지정
	if ( $leng < 100 ){$fs = 8;}
		else if ( $leng < 200 ) {$fs = 7;}
		else if ( $leng < 400) {$fs = 6;}
		else if ( $leng < 600) {$fs = 5;}
		else if ( $leng < 1000) {$fs = 4;}
		else {$fs = 3;}

if ($data[0]!=null){

	echo "
    <article class='letter'>
        <div class=replyonwrap>
                <a class='profileimg' style='background-image: url($writer_data[10])'></a><div class=replywrap><span class=reply>$writer_data[2]</span><br><span class=replydate>$data[9]</span>
            </div></div>";
		
	if ($talk[1]!=null) { //제목 있으면 출력
        echo "<textarea class='title' readonly>$talk[1]</textarea>";}
		
	$cnt = count($photo);
	if ($cnt>1) { //사진 1장이상있으면 출력
	switch($cnt){
	case 2 : $photosize = "95%"; // 0번은 널이라서 1번부터셈. 갯수 = cnt -1
		break;
	case 3 : $photosize = "48%";
		break;	
	case 4 : $photosize = "32%";
		break;
	default : $photosize = "24%";
				}
	
	echo "<p>";
	for ($j=1;$j<$cnt;$j++){
		$photodata = explode(';;',$photo[$j]); // 포토데이터 0 은 포토 1은 썸네일 2는 제목
        echo "<a class=fancybox href=$photodata[0] data-fancybox-group=gallery title=$photodata[2]><img style=width:$photosize src=$photodata[1] alt=></a>
		";}
	echo " </p>";}
	
	if ($talk[0]!=null){ //본문 있으면 출력
        echo "<textarea class='body' readonly>$talk[0]</textarea>";}

	

		$cnt = count($reply);
		$rc = $cnt-1;
	    echo "
		<br><a class='replycall' onclick=toggleID('replybox$data[8]');>댓글 ($rc 개)</a> &nbsp&nbsp&nbsp | &nbsp&nbsp <a class='replycall' onclick=toggleID('easing$data[8]');>Feeling?!</a><div class=replybox style='display:none'; id=replybox$data[8]>";
		
		if($reply[1]!=null){
		for ($j=1;$j<$cnt;$j++) {		
		$replydata = explode("&*$",$reply[$j]); // 익명/실명 , 이름 , ID, 내용, 데이트
		$sql = mysql_query("SELECT `profile`from user_data where `id` = '$replydata[2]'");
		$profile = mysql_fetch_array($sql,MYSQL_NUM); // 리플작성자 프로필 가져오기
		echo "
        <div class=replyonwrap>
            <a class='profileimg' style=\"background-image: url($profile[0])\"></a><div class=replywrap><a class=replydate>$replydata[1] $replydata[4]</a><textarea class=reply readonly>$replydata[3]</textarea>
        </div></div>";}}
		
		echo "
        <div class=replyonwrap >
                <a class='profileimg' id='anonyimg$only_no[0]' onclick='replyToggle($only_no[0])' style='background-image: url($user_data[10])'></a><div class=replywrap><span id='anony$only_no[0]' class=reply>$user_data[2]</span> : <input id='replywriteform$only_no[0]' class=makereply type='text' placeholder='댓글을 남겨주세요^-^' onKeyDown='javascript:if (event.keyCode == 13) writeReply(replybox$only_no[0], $only_no[0], replywriteform$only_no[0], anony$only_no[0]);'>
            </div></div></div>"; // 글끝
		
		
		
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

	