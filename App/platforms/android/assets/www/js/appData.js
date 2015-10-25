var appData = {
	
	var self = this;
	
	self.token = '';

	self.setToken = function(value){
		window.localStorage.setItem('token',value);
		self.token = value;
	}

	self.set = function(item,value){
		window.localStorage.setItem(item,value);
	}

	self.init = function(){
		self.token = window.localStorage.getItem('token');
	}
}