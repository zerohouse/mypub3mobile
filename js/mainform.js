groupnumbernow = 0;
anonymousval=0;
pagerightnow = 0;
sendto = "";
pubformnumber = 0;
replanony=0;
onthemenupan = 0;
addid = '';
schurl = '';
delno =0;
onlynomod = 0;
schnow = 0;
busy=false;
notswipe=false;
mini=false;
odd = 0;


friend='';
friendset = false;
$(function() {
$('#first').css('margin-top',$('#topmenuwrap').height());
//	$('#toptogglemenu').scrollUpMenu({'transitionTime': 200});
hideID('switch'); 
	windowheight=$(window).height();
	$('#mainpage').scrollPagination();
	
	require("boot"); //드롭존 부트
	
	$('textarea').autosize();
	/*
    $('textarea').each(function() {
        $(this).css("height",$(this).prop('scrollHeight'));
    });*/
	
    $(".popup").hide();
	$("#loading").hide();
	
	$("#showit").click(function(){
	if (stop!=true) {
	reShow();
	}	
	});	
	
	$('body').click(function(){
    $("#mod").hide();
	$(".popup").hide();
				if ($( "#more" ).attr("toggle")==0){
   				$( "#more" ).animate({	opacity: 0.3}, 500 );
				$( "#more" ).attr("toggle","1");
   				}
	
	$("#friendsmove").hide();
    });	
	
	$('#groupset').not(".newpubs").click(function(){
    $(".newpubs").hide();
    });	
	$('#groupset').click(function(){
    $(".popup").hide();
    });	
	$("#groupset").hide();
	
	
	  // Bind the swipeleftHandler callback function to the swipe event on div.box

   $( "body" ).on( "swipeleft", swipeleftHandler );
   $( "body" ).on( "swiperight", swiperightHandler );


  // Callback function references the event target and adds the 'swipeleft' class to it
swipeLetter(groupnumbernow);

    $( "#switch" ).draggable({
      start: function() {
	  notswipesave=notswipe;
	  /*if (notswipe==false){
		
		swipeState('swipepin');
		
		}*/ //모바일에선 체크 못함..ㅜㅜ
	  
      },
      drag: function() {
	  
      },
      stop: function() {
	  /*if (notswipesave==false){
		swipeState('swipepin')
		
		}*/ //모바일에선 체크 못함..ㅜㅜ
		
		stop =true;
		setTimeout(function(){stop =false}, 1000);
		
      }
    } 
	
	);

	
	
	

/*var timeout_id = 0;

 $('#topmenuwrap').mousedown(function() {
    timeout_id = setTimeout(menuMinimalize, 1000);
}).bind('mouseup mouseleave', function() {
    clearTimeout(timeout_id);
});*/ //for pc

  $("#topmenuwrap").on("taphold",function(){
	menuMinimalize();
  });      
  
  /*$("#swipepin").on("tap",function(){
	swipeState('swipepin')
	event.stopPropagation();

  });     
  $("#groupname").on("tap",function(){
	
	if (mini==true){menuboxOnly();}
	else{setTopToggle('menubox')}

  });       */ //for mobile


});
function menuMinimalize(){
showID('switch');
hideID('toptogglemenu');
$("#swipepin").appendTo("#swipemini");
$("#groupname").appendTo("#gnamemini");
$("#swipepin").css("position","relative");
$("#groupname").css("position","relative");
$("#swipepin").css("right","");
$("#groupname").css("margin-left","0");
$("#groupname").css("margin-left","0");
$("#groupname").attr("onclick","menuboxOnly()");
mini=true;
}
function reShow(){
if (stop==true){return false;}
hideID('switch');
showID('toptogglemenu');
showID('topmenu');
$("#swipepin").appendTo("#spinwhere");
$("#groupname").appendTo("#gnamewhere");
$("#swipepin").css("position","absolute");
$("#groupname").css("position","absolute");
$("#swipepin").css("right","50");
$("#groupname").css("margin-left","60");
$("#groupname").attr("onclick","setTopToggle('menubox')");
mini=false;
}


function showID(showid, seffect, sduration) {
    $('#'+showid).show(seffect, sduration);
}
function hideID(hideid, effect, duration){
    $('#'+hideid).hide(effect, duration);
}

function removeID($id)
{
$('#'+$id).remove();

}

function menuboxOnly(){

odd++;
if (odd==2){odd=0;return false();} //모바일을 위한 더블 클릭 체크 => 모바일은 드래그시 클릭이벤트 발생하여 터치따라가기 떔에 두번 클릭 일어나는듯..

showID('toptogglemenu');
hideID('topmenu');
toggleID('menubox');
$('#first').css('margin-top',$('#menubox').height());


}

function setTopToggle(ttt){

$('#'+ttt).toggle();
$('#first').css('margin-top',$('#topmenuwrap').height());
}

function toggleID(toggleid, effect, duration){
        $('.popup').not('#'+toggleid).hide();
       if (effect)
	   {$('#'+toggleid).toggle(effect, duration);}
	   else{
	   $('#'+toggleid).toggle("blind",500);}
		event.stopPropagation();

}

function callAdds($idofcall, $typeofcall){
switch ($typeofcall)
{ case 1: $("#"+$idofcall).toggleClass("replytoggle");break;
case 2: $("#"+$idofcall).toggleClass("feelingtoggle");break;
case 3: $("#"+$idofcall).toggleClass("writertoggle");break;
}
$("#"+$idofcall).addClass();
}

function togglePOPUP(toggleid){
        $('.popup').not('#'+toggleid).hide();
        $('#'+toggleid).toggle();
		event.stopPropagation();
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
		
		
		$("#writeschvalue").remove();
		$(".removethis").replaceWith("<div class=plus></div>");
		$(".moviewrap").attr("onclick","");
		$( "#schtitlearea" ).replaceWith( "<div class=title>" + $( "#schtextarea" ).val() + "</div>" );
		$( "#schtextarea" ).replaceWith( "<div class=body>" + $( "#schtextarea" ).val() + "</div>" );
		$(".moviewrap").each(function(){
		$(this).attr("id","");});

		var schwrite = $("#writeforsch").html();
		
				$.ajax({
                        type: "POST",
                        url: "php/board_insert.php",
                        data: {head : title, body: text, anony : anonymousval, 			pagesort: sendwr, cards:schwrite},
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
$("#writespin").css("opacity","0.3");
$("#groupset").show();
$("#mainpage").hide();
$("#wirtesomething").hide();
$("#first").hide();
$(".popup").hide();
}

function callfriendsSET(){
friendset = true;
busy=true;
$("#writespin").css("opacity","0.3");
$("#groupset").hide();
$("#wirtesomething").hide();
$("#first").html("<br>");
$("#first").show();
$(".popup").hide();

				$.ajax({
                        type: "POST",
                        url: "mypage/friends.php",
                        data: {},
                        success: function(response) {
						
						$("#mainpage").html(response);
						$("#mainpage").show();
						existOnly();
						}});





}		
	

function findFriends() {
       $(".popup").hide();
	  $( "#about" ).show();
	  friend = $("#sch").val();
                $.ajax({
                        type: "POST",
                        url: "php/frsch.php",
                        data:  {find_id: friend},
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
                        success: function(points) {
						$("#points"+$onlynoscore).text(points);
														$.ajax({
								type: "POST",
								url: "letter/pointrefresh.php",
								data: {onlyno: $onlynoscore},
								success: function(response) {
								$("#easing"+$onlynoscore).html(response);

		
						
								}});
							
						
						

					}});
  }
   //점수올리기

      function swipeState($idb){
	  if (mini==true){
	  odd++;
if (odd==2){odd=0;return false();}} //모바일을 위한 더블 클릭 체크 => 모바일은 드래그시 클릭이벤트 발생하여 터치따라가기 떔에 두번 클릭 일어나는듯.. PC에선 두번눌러야댐.시발..ㅜㅜ
	  
	  
   if ($( "#"+$idb ).attr("toggle")==0){
     notswipe=false;

   $( "#"+$idb ).animate({
  opacity: 1

	}, 200 );
   $( "#"+$idb ).attr("toggle","1");}
   else{
     notswipe=true;
   $( "#"+$idb ).animate({
  
  opacity: 0.3
}, 200 );
   $( "#"+$idb ).attr("toggle","0");}
   }
   
   
   
   function toggleState($idb){
   if ($( "#"+$idb ).attr("toggle")==0){
   
   $( "#"+$idb ).animate({
  
  opacity: 0.3
}, 200 );
   $( "#"+$idb ).attr("toggle","1");
   
   
   }
   else{
   
      $( "#"+$idb ).animate({
  
  opacity: 1
}, 200 );
   $( "#"+$idb ).attr("toggle","0");
}
   }
   

   function writeSpin(){
	
   $("body").scrollTop("0");
   }

   
			
			
			
			
	function swipeleftHandler(){
	if (notswipe==true)
	{
	return false;
	}
	
  groupnumbernow++;
  direction = 1;
  if(groupnumbernow>90){groupnumbernow=0;}
  if(groupnumbernow>groupcnt-1){groupnumbernow=0;}
  swipeLetter(groupnumbernow);

  }
    function swiperightHandler(){
	
		if (notswipe==true)
	{
	return false;
	}
	
	groupnumbernow--;
	direction = 2;
	if(groupnumbernow>90){groupnumbernow=0;}
	if(groupnumbernow<0){groupnumbernow=groupcnt-1;}
	swipeLetter(groupnumbernow);

  }
			
			
			
			
			
function swipeLetter($group, $showingid, $hisid, $hisname){
friendset = false;
busy=false;
sendto = groupnumberfor[$group];
groupnumbernow = $group;
$("#friendsmove").appendTo("#save");
if ($group == 100){
sendto = $hisid+'||1';
$group=0;
groupnumbernow = 100; // 누군가의 페이지.
}
if (pagetypearray[$group]==1){
sendto = groupnumberfor[$group]+'||2';
}
			$("#groupset").hide();

			$("#first").hide();
			$("#first").show();
			$("#wirtesomething").hide();
			$( "#writespin" ).css("opacity", "0.3");
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

						$("#first").html(response);
						$("#first").show();
						if (groupnumbernow==100){
						   $( "#writespin" ).animate({opacity: 0.3}, 500 );
						}
						else{
						$( "#writespin" ).animate({opacity: 1}, 500 );
						$("#wirtesomething").show();
						}
						$("#loading").hide();
						$("#mainpage").html("");
						$("#mainpage").show();
						$("#"+$showingid).show();

						}
					}});
					//$(".menu").hide();
					$(".menu").css("color","#777777");
					$(".hiddenmenu").css("color","#777777");
					$(".menu").css("border-bottom","0px");
					$(".hiddenmenu").css("border-bottom","0px");
					$(".menu").css("padding-bottom","4px");
					$(".hiddenmenu").css("padding-bottom","4px");
					$("#menu"+$group).css("color","#"+groupcolorshow[$group]);
					$("#gline").css("background-color","#"+groupcolorshow[$group]);
					$("#menu"+$group).css("border-bottom","4px solid #"+groupcolorshow[$group]);
					$("#menu"+$group).css("padding-bottom","0px");
					$('#first').css('margin-top',$('#topmenuwrap').height());
					
					var ggname;
					if (pagetypearray[$group]==1)
					{
					ggname = "Pub"+ groupnameajax[$group];
					}
					else if($hisid==$user_id)
					{
					ggname= "마이페이지";
					}
					else if (groupnumbernow == 100){
					
					     $.ajax({
                        type: "POST",
                        url: "php/getname.php",
                        data:  {id: $hisid},
                        success: function(response) {
						var textss = response;
						ggname = textss+"님의 페이지";	
						$("#groupname").text(ggname);
						}
					
                        });
								
					

					}
					else{					
					ggname = groupnameajax[$group];}
					if (groupnameajax[$group]=='')
					{ggname = "이름없는 그룹";}
					
					
					$("#groupname").text(ggname);
					ajaxMore();

}


function existOnly(){
$( ".frwrap" ).each(function( index ) {
 if ( $( this ).find( '.movefr' ).length ==0 )
 {
 $(this).hide();
 }
 else{$(this).show();}
 
 
});

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
								
								$.ajax({
								type: "POST",
								url: "letter/replyrefresh.php",
								data: {onlyno: only},
								success: function(response) {
								$($replyid).html(response);
								var comments = $("#comments"+only).text();
								comments++;
								$("#comments"+only).text(comments);
						
								}});
								
								
					}});}
        } 
		
function delReply(delonlyno, delno) {
if (confirm("삭제하시겠습니까?")){
						$.ajax({
                        type: "POST",
                        url: "letter/delreply.php",
                        data: {onlyno: delonlyno, no: delno},
                        success: function(response) {

														$.ajax({
								type: "POST",
								url: "letter/replyrefresh.php",
								data: {onlyno: delonlyno},
								success: function(response) {
								$("#replybox"+delonlyno).html(response);
								var comments = $("#comments"+delonlyno).text();
								comments--;
								$("#comments"+delonlyno).text(comments);
						
								}});
						
					}});
					
					
				}
        } 
		
function replyToggle($identify) {
		if (replanony==0){
		
		replanony=1;
		document.getElementById("anony"+$identify).innerHTML="익명";
		$("#anonyimg"+$identify).css("background-image","url(icon/anony.png)");
        } else {
		replanony=0;
		document.getElementById("anony"+$identify).innerHTML=$user_name;
		$("#anonyimg"+$identify).css("background-image","url("+$user_profile+")");
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
						$( "#new"+$friendid).toggle("blind",500);
						addid=$friendid;
							event.stopPropagation();

					}

function friendMove($friendid)	{
						$( "#friendsmove" ).appendTo( "#move"+$friendid );;
						$( ".movefriends").not( "#move"+$friendid ).hide();
						$("#friendsmove").show();
						$( "#move"+$friendid).toggle();
						addid=$friendid;
					event.stopPropagation();
					}
					
function friendMoveAllgroup($friendid)	{
						$( "#groupall" ).appendTo( "#move"+$friendid );;
						$( ".movefriends").not( "#move"+$friendid ).hide();
						$("#groupall").show();
						$( "#move"+$friendid).toggle();
						addid=$friendid;
					event.stopPropagation();
					}
					
function addFriends($sort, $groupname){
var am = "";
if ($groupname==''){
$groupname="이름없는 그룹";
}
$.ajax({
                        type: "POST",
                        url: "php/fr_ok.php",
                        data: {id: addid, sort: $sort, no: delno},
                        success: function(response) {
						
						if(friendset == false){
							if ($sort!=50)
							{
							am = $groupname+"의 멤버가 되었습니다.";}
							else{
							am = "무인도로 갔습니다.";
							$sort=groupnumbernow;
							}
							alert(response + am);
							$("#nn"+addid).hide();
							$("#friendswhere").hide();
							swipeLetter($sort);
						}
						else{
						$("#go"+addid).appendTo("#friends" + $sort );
						existOnly();
						
						
						
						}
							
							
							
							}});							

}





function friendReq() {
var $gn;
if (groupnumbernow!=100)
{$gn=groupnumbernow;}
else{$gn=0;
}
if (pagetypearray[$gn]==1)
{
$gn = 0;
}

  				$.ajax({
                        type: "POST",
                        url: "php/req.php",
                        data: {id: friend, sort: $gn},
                        success: function(response) {
						
						if (response==100)
						{alert("이미 친구입니다.");}
						else if (response==200)
						{alert("친구 요청 대기중입니다!");}
						else if (response==300)
						{alert("알림을 눌러보세요. 상대가 먼저 친구요청했어요.");}
						else if (groupnameajax[response] ==""){
						$gn++;
						alert("이름없는 그룹" + $gn +"(으)로 친구요청 하였습니다.");
						}
						else{
						$gn = groupnameajax[response];
						alert($gn +"그룹으로 친구요청 하였습니다.");}
								
							}});							
					
					}

        
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight-20 + 'px';
  }
  
function ajaxMore() {
if (busy==true){
return false; 
}

									busy = true;
				$('#mainpage').append("<div id=moreloading><img src=icon/preloader.gif></div>");
				
				 	$.ajax({
                        type: "POST",
                        url: "letter/lettermore.php",
                        data: {group : sendto,	page : pagerightnow},
                        success: function(data) {
						
					if(data.length < 100) { 
					
					$('#morebtn').remove();
					$('#mainpage').append("<div id=morebtn>마지막페이지입니다.</div>");
					$('#moreloading').remove();
					busy = true;
					}
					
					else {
			
					$('#mainpage').append(data);
					$('#morebtn').remove();
					$('#moreloading').remove();
					$('#mainpage').append("<div id=morebtn style='cursor:hand' onclick='ajaxMore();'>더보기</div>");
					}						busy = false;
							}});								
					
					}

				
function modLetter($onlynumber){
		$("#mod").appendTo("#mod"+$onlynumber);
		$("#mod").show();
		onlynomod = $onlynumber;
	event.stopPropagation();
}
					
					
function del_confirm() {
if (confirm("삭제하시겠습니까?")){
  				$.ajax({
                        type: "POST",
                        url: "php/del.php",
                        data: {no: onlynomod},
                        success: function(response) {
						alert(response);
						if(groupnumbernow==100){groupnumbernow=0;}
						swipeLetter(groupnumbernow);


					}}); 
  
}}

function cancelMod() {
$("#editbtn"+onlynomod).html("");
$("#edit"+onlynomod).attr("contentEditable","false");
$("#edit"+onlynomod).css("border","none");
}

function modThis() {
var modvalue = $("#edit"+onlynomod).html();

					$.ajax({
                        type: "POST",
                        url: "php/mod.php",
                        data: {talk: modvalue, anony:'' , onlyno: onlynomod},
                        success: function(response) {
						$("#editbtn"+onlynomod).html("");
						$("#edit"+onlynomod).attr("contentEditable","false");
						$("#edit"+onlynomod).css("border","none");

					}}); 
}

function editThis() {
$("#editbtn"+onlynomod).html("");
$("#edit"+onlynomod).attr("contentEditable","True");
$("#edit"+onlynomod).css("border","1px solid #dddddd");
$("#edit"+onlynomod).focus();
$("#editbtn"+onlynomod).append("<a class=modibtn onclick=modThis();>수정</a> &nbsp  &nbsp&nbsp&nbsp <a  class=modibtn onclick=cancelMod()>취소</a>");
}

  

function schType($type){
var $url;
var $id;
var $message;

switch ($type)
{
case 1 : $url="sch/movie.php"; $id="movie"; $message="어떤 영화를 보셨나요?"; break;
case 2 : $url="sch/book.php"; $id="book"; $message="어떤 책을 읽으세요?"; break;
case 3 : $url="sch/news.php"; $id="news"; $message="어떤 뉴스를 찾고 싶으세요?"; break;
case 4 : $url="sch/ency.php"; $id="ency"; $message="사전을 검색합니다"; break;
case 5 : $url="sch/img.php"; $id="img"; $message="그림을 검색합니다"; break;
}
schurl = $url;

$('.scon').removeClass("opacity");

if (schnow!=$type){
$('#'+$id).addClass("opacity");
$('#schwindow').show("blind", 500);
$('#schvalue').attr("placeholder", ""+$message );
schnow = $type;}
else{
$('#schwindow').hide("blind", 500);
schnow = 0;


}
}



  
  
function schSomething() {
				var schword = $("#schvalue").val();
                $.ajax({
                        type: "POST",
                        url: schurl,
                        data: {query: schword},
                        success: function(response) {
							$("#result").html("");
							if (response.length>10){
                           $("#result").append(response);}
						   else{$("#result").append("검색결과가 없습니다.");}
                        }
                });
                return false;
}

function moveToWrite($schid){
$("#writeit").show("blind", 500);
$("#"+$schid).appendTo("#writeforsch");
toggleState('cardtoggles');
toggleID('mycards');
$("#newbody").focus();
$("body").scrollTop("0");

}








function writeSchvalue(){
		var sendwr = groupnumberfor[groupnumbernow];
if (groupnumbernow==100){sendwr = sendto;groupnumbernow=0; }
if (pagetypearray[groupnumbernow]==1){sendwr=groupnumberfor[groupnumbernow]+"||2";}



		
		
				$.ajax({
                        type: "POST",
                        url: "php/board_insert.php",
                        data: {body: schwrite, pagesort: sendwr},
                        success: function(response) {		
						alert(response);
						swipeLetter(groupnumbernow);
						}});
	}

	
	


	
	
	
	
	
	
(function($) {

	$.fn.scrollPagination = function(options) {
		
		var settings = { 
			nop     : 10, // The number of posts per scroll to be loaded
			offset  : 0, // Initial offset, begins at 0 in this case
			error   : 'No More Posts!', // When the user reaches the end this is the message that is
			                            // displayed. You can change this if you want.
			delay   : 0, // When you scroll down the posts will load after a delayed amount of time.
			               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
			               // but will still load if the user clicks.
		}
		
		// Extend the options so they work with the plugin
		if(options) {
			$.extend(settings, options);
		}
		
		// For each so that we keep chainability.
		return this.each(function() {		
			
			// Some variables 
			$this = $(this);
			$settings = settings;
			var offset = $settings.offset;
			busy = false; // Checks if the scroll action is happening 
			                  // so we don't run it multiple times
			
			// Custom messages based on settings
			if($settings.scroll == true) $initmessage = '';
			else $initmessage = '';
			
			// Append custom messages and extra UI
			/*$this.append('<div class="content"></div><div class="loading-bar">'+$initmessage+'</div>');*/
			
			function getData() {
				$('#mainpage').append("<div id=moreloading><img src=icon/preloader.gif></div>");

				// Post data to lettermore.php
				$.post('letter/lettermore.php', {
					group : sendto,	
					page : pagerightnow,
					action        : 'scrollpagination',
				    number        : $settings.nop,
				    offset        : offset,
					    
				}, function(data) {
						
					// Change loading bar content (it may have been altered)
					
						
					// If there is no data returned, there are no more posts to be shown. Show error
					if(data.length < 100) { 
					$('#morebtn').remove();
					$('#mainpage').append("<div id=morebtn>마지막페이지입니다.</div>");
					$('#moreloading').remove();
					busy = true;
					}
					else {
						
						// Offset increases
					    offset = offset+$settings.nop; 
						    
						// Append the data to the content div
					   	/*$this.find('.content').append(data);*/
						
					
						$('#mainpage').append(data);
					$('#morebtn').remove();
					$('#moreloading').remove();
					$('#mainpage').append("<div id=morebtn style='cursor:hand' onclick='ajaxMore();'>더보기</div>");

						// No longer busy!	
						busy = false;
					}	
						
				});
					
			}	
			
			getData(); // Run function initially
			
			// If scrolling is enabled
			if($settings.scroll == true) {
				// .. and the user is scrolling
				$(window).scroll(function() {
					
					// Check the user is at the bottom of the element
					if($(window).scrollTop() + windowheight + 200 > $this.height() && !busy) {
						
						// Now we are working, so busy is true
						busy = true;
						
						// Tell the user we're loading posts
						
						
						// Run the function to fetch the data inside a delay
						// This is useful if you have content in a footer you
						// want the user to see.
						setTimeout(function() {
							
							getData();
							
						}, $settings.delay);
							
					}	
				});
			}
			
			// Also content can be loaded by clicking the loading bar/
			$this.find('.loading-bar').click(function() {
			
				if(busy == false) {
					busy = true;
					getData();
				}
			
			});
			
		});
	}

})(jQuery);

