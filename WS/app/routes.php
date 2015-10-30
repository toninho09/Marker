<?php

/**
 * ROTAS QUE NÃO PRECISA DO LOGIN
 */
Route::post('/user/register', array('as' => 'user.register', 'uses' => 'UserController@register'));
Route::post('/user/auth', array('as' => 'user.auth', 'uses' => 'UserController@auth'));
/**
 * ROTAS COM ACESSO APENAS COM LOGIN
 */
Route::group(array('before' => 'auth'), function(){
	Route::post('/category/lists', array('as' => 'category.list', 'uses' => 'CategoryController@lists'));
	Route::post('/marker/filter',array('as'=>'marker.filter','uses'=>'MarkerController@filter'));
	Route::post('/marker/create',array('as'=>'marker.create','uses'=>'MarkerController@create'));
	Route::post('/marker/like',array('as'=>'marker.like','uses'=>'MarkerController@like'));
	Route::post('/marker/unLike',array('as'=>'marker.unlike','uses'=>'MarkerController@unLike'));
	Route::post('/follow/follow',array('as'=>'follow.follow','uses'=>'FollowController@follow'));
	Route::post('/follow/unFollow',array('as'=>'follow.unfollow','uses'=>'FollowController@unFollow'));
});

Route::any('/dev/marker/popule', function(){
	$faker = \Faker\Factory::create();
	set_time_limit(600);
	while(1){
		$marker = new Marker();
		$marker->latitude = $faker->latitude;
		$marker->longitude = $faker->latitude;
		$marker->title = $faker->sentence();
		$marker->user = 1;
		$marker->date = $faker->dateTime();
		$marker->color = null;
		$marker->img = null;
		$marker->category = 1;
		$marker->type = 1;
		try {
			$marker->save();
		} catch (\Exception $e) {
			
		}
	}
	return 'ok';
});