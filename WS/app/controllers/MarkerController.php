<?php

class MarkerController extends BaseController {

/**
 * [requet : {"token":"962456317ae60f80f4.35447327","latitude":"-89.978721","longitude":"55.296472","distance":10,"days":1000,"user":[1,2,3]}
 * /marker/filter
 * @return [type] [description]
 */
	public function filter(){
		$latitude = Input::get('latitude',null);
		$longitude = Input::get('longitude',null);
		$distance = Input::get('distance',0.2);
		$user = Input::get('user',null);
		$category = Input::get('category',null);

		$days = Input::get('days',7);
		
		$query = VWMarker::previusDays($days)
		->filterLatLong($latitude,$longitude,$distance)
		->filterUser($user)
		->filterCategory($category);

		return new RequestResponse($query->get());
	}

/**
 * request : {"token":"962456317ae60f80f4.35447327","marker":{"latitude":-89.978721,"longitude":55.296472,"title":"testando inserir marker2","category":1,"user":1}}
 * /marker/create
 * @return [type] [description]
 */
	public function create(){
		$markerInput = Input::get('marker',[]);
		$validation = Validator::make($markerInput,[
			'latitude' => 'required',
			'longitude' => 'required',
			'title'=>'required|max:1024',
			'user' =>'required|integer|exists:user,id',
			'category' =>'required|integer',
			]);
		if($validation->fails()){
			return (new RequestResponse())->setValidationError($validation->messages()->first());
		}
		$marker = new Marker();
		$marker->latitude = $markerInput['latitude'];
		$marker->longitude = $markerInput['longitude'];
		$marker->title = $markerInput['title'];
		$marker->user = $markerInput['user'];
		$marker->category = $markerInput['category'];
		$marker->save();
		return new RequestResponse();
	}

	/**
	 * request : {"token":"962456317ae60f80f4.35447327","marker":22404}
	 * /marker/like
	 * @return [type] [description]
	 */
	public function like(){
		$marker = Input::get('marker',null);
		$validation = Validator::make(['marker'=>$marker],
			['marker'=>'required|exists:Marker,id']);
		if($validation->fails()){
			return (new RequestResponse())->setValidationError($validation->messages()->first());
		}
		$like = Like::where('user',Session::get('user'))->where('marker',$marker)->first();
		if(!$like){
			$like = new Like();
			$like->user = Session::get('user');
			$like->marker = $marker;
			$like->save();
		}
		$likeCount = VWLikeCount::where('id',$marker)->pluck('likeCount');
		$likeCount = $likeCount > 0 ? $likeCount : 0;
		return new RequestResponse(['like'=>$likeCount]);
	}
	/**
	 * request : {"token":"962456317ae60f80f4.35447327","marker":22404}
	 * /marker/unlike
	 * @return [type] [description]
	 */
	public function unlike(){
		$marker = Input::get('marker',null);
		$validation = Validator::make(['marker'=>$marker],
			['marker'=>'required|exists:Marker,id']);

		if($validation->fails()){
			return (new RequestResponse())->setValidationError($validation->messages()->first());
		}
		$like = Like::where('user',Session::get('user'))->where('marker',$marker)->first();
		if($like){
			$like->delete();
		}
		$likeCount = VWLikeCount::where('id',$marker)->pluck('likeCount');
		$likeCount = $likeCount > 0 ? $likeCount : 0;
		return new RequestResponse(['like'=>$likeCount]);
	}
}
