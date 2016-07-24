$(function(){
	$("#btn_config_submit").on('click', function(event) {
		event.preventDefault();
		var data={
			"title": $("#title").val(),
			"keywords": $("#keywords").val(),
			"description": $("#description").val()
		};
		$.ajax({
			url: $(this).attr("data-url"),
			type: 'POST',
			dataType: 'json',
			data: data,
		})
		.done(function(result){
			if(result.status==0){
				hfaw_dialog.success("修改基本配置成功", result.data.url);
			}else{
				hfaw_dialog.error("修改基本配置失败,原因是"+result.msg, result.data.url);
			}
		})
		.fail(function(){
			hfaw_dialog.error("网络连接错误");
		})
	});
})