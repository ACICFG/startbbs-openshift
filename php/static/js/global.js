
// JavaScript Document
$(function(){
	$('#comment').bind("blur focus keydown keypress keyup", function(){
		recount();
	});
    $("#myform").submit(function(){
		//var submitData = $(this).serialize();
		var comment = $("#comment").val();
		var fid = $("#fid").val();
		if(comment==""){
			$("#msg").show().html("你总得说点什么吧.").fadeOut(2000);
			return false;
		}
		$('.counter').html('<img style="padding:8px 12px" src="Images/load.gif" alt="正在处理..." />');
		$.ajax({
		   type: "POST",
		   url: siteurl+"/comment/add_comment",
		   //data: submitData
		   data:"comment="+comment+"&fid="+fid,
		   dataType: "html",
		   success: function(msg){
			  if(parseInt(msg)!=0){
				 $('#saywrap').prepend(msg);
				 $('#comment').val('');
				 recount();
				 window.location.reload(true);
			 }else{
				$("#msg").show().html("系统错误.").fadeOut(2000);
				return false;
			 }
		  }
	    });
		return false;
	});
});

function recount(){
	var maxlen=140;
	var current = maxlen-$('#comment').val().length;
	$('.counter').html(current);

	if(current<1 || current>maxlen){
		$('.counter').css('color','#D40D12');
		$('input.btn btn-small').attr('disabled','disabled');
	}
	else
		$('input.btn btn-small').removeAttr('disabled');

	if(current<10)
		$('.counter').css('color','#D40D12');

	else if(current<20)
		$('.counter').css('color','#5C0002');

	else
		$('.counter').css('color','#cccccc');

}

	/*添加回复*/
	$(".clickable").live('click',function(){
		/*var name=$('a:first',$(this).parent()).text();*/
		/*var data = $('.clickable').attr("data-mention");*/
		var name =$('.clickable').attr('data-mention');
		$('#comment').val('@'+name+' ').focus();
		return false;
	});

