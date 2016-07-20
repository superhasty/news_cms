$(function(){
	$("#button-add").on('click', function(event){
		event.preventDefault();
		/* Act on the event */
		console.log($(this).attr("data-url"));
		window.location.href=$(this).attr("data-url");
	});

	
	$("#singcms-button-submit").on('click', function(event) {
		event.preventDefault();
		// console.log($("#singcms-form").serializeArray());
		var formData = $("#singcms-form").serializeArray();
		var postData={};
		$.each(formData, function(index, val) {
			postData[val.name] = val.value;
		});
		console.log(postData);
		$.ajax({
			url: $(this).attr('data-url'),
			type: 'POST',
			dataType: 'json',
			data: postData,
		})
		.done(function(result){
			if(result.status==0){
				hfaw_dialog.success("添加菜单成功", result.data.url);
			}else{
				hfaw_dialog.error("添加菜单失败,原因是"+result.msg, result.data.url);
			}
		})
		.fail(function() {
			hfaw_dialog.error("网络连接错误");
		});
	});
});