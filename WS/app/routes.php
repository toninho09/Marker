<?php

/**
 * ROTAS QUE NÃO PRECISA DO LOGIN
 */
Route::any('/', function()
{
	return 'ok';
});

/**
 * ROTAS COM ACESSO APENAS COM LOGIN
 */
Route::group(array('before' => 'auth'), function(){
	Route::get('/category/list', array('as' => 'category.list', 'uses' => 'CategoryController@list'));


});

