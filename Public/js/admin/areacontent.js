$(function(){

	//改变区域内容的排序
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

	//跳转到新增区域内容页面
	$("#areacontent_add_link").on('click', function(event) {
		event.preventDefault();
		window.location.href=$(this).attr('data-url');
	});

	//跳转到编辑区域内容页面
	$(".areacontent_edit_link").on('click', function(event) {
		event.preventDefault();
		window.location.href=$(this).attr('data-url');
	});

	//删除区域内容
	$(".areacontent_delete_link").on('click', function(event) {
		event.preventDefault();
        // 弹窗进行确认
        var url=$(this).attr("data-url");
        var data={id: $(this).attr("attr-id")};
        hfaw_dialog.confirm("是否删除", doDeleteAreaContent);
        function doDeleteAreaContent(){
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: data,
            })
            .done(function(result){
                if(result.status==0){
                    hfaw_dialog.success("删除区域内容成功", result.data.url);
                }else{
                    hfaw_dialog.error("删除区域内失败,原因是"+result.msg, result.data.url);
                }
            })
            .fail(function(){
                hfaw_dialog.error("网络连接错误");
            });
        }
		
	});

	//新增区域内容
	$("#btn_add_areacontent_submit").on('click', function(event) {
		event.preventDefault();
		var postData = {
		    "title" : $("#title").val(),
		    "area_id" : $("#area_id").val(),
		    "thumb" : $("#upload_thumb_image").val(),
		    "url" : $("#url").val(),
		    "news_id" : $("#news_id").val(),
		    "status" : $("input[type='radio']:checked").val()
		};
		var url=$(this).attr('data-url');
		$.ajax({
		    url: url,
		    type: 'POST',
		    dataType: "json",
		    data: postData,
		})
		.done(function(result){
		    if(result.status==0){
		        hfaw_dialog.success("添加区域内容成功", result.data.url);
		    }else{
		        hfaw_dialog.error("添加区域内容失败,原因是"+result.msg, result.data.url);
		    }
		})
		.fail(function(){
		    hfaw_dialog.error("网络连接错误");
		});	
	});

	//编辑区域内容
	$("#btn_edit_areacontent_submit").on('click', function(event) {
		event.preventDefault();
		var areacontentId = $(this).attr("attr-id");
		var newsdata = {
		    "id": areacontentId,
		    "title" : $("#title").val(),
		    "area_id" : $("#area_id").val(),
		    "thumb" : $("#upload_thumb_image").val(),
		    "url": $("#url").val(),
		    "news_id" : $("#news_id").val(),
		    "status" : $("input[type='radio']:checked").val()
		};
		var url=$(this).attr('data-url');
		$.ajax({
		    url: url,
		    type: 'POST',
		    dataType: "json",
		    data: newsdata,
		})
		.done(function(result){
		    if(result.status==0){
		        hfaw_dialog.success("修改区域内容成功", result.data.url);
		    }else{
		        hfaw_dialog.error("修改区域内容失败,原因是"+result.msg, result.data.url);
		    }
		})
		.fail(function(){
		    hfaw_dialog.error("网络连接错误");
		});
	});


	//状态切换
	$(".status-switch-flag").on('click', function(event) {
		event.preventDefault();
		var url=$(this).attr('data-url');
		var postData={
		    id: $(this).attr('attr-id'),
		    status: $(this).attr('attr-status')
		};
		hfaw_dialog.confirm("是否更改区域内容状态", updateNewsStatus);
		function updateNewsStatus(){
		    $.ajax({
		        url: url,
		        type: 'POST',
		        dataType: 'json',
		        data: postData,
		    })
		    .done(function(result){
		        if(result.status==0){
		            hfaw_dialog.success("设置区域内容状态成功", result.data.url);
		        }else{
		            hfaw_dialog.error("设置区域内容状态失败,原因是"+result.msg, result.data.url);
		        }
		    })
		    .fail(function(){
		      hfaw_dialog.error("网络连接错误");  
		    });
		}
	});
})