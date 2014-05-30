groupnumbernow = 0;
anonymousval=0;
pagerightnow = 0;
sendto = "";
pubformnumber = 0;
replanony=0;
onthemenupan = 0;
addid = '';
delno =0;
$(function() {
	
windowheight=$(window).height();
	$('#mainpage').scrollPagination();
	
	require("boot");
	$('.writebody').autosize();
    $('textarea').each(function() {
        $(this).css("height",$(this).prop('scrollHeight'));
    });
	$(".writeformwrap").hide();
    $(".popup").hide();
	$("#loading").hide();

    $('#more').click(function(){
        $(this).toggleClass("moreclicked")
    });
	$('#mainpage').click(function(){
    $(".popup").hide();
    });	
	$('#groupset').not(".newpubs").click(function(){
    $(".newpubs").hide();
    });	
	$('#groupset').click(function(){
    $(".popup").hide();
    });	
	$("#groupset").hide();
	
	
	
	  // Bind the swipeleftHandler callback function to the swipe event on div.box
   $( "#mainpage" ).on( "swipeleft", swipeleftHandler );
   $( "#mainpage" ).on( "swiperight", swiperightHandler );
   

  // Callback function references the event target and adds the 'swipeleft' class to it
swipeLetter(groupnumbernow);
});





function showID(showid) {
    $('#'+showid).show();
}
function hideID(hideid){
    $('#'+hideid).hide();
}
function toggleID(toggleid){
        $('.popup').not('#'+toggleid).hide();
        $('#'+toggleid).toggle();
}
function togglePOPUP(toggleid){
        $('.popup').not('#'+toggleid).hide();
        $('#'+toggleid).toggle();
}

function toggleAnonymous(){
if (anonymousval==0){ anonymousval=1;
	$("#profiletoggle").css("background-image","url('icon/anony.png')");
	$("#username").text("익명");}
else{ anonymousval=0;
	$("#profiletoggle").css("background-image","url('"+$user_profile+"')");
	$("#username").text($user_name);}
}

function writeLetter(){
		var sendwr = groupnumberfor[groupnumbernow];
if (groupnumbernow==100){sendwr = sendto;groupnumbernow=0; }
if (pagetypearray[groupnumbernow]==1){sendwr=groupnumberfor[groupnumbernow]+"||2";}

		var title = $("textarea#newtitle").val();
		var text = $("textarea#newbody").val();

				$.ajax({
                        type: "POST",
                        url: "php/board_insert.php",
                        data: {head : title, body: text, anony : anonymousval, 			pagesort: sendwr},
                        success: function(response) {		
						$("textarea#newtitle").val("");
						$("textarea#newbody").val("");
						$("#my-dropzone").html("")
						$("#wirtesomething").hide();
						alert(response);
						swipeLetter(groupnumbernow);
						}});
	}
	
function callgroupSET(){
$("#groupset").show();
$("#mainpage").hide();
$(".popup").hide();
}	

function findFriends() {
       $(".popup").hide();
	  $( "#about" ).show();
                var form_data = {
                        find_id: $("#sch").val(),
                        pagesort: groupnumbernow
                };
                $.ajax({
                        type: "POST",
                        url: "php/frsch.php",
                        data: form_data,
                        success: function(response) {
                           $("#about").html(response);
                        }
                });
                return false;
}

function scorePlus($scoretype, $onlynoscore)	{
  $.ajax({              type: "POST",
                        url: "php/scoreplus.php",
                        data: {type: $scoretype, onlyno : $onlynoscore},
                        success: function(response) {
						swipeLetter(groupnumbernow, 'easing'+$onlynoscore);

					}});
  }
   //점수올리기

   
   
   
			
	function swipeleftHandler(){
  groupnumbernow++;
  direction = 1;
  if(groupnumbernow>90){groupnumbernow=0;}
  if(groupnumbernow>groupcnt-1){groupnumbernow=0;}
  swipeLetter(groupnumbernow);

  }
    function swiperightHandler(){
	groupnumbernow--;
	direction = 2;
	if(groupnumbernow>90){groupnumbernow=0;}
	if(groupnumbernow<0){groupnumbernow=groupcnt-1;}
	swipeLetter(groupnumbernow);

  }
			
			
			
			
			
function swipeLetter($group, $showingid, $hisid){

sendto = groupnumberfor[$group];
groupnumbernow = $group;
if ($group == 100){
sendto = $hisid+'||1';
$group=0;
groupnumbernow = 100; // 누군가의 페이지.
}
if (pagetypearray[$group]==1){
sendto = groupnumberfor[$group]+'||2';
}


			$("#groupset").hide();
			$("#mainpage").show();
			pagerightnow = 0;
						
			var leftgroup = $group-1;
			var rightgroup = $group+1;
			var rightgroup2 = $group+2;
			
			switch ($group){
			case groupcnt-1:
			rightgroup = 0;
			rightgroup2 = 1;
			break;
			case groupcnt-2:
			rightgroup2 = 0;
			break;
			case 0:
			leftgroup=groupcnt-1;
			break;
			}
			$("#mainpage").hide();
			$("#loading").show();
						$.ajax({
                        type: "POST",
                        url: "letter/letter.php",
                        data: {group : sendto, name: groupnameajax[$group]}, // groupname 수정
                        success: function(response) {		
						if (response){
						/*if (direction==1){
						$("#mainpage").toggle("slide", { direction: "left" });
						$("#mainpage").html(response);
						$("#mainpage").show("slide", { direction: "right" });}
						if (direction==2){
						$("#mainpage").toggle("slide", { direction: "right" });*/
						
						$("#mainpage").html(response);
						$("#mainpage").show();
						$("#loading").hide();
						$("#"+$showingid).show();
						/*$("#mainpage").toggle("slide", { direction: "left" });}*/
						}
					}});
					$(".menu").hide();
					$(".menu").css("color","#777777");
					$(".hiddenmenu").css("color","#777777");
					$(".menu").css("border-bottom","0px");
					$(".hiddenmenu").css("border-bottom","0px");
					$(".menu").css("padding-bottom","4px");
					$(".hiddenmenu").css("padding-bottom","4px");
					$("#menu"+$group).css("color","#"+groupcolorshow[$group]);
					$("#menu"+$group).css("border-bottom","4px solid #"+groupcolorshow[$group]);
					$("#menu"+$group).css("padding-bottom","0px");
					$("#menu"+$group).css("width","40%");
					$("#menu"+rightgroup2).css("width","20%");
					$("#menu"+leftgroup).css("width","20%");
					$("#menu"+rightgroup).css("width","20%");
					$("#menu"+$group).css("margin-left","20%");
					$("#menu"+rightgroup2).css("margin-left","80%");
					$("#menu"+leftgroup).css("margin-left","0");
					$("#menu"+rightgroup).css("margin-left","60%");
					$("#menu"+$group).toggle();
					$("#menu"+leftgroup).toggle();
					$("#menu"+rightgroup).toggle();
					$("#menu"+rightgroup2).toggle();
}




function openNEWpub($newpubnumber){
pubformnumber = $newpubnumber;
$("#newpub" + $newpubnumber).show();
				$.ajax({
                        type: "POST",
                        url: "pub/pub.html",
                        data: {},
                        success: function(response) {		
						$("#newpub" + $newpubnumber).html(response);
						
						}});


}



function writeReply($replyid, only, $textid, $anonyreply) {
						var replytext = $($textid).val();
						if (replytext==""){alert("댓글을 입력해주세요");
						}
						else{
						var anonyreply = $($anonyreply).text();
						$.ajax({
                        type: "POST",
                        url: "letter/writereply.php",
                        data: {onlyno: only, reply: replytext, anony: replanony},
                        success: function(response) {
						alert(response);
						$($replyid).append(response);
						$textid.value="";
					}});}
        } 
		
function delReply(delonlyno, delno) {
						$.ajax({
                        type: "POST",
                        url: "letter/delreply.php",
                        data: {onlyno: delonlyno, no: delno},
                        success: function(response) {
							$page=1;
							$.ajax({
								type: "POST",
								url: "letter/letter.php",
								data: {pagesort: $pagesort,page: $page},
								success: function(response) {	
								$("#mainpage").html(response);
								$now = $pagesort;
							}});
					}});
        } 
		
function replyToggle($identify) {
		if (replanony==0){
		
		replanony=1;
		document.getElementById("anony"+$identify).innerHTML="익명";
		$("#anonyimg"+$identify).css("background-image","url(icon/anony.png)");
        } else {
		replanony=0;
		document.getElementById("anony"+$identify).innerHTML=$user_name;
		$("#anonyimg"+$identify).css("background-image","url("+$userprofile+")");
		}}
		

function showGroupForm(){
for (var i = 0; i < 10; i++) {
	if (i-1<groupon){
   $("#group"+i).show();}
	
	if (gonmenupan[i]!=0){
   gonmenupan[i]=0;
   toggleGroupMenupan(i);
   }
}
}

function showPubForm(){
for (var i = 0; i < 10; i++) {
	if (ponmenupan[i]!=0){
	ponmenupan[i]=0;
   $("#pub"+i).show();
   togglePubMenupan(i);
   }
}
}

	
function addGroup(){
if (groupon < 10){
$("#group"+groupon).show();
groupon++;}
}

function delGroup(){
if (groupon > -1){
$("#group"+groupon).hide();
groupon--;
}
}

function addPub(){
if (pubon < 10){
$("#pub"+pubon).show();
pubon++;}
}

function delPub(){
if (pubon > -1){
$("#pub"+pubon).hide();
pubon--;
}
}


function groupSettingJUKYONG(){
	var pubdata="";
	var groupdata="";
	for (var i = 0; i < 10; i++) {
	pubdata = pubdata + $("#p"+i).val() + ";+;" + $("#p"+i+"c").val() + "|+|";
	}
	
	for (var i = 0; i < 10; i++) {
	$("#g"+i).val()
	$("#g"+i+"c").val()
	groupdata = groupdata + $("#g"+i).val() + ";+;" + $("#g"+i+"c").val() + "|+|";
	}

	var menupan = $("#menupan").sortable("toArray");
	
					$.ajax({
                        type: "POST",
                        url: "php/pubsetting.php",
                        data: {pub : pubdata, group: groupdata, menu : menupan, pubids : pubid},
                        success: function(response) {
						alert("그룹설정이 변경되었습니다.");
						location.reload();
						}});

	
}


function toggleGroupMenupan($number){ // 메뉴판에 애드 / 리무브 (그룹)
if (gonmenupan[$number]==0){
	if (onthemenupan>10){alert('메뉴판에 최대 10개까지 등록할 수 있습니다.'); return;}
onthemenupan++;
var sgname = $("#g"+$number).val();
gonmenupan[$number]=1;
var $n = $number +1;
if(sgname ==""){sgname = "이름없음";}
$("#menupan").append("<div onclick='toggleGroupMenupan("+$number+")' class=onmenupan id='gm"+$number+"'><font color=#777777 size=2>그룹"+$n+"</font><br>"+sgname+"</div>")
$("#g"+$number+"ck").css("background-image","url(icon/checked.png)");}
else {
	if (onthemenupan<5){alert('메뉴판은 최소 4개가 필요합니다.'); return;}
onthemenupan--;
$("#g"+$number+"ck").css("background-image","none");
$("#gm"+$number).remove();
gonmenupan[$number]=0;}
}


function togglePubMenupan($number){ // 메뉴판에 애드 / 리무브 (pub)
if (ponmenupan[$number]==0){
	if (onthemenupan>9){alert('메뉴판에 최대 10개까지 등록할 수 있습니다.'); return;}
	onthemenupan++;

var sgname = $("#p"+$number).val();
ponmenupan[$number]=1;
var $n = $number +1;
if(sgname ==""){sgname = "이름없음";}
$("#menupan").append("<div  onclick='togglePubMenupan("+$number+")' class=onmenupan id='pm"+$number+"'><font color=#777777 size=2>PUB"+$n+"</font><br>"+sgname+"</div>")
$("#p"+$number+"ck").css("background-image","url(icon/checked.png)");}
else {
	if (onthemenupan<5){alert('메뉴판은 최소 4개가 필요합니다.'); return;}
	onthemenupan--;

$("#pm"+$number).remove();
ponmenupan[$number]=0;
$("#p"+$number+"ck").css("background-image","none");}
}

function delNo($delno){
delno = $delno;
}

function friendOK($friendid)	{
						$( "#friendswhere" ).appendTo( "#new"+$friendid );;
						$( ".newfriends").not( "#new"+$friendid ).hide();
						$("#friendswhere").show();
						$( "#new"+$friendid).toggle();
						addid=$friendid;
					}
					
function addFriends($sort){
location.replace('php/fr_ok.php?id='+addid+'&sort='+$sort+'&no='+delno);
}

function friendReq($friend, $sort) {


  				$.ajax({
                        type: "POST",
                        url: "php/req.php",
                        data: {id: $friend, sort: $sort},
                        success: function(response) {
							alert(response);
								
							}});							
					
					}

        
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }