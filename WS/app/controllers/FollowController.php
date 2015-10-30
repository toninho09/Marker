<?php

class FollowController extends BaseController {

	public function follow(){
		$follow = Input::get('follow',null);
		if(empty($follow) || is_array($follow) || $follow == Session::get('user')){
			return (new RequestResponse())->setValidationError('Follow invalid.');
		}

		$follower = Follower::where('user',$follow)->where('follower',Session::get('user'))->first();
		if(!$follower){
			$follower = new Follower();
			$follower->user = $follow;
			$follower->follower = Session::get('user');
			$follower->save();
		}
		$followerCount = VWFollowerCount::where('id',$follow)->pluck('followerCount');
		$followerCount = $followerCount > 0 ? $followerCount : 0;
		return new RequestResponse(['follower'=>$followerCount]);
	}

}
