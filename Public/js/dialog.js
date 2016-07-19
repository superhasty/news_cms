var hfaw_dialog={
	error: function(result){
		layer.open({
			type: 1,
			area: ['200px','200px'],
			shadeClose: true,
			content: result,
		})
	},

	success: function(result){
		layer.open({
			type: 1,
			area: ['200px','200px'],
			shadeClose: true,
			content: result,
		})
	}
}