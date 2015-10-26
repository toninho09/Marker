var appData = {	
	token:'',
	setToken : function(value){
		window.localStorage.setItem('token',value);
		this.token = value;
	},
	set : function(item,value){
		window.localStorage.setItem(item,value);
	},
	init : function(){
		this.token = window.localStorage.getItem('token');
	}
}
appData.init();