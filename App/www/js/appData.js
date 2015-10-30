var appData = {	
	token:'',
	/**
	 * SETA O VALOR DO TOKEN, NECESSÁRIO PARA LOGAR NO SISTEMA
	 * @param {STROMG} value VALOR DO TOKEN
	 */
	setToken : function(value){
		window.localStorage.setItem('token',value);
		this.token = value;
	},

	/**
	 * LIMPA O TOKEN, BASICAMENTE DESLOGA O USUÁRIO
	 * @return {NULL}
	 */
	cleanToken : function(){
		window.localStorage.removeItem('token');
		this.token = '';
	},

	/**
	 * LIMPA TODOS OS DADOS DO APLICATIVO
	 * @return {NULL} 
	 */
	cleanAll : function(){
		window.localStorage.clear();
	},

	/**
	 * SETA UM VALOR NO LOCALSTORAGE
	 * @param {STRING} item  NOME DO ITEM
	 * @param {MIXED} value O OBJETO QUE VAI SER SALVO NO STORAGE
	 */
	set : function(item,value){
		window.localStorage.setItem(item,value);
	},

	/**
	 * RETORNA UM VALOR DO STORAGE
	 * @param  {STRING} item NOME DO ITEM NO STORAGE
	 * @return {MIXED}      VALOR ARMAZENADO NO STORAGE
	 */
	get : function(item){
		return window.localStorage.getItem(item);
	},

	/**
	 * INICIA O appData
	 * @return {null} 
	 */
	init : function(){
		this.token = window.localStorage.getItem('token');
	}
}
appData.init();