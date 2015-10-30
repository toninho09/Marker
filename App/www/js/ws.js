$.support.cors = true;
var WS = {
	self:this,
	url_base: 'http://192.168.0.104/',
	login : function(user,pass,callback){
		this.call('user/auth',{"nick":user,"pass":pass},callback);
	},
	call : function(url,data,successCallBack,errorCallBack,doneCallBack,alwayCallBack){
		$.ajaxSetup({
		});
		$.post(this.url_base+url, data, function(response){
			if(response.status == 1){
				successCallBack(response.response);
			}else{
				alert(response.message);
			}
		},'json')
		.done(doneCallBack)
		.fail(errorCallBack)
		.always(alwayCallBack);
	}
}