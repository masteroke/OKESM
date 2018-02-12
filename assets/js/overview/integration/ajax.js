

function getData(controller, func, post_param, post_value)
{
	if(!post_param || !post_value || post_param === 0 || post_value === 0)
	{
		post_param = 'param';
		post_value = 'default';
	}

	var arr;
	
	$.ajax({
		async : false,
		url: base_url + controller + '/' + func,
		type : 'POST',
		data : {
			post_param : post_value,
		},
		success : function(data) {
			arr = eval('('+ data +')');
		}
	}); 
	
	return arr;
}

function controller_post(controller, func, data){
	var me, ctrl_url;
	
	ctrl_url = base_url + controller + '/' + func;
	
	if(data)
	{
		$.ajax({
			async : false,
			url: ctrl_url,
			type : 'POST',
			data : {
				'data':data
			},
			success : function(data) {
				me = data;
				
				console.log(ctrl_url, data);
				
			}
		});
	} 
	return me;
}
