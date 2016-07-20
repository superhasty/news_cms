$(function(){
	$("#btn_login").on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		var username=$("#inputUsername").val();
		var password=$("#inputPassword").val();
		$.ajax({
			url: $(this).attr('data-url'),
			type: 'POST',
			dataType: 'json',
			data: {username: username, password: password},
		})
		.done(function(result){
			//success
			if(result.status==0){
				hfaw_dialog.success("成功登陆,赶快开始编辑吧", result.data.url);
			}else{
				hfaw_dialog.error("登录失败,请重新登陆:原因是"+result.msg, result.data.url);
			}
		})
		.fail(function(){
			hfaw_dialog.error("网络连接失败");
		});
	});
});