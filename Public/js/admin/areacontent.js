$(function(){
	$("#btn_change_areacontent_order").on('click', function(event) {
		event.preventDefault();
		var data = $("#areacontent_controller_form").serializeArray();
		var postData ={};
		$.each(data, function(index,val){
		    postData[val.name]=val.value;
		});
		var url=$(this).attr('data-url');
		var rurl = $(this).attr("data-redirect-url");
		$.ajax({
		    url: url,
		    type: 'POST',
		    dataType: 'JSON',
		    data: postData,
		})
		.done(function(result) {
		    if(result.status==0){
		        hfaw_dialog.success("新闻重新排序成功", result.data.url);
		    }else{
		        hfaw_dialog.error("新闻重新排序失败,原因是"+result.msg, result.data.url);
		    }
		})
		.fail(function(){
		    hfaw_dialog.error("新闻重新排序产生异常", rurl);//,原因是"+result.msg, result.data.url);
		});
	});


	$("#areacontent_add_link").on('click', function(event) {
		event.preventDefault();
		window.location.href=$(this).attr('data-url');
	});
})