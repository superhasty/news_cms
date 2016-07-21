var hfaw_dialog={
	error: function(message,url){
		layer.open({
			// type: 1,
			// area: ['200px','200px'],
			// shadeClose: true,
			content: message,
			yes: function(){
				window.location.href=url;
			},
		});
	},

	success: function(message,url){
		layer.open({
			// type: 1,
			// area: ['200px','200px'],
			// shadeClose: true,
			content: message,
			yes: function(){
				window.location.href=url;
			},
		});
	},

	confirm: function(message,callback){
		layer.open({
			content: message,
			icon: 3,
			btn: ["是","否"],
			yes: function(index){
				callback();
				layer.close(index);
			},
		});
	}
}