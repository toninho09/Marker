<?php

class CategoryController extends BaseController {

	/**
	 * request:{"token":"7945562c3ae7be36b7.00071032"}
	 * /category/list
	 * LISTA AS CATEGORIAS DE VOLTA PARA O APP
	 * 
	 */
	public function lists(){
		return new RequestResponse(VWCategory::all());
	}

}
