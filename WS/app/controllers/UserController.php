<?php

class UserController extends BaseController {

	public function register(){
		$nick = Input::get('nick','');
		$pass = Input::get('pass','');
		$email = Input::get('email','');
		$validation = Validator::make(['nick'=>$nick,'pass'=>$pass,'email'=>$email],
			['nick'=>'required|min:4|max:45|unique:User,nick',
			'pass'=>'required|min:8',
			'email'=>'required|email|max:400|unique:User,email'
			]);
		if($validation->fails()){
			return (new RequestResponse())->setValidationError($validation->messages()->first());
		}
		$user = new User();
		$user->nick = $nick;
		$user->pass = md5($pass);
		$user->email = $email;
		$user->save();
		return new RequestResponse();
	}

	public function auth(){
		$nick = Input::get('nick','');
		$pass = Input::get('pass','');
		$user = User::where('nick',$nick)->where('pass',md5($pass))->first();
		if(!$user) return (new RequestResponse())->setValidationError('Nick or Password incorrect.');
		$token = new Token();
		$token->user = $user->id;
		$token->token = uniqid(rand(), true);
		$token->userAgent = $_SERVER['HTTP_USER_AGENT'];
		$token->save();
		return new RequestResponse(['token'=>$token->token]);
	}

}
