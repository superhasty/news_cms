var hfaw_dialog={
	error: function(content,url){
		layer.open({
			// type: 1,
			// area: ['200px','200px'],
			// shadeClose: true,
			content: content,
			yes: function(){
				window.location.href=url;
			},
		})
	},

	success: function(content,url){
		layer.open({
			// type: 1,
			// area: ['200px','200px'],
			// shadeClose: true,
			content: content,
			yes: function(){
				window.location.href=url;
			},
		})
	},

	confirm: function(content,url,data,url1,url2){
		layer.confirm(content,
			function(index){
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: data,
				})
				.done(function(result){
					if(result.status==0){
						console.log("suc");
						layer.open({content: result.msg, yes: function(index){window.location.href=url1; layer.close(index);}});
					}else{
						console.log("err");
						layer.open({content: result.msg, yes: function(index){window.location.href=url2; layer.close(index);}});
					}
					layer.close(index);
				})
				.fail(function() {
					
				})
				.always(function(){
					layer.close(index);
				});
			}
		);
	}
}