

	/*添加回复*/
//	$(".clickable").live('click',function(){
//		/*var name=$('a:first',$(this).parent()).text();*/
//		/*var data = $('.clickable').attr("data-mention");*/
//		var name =$('.clickable').attr('data-mention');
//		$('#comment').val('@'+name+' ').focus();
//		return false;
//	});

//        //@回复
//        $(".clickable").live("click", function(e) {
//            e.preventDefault();
//            var append_str = "@" + $(this).attr("data-mention") + " ";

//            $("#comment").insertAtCaret(append_str);

//            /*
//            setTimeout(function() {
//                $("#reply_content").focus();
//                $("#reply_content").val(append_str + $("#reply_content").val());
//            } , 100);
//            */
//        });

                //快速回复ctrl+enter
        $(document).keypress(function(e){
            var active_id = document.activeElement.id;  
            if((e.ctrlKey && e.which == 13 || e.which == 10) && (active_id == "topic_content" || active_id == "reply_content")) {
                e.preventDefault();
                $("#new_topic").submit();
                $("#myform").submit();
            }
        });