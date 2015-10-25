<?php

class CategoryController extends BaseController {

	/**
	 * /category/list
	 * LISTA AS CATEGORIAS DE VOLTA PARA O APP
	 */
	public function lists(){
		return new RequestResponse(VWCategory::all());
	}

}
