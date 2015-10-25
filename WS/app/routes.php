<?php

/**
 * ROTAS QUE NÃO PRECISA DO LOGIN
 */
Route::any('/user/register', array('as' => 'user.register', 'uses' => 'UserController@register'));
Route::any('/user/auth', array('as' => 'user.auth', 'uses' => 'UserController@auth'));
/**
 * ROTAS COM ACESSO APENAS COM LOGIN
 */
Route::group(array('before' => 'auth'), function(){
	Route::any('/category/lists', array('as' => 'category.list', 'uses' => 'CategoryController@lists'));

});

