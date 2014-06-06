pagerightnow++;
$(function() {
$( ".plus").unbind( "click" );
$('.plus').click(function(){
cardCopy(this);
});
$( ".removethis").unbind( "click" );
		$('.removethis').click(function(){
		$( this ).parent().remove();
		
		
		});
 });	
 

function cardCopy($id){
  $( $id ).parent().clone().appendTo('#writeforsch'); 
$("#writeforsch").show();
$('#writeforsch').find(".plus").replaceWith("<div class=removethis></div>");
//messageShow('카드가 추가되었습니다.');
		$('.removethis').click(function(){
		$( this ).parent().remove();
		});
}