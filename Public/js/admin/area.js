$(function(){

	// 跳转到区域添加页面
	$("#area_add_link").on('click', function(event){
	    event.preventDefault();
	    window.location.href=$(this).attr("data-url");
	});

	// 跳转到区域编辑页面
	$(".area_edit_link").on('click', function(event){
	    event.preventDefault();
	    window.location.href=$(this).attr("data-url");
	});

	// 区域删除
	$(".area_delete_link").on('click', function(event){
	    event.preventDefault();
	    var url=$(this).attr('data-url');
	    var data={id: $(this).attr('attr-id')};
	   	hfaw_dialog.confirm("是否删除", doDeleteArea);
	   	function doDeleteArea(){
	   		$.ajax({
	   			url: url,
	   			type: 'POST',
	   			dataType: 'json',
	   			data: data,
	   		})
	   		.done(function(result){
	   			if(result.status==0){
	   				hfaw_dialog.success("删除区域成功", result.data.url);
	   			}else{
	   				hfaw_dialog.error("删除区域失败,原因是"+result.msg, result.data.url);
	   			}
	   		})
	   		.fail(function(){
	   			hfaw_dialog.error("网络连接错误");
	   		});
	   	}
	});

	// 添加区域的请求
	$("#btn_add_area_submit").on('click', function(event) {
	    event.preventDefault();
	    var newsdata = {
	        "areaName" : $("#areaName").val(),
	        "areaDesp" : $("#areaName").val(),
	        "areaStatus" : $("#areaStatus").val()
	    };
	    var url = $(this).attr('data-url');
	    $.ajax({
	        url: url,
	        type: 'POST',
	        dataType: "json",
	        data: newsdata,
	    })
	    .done(function(result){
	        if(result.status==0){
	            hfaw_dialog.success("添加区域成功", result.data.url);
	        }else{
	            hfaw_dialog.error("添加区域失败,原因是"+result.msg, result.data.url);
	        }
	    })
	    .fail(function(){
	        hfaw_dialog.error("网络连接错误");
	    });
	});

	// 编辑区域的请求
	$("#btn_edit_area_submit").on('click', function(event) {
		event.preventDefault();
		var formData = $("#area_edit_form").serializeArray();
		var postData={};
		$.each(formData, function(index, val){
			postData[val.name] = val.value;
		});
		var url=$(this).attr('data-url');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: postData,
		})
		.done(function(result) {
			if(result.status==0){
			    hfaw_dialog.success("编辑区域成功", result.data.url);
			}else{
			    hfaw_dialog.error("编辑区域失败,原因是"+result.msg, result.data.url);
			}
		})
		.fail(function() {
			hfaw_dialog.error("网络连接错误");
		});
	});

	/**
	 * 设置区域的状态
	 */
	$(".status-switch-flag").on('click', function(event) {
	    event.preventDefault();
	    var url=$(this).attr('data-url');
	    var postData={
	        id: $(this).attr('attr-id'),
	        status: $(this).attr('attr-status')
	    };
	    console.log(postData);
	    hfaw_dialog.confirm("是否更改区域状态", updateAreaStatus);
	    function updateAreaStatus(){
	        $.ajax({
	            url: url,
	            type: 'POST',
	            dataType: 'json',
	            data: postData,
	        })
	        .done(function(result){
	            if(result.status==0){
	                hfaw_dialog.success("更改区域状态成功", result.data.url);
	            }else{
	                hfaw_dialog.error("更改区域状态失败,原因是"+result.msg, result.data.url);
	            }
	        })
	        .fail(function(){
	          hfaw_dialog.error("网络连接错误");  
	        });
	    }
	});
})