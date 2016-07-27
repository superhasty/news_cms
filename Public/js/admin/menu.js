$(function(){
	// 跳转到添加菜单
	$("#menu_add_link").on('click', function(event){
		event.preventDefault();
		console.log($(this).attr("data-url"));
		window.location.href=$(this).attr("data-url");
	});
	// 跳转到编辑菜单
	$(".menu_modify_link").on('click', function(event){
		event.preventDefault();
		window.location.href=$(this).attr('data-url');
	});
	// 删除菜单
	$(".menu_delete_link").on('click', function(event){
		event.preventDefault();
		// 弹窗进行确认
		var url=$(this).attr("data-url");
		var data={id: $(this).attr("attr-id")};
		hfaw_dialog.confirm("是否删除", doDeleteMenu);
		function doDeleteMenu(){
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: data,
			})
			.done(function(result){
				if(result.status==0){
					hfaw_dialog.success("删除菜单成功", result.data.url);
				}else{
					hfaw_dialog.error("删除菜单失败,原因是"+result.msg, result.data.url);
				}
			})
			.fail(function(){
				hfaw_dialog.error("网络连接错误");
			});
		}
	});

	// 发送表单完成添加菜单
	$("#btn_add_menu_submit").on('click', function(event){
		event.preventDefault();
		var formData = $("#news_cms_form").serializeArray();
		var postData={};
		$.each(formData, function(index, val) {
			postData[val.name] = val.value;
		});
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
		.fail(function(){
			hfaw_dialog.error("网络连接错误");
		});
	});

	/**
	 * 发送表单完成修改菜单
	*/
	$("#btn_modify_menu_submit").on('click', function(event){
		event.preventDefault();
		var formData = $("#news_cms_form").serializeArray();
		var postData={};
		$.each(formData, function(index, val){
			postData[val.name] = val.value;
		});
		$.ajax({
			url: $(this).attr('data-url'),
			type: 'POST',
			dataType: 'json',
			data: postData,
		})
		.done(function(result){
			if(result.status==0){
				hfaw_dialog.success("修改菜单成功", result.data.url);
			}else{
				hfaw_dialog.error("修改菜单失败,原因是"+result.msg, result.data.url);
			}
		})
		.fail(function(){
			hfaw_dialog.error("网络连接错误");
		});
	});

	/**
	 * 菜单排序
	 */
	$("#btn_change_menu_order").on('click', function(event) {
		event.preventDefault();
		var data = $("#menu_controller_form").serializeArray();
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
				hfaw_dialog.success("菜单重新排序成功", result.data.url);
			}else{
				hfaw_dialog.error("菜单重新排序失败,原因是"+result.msg, result.data.url);
			}
		})
		.fail(function(){
			// hfaw_dialog.error("网络连接错误");
			hfaw_dialog.error("菜单重新排序产生异常", rurl);//,原因是"+result.msg, result.data.url);
		});
	});
});