<?php

App::before(function($request)
{

	header("Access-Control-Allow-Origin: *");
});


App::after(function($request, $response)
{
	$response->header('Content-Type', "application/json");
	//$response->header('Content-Length', strlen($response->getOriginalContent()));
	Log::debug(DB::getQueryLog());
});


/**
 * requisição do app deve ser
 * {token :"",
 * 	<dados>
 * }
 */
Route::filter('auth', function()
{
	$token = Input::get('token','');
	// if(empty($token)){
	// 	return (new RequestResponse())->setExceptionError('Token invalid.');
	// }
   $token = VWToken::where('token',$token)->first();
	// if(!$token){
	// 	return (new RequestResponse())->setExceptionError("Token invalid.");
	// }
	// if($token->userAgent != $_SERVER['HTTP_USER_AGENT']){
	// 	return (new RequestResponse())->setExceptionError("this account is logged on another device");
	// }
	Session::put('user',$token->user);
});


