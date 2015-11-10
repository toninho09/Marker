$.support.cors = true;
var WS = {
	url_base: 'http://192.168.0.104/',
	login : function(user,pass,callback){
		this.call('user/auth',{"nick":user,"pass":pass},callback);
	},
	register: function(user,pass,email,callback){
		this.call('user/register',{'nick':user,'pass':pass,'email':email},callback);
	},
	getMarker: function(latitude,longitude,callback){
		this.call('marker/filter',{token:"16670563597118d73d9.09914789",'latitude':latitude,
			'logitude':longitude,'distance':100,'days':1000},callback)
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