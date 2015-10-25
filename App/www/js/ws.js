var WS = {
	var	self = this;
	self.url_base = 'http://localhost:8000/';

	self.login = function(user,pass,callback){
		self.call('user/auth',{'user':user,'pass':pass},callback){
			
		}
	}

	self.call = function(url,data,successCallBack,errorCallBack,doneCallBack,alwayCallBack){
		$.post(self.url_base+url, data, successCallBack,data,'json')
		.done(doneCallBack)
		.fail(errorCallBack)
		.always(alwayCallBack);
	}
}