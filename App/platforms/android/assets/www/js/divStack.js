function DivStack(){
	return {
		arrayStack: [],
		lastDiv:null,
		zIndex : 100, 
		stack: function(div,data,callback,cssOverWrite){
			if(this.lastDiv) $(this.lastDiv).hide();
			this.arrayStack.push({"div":div,"data":data,"callback":callback,"cssOverWrite":cssOverWrite});
			this.show(div,cssOverWrite);
			if(this.onStack) this.onStack();
		},
		unStack: function(){
			if(this.arrayStack.length ==0) return;

			var div = this.arrayStack.pop();
			
			$(div.div).hide();
			
			if(this.onUnStack) this.onUnStack();
			
			if(this.arrayStack.length ==0 ){
				if(this.onEmpty) this.onEmpty();
				this.lastDiv = null;
			}else{
				div = this.arrayStack.pop();
				this.lastDiv = div;
				this.arrayStack.push(div);
				this.show(div.div,div.cssOverWrite);
				if(div.callback){
					div.callback(div.data);
				}
			}
		},
		show: function(div,cssOverWrite){
			$(div).css({
				height: window.height+"px",
				width: window.width+"px",
				top:"0",
				left:"0",
				right:"0",
				"min-height":window.height+"px",
				"z-index":this.zIndex++,
				overflow:'auto'
			});
			if(cssOverWrite){
				$(div).css(cssOverWrite);
			}
			$(div).show();
			if(this.onShow) this.onShow();
			this.lastDiv = div;
		},

		clear: function(){
			if(this.arrayStack.length >0){

				var div = this.arrayStack.pop();
				this.arrayStack =[];
				$(div.div).hide();

				if(this.onUnStack) this.onUnStack();

				if(this.onEmpty) this.onEmpty();
			}
		},
		onEmpty: null,
		onStack:null,
		onUnStack:null,
		onShow:null
	};
}
var divStack = new DivStack();