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
	}
}