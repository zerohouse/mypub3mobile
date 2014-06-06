function chk_input() {
if(user_form.fuserid.value==""){
alert("아이디를 입력해주세요.");
user_form.fuserid.focus();
return false;
}
else if(user_form.fname.value==""){
alert("이름을 입력해주세요.");
user_form.fname.focus();
return false;
}
else if(user_form.fpasswd.value==""){
alert("암호를 입력해주세요.");
user_form.fpasswd.focus();
return false;
}
else if(user_form.fpasswd_re.value==""){
alert("암호를 한번 더 입력해주세요.");
user_form.fpasswd_re.focus();
return false;
}
else if(user_form.fpasswd.value != user_form.fpasswd_re.value){
alert("암호값이 다릅니다. 다시 입력해주세요.");
user_form.fpasswd.value="";
user_form.fpasswd_re.value="";
user_form.fpasswd.focus();
return false;
}
else if(user_form.phone.value == ""){
alert("폰번호 마지막 네자리를 입력해주세요.");
user_form.phone.value="";
user_form.phone.focus();
return false;
}
else if(user_form.phone.value.length != 4){
alert("폰번호 마지막 네자리를 모두 입력해주세요.");
user_form.phone.value="";
user_form.phone.focus();
return false;
}
else
{return true;}
}

$url1="";
$url2="";
$url3="";
$now="";

function stringCheck() 
{ 
var str = user_form.fuserid.value;
; 
var err = 0; 
        for (var i=0; i<str.length; i++) 
        { 
                var chk = str.substring(i,i+1); 
                if(!chk.match(/[0-9]|[a-z]|[A-Z]/)) 
                { 
                err = err + 1; 
                } 
        } 
        if (err > 0) 
        { 
                $("#about").html("<p style='color:red'>아이디는 영문과 숫자만 입력가능합니다.</p>"); 
				user_form.fuserid.focus();
        } 
} 

function makeCHR(id){//캐릭터 만들기 (이미지띄움)
if (id==1){
$url1=$('#url1').val();
document.getElementById("userchr").src = $url1;
$now=1;
}
if (id==2){
$url2=$('#url2').val();
document.getElementById("userchr").src = $url2;
$now=2;
}
if (id==3){
$url3=$('#url3').val();
document.getElementById("userchr").src = $url3;
$now=3;
}}


function checkID(){
 var str = user_form.fuserid.value; 
 var err = 0; 
        for (var i=0; i<str.length; i++) 
        { 
                var chk = str.substring(i,i+1); 
                if(!chk.match(/[0-9]|[a-z]|[A-Z]/)) 
                { 
                err = err + 1; 
                } 
        } 
        if (err > 0) { 
               $("#about").html("<p style='color:red'>영문과 숫자로 작성해주세요.</p>");
				user_form.fuserid.focus();
        }  
 else if($('#fuserid').val() == ""){
  alert("아이디를 입력해 주세요.");
  $('#fuserid').focus();
 }else{
  $.ajax({
   url: 'id_chk.php',
   type: 'POST',
   data: {'id':$('#fuserid').val()},
   dataType: 'html',
   success: function(data){
	if (data=='ok'){
    $("#about").html("<strong><p style='color:green'>쓸수있는 아이디입니다 ^-^</p></strong>");
	user_form.fname.focus();
	}
	else {
    $("#about").html("<strong><p style='color:red'>사용중인 아이디 입니다.</p></strong>");
	user_form.fuserid.focus();
	}
   }
  });
 }
}

$(function() {
document.getElementById("bgimg").src = "../char/" + Math.ceil(Math.random()*10) + ".jpg";
$('#phone').numberOnly();

$("#bgimg").click(function(){
document.getElementById("bgimg").src = "../char/" + Math.ceil(Math.random()*10) + ".jpg"});

$("#userchr").click(function(){
switch ($now){
	case 1:
	$now = 2;
	document.getElementById("userchr").src = $url2;
	break;
	case 2:
	document.getElementById("userchr").src = $url3;
	$now = 3;
	break;
	case 3:
	document.getElementById("userchr").src = $url1;
	$now = 1;
	break;
	}
});


});