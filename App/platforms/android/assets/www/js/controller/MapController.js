app.controller("MapController",['$scope',function($scope){
	$scope.map = map;

	$scope.context ={
		USER:'#userContext',
		FAVORITE:'#userContext',
		SEARCH:'#userContext',
		MAP:'#userContext',
		MARKER_DETAILS:'#userContext',
	};

	$scope.showPosition = function(){
		return $scope.map.getMyLocation(function(location){
			var msg = ["Current your location:\n",
			"latitude:" + location.latLng.lat,
			"longitude:" + location.latLng.lng,
			"speed:" + location.speed,
			"time:" + location.time,
			"bearing:" + location.bearing].join("\n");
			alert(msg);
			mapHelper.addMarker(location.latLng.lat,location.latLng.lng,"title","teste2");
		}, function(msg){
			alert(msg);
		});
	}

	$scope.atualizar = function(){
		$scope.map.getMyLocation(function(location){
			WS.getMarker(location.latLng.lat,location.latLng.lng,function(data){
				mapHelper.clear();
				data.forEach(function(element, index){
					mapHelper.addMarker(element.latitude,element.longitude,element.title,"");
				});
			})
		});
	}
	
	$scope.testeAlert = function(txt){
		alert(txt);
	}

	$scope.stack = function(context){
		divStack.stack($(context));
	}

	$scope.unStack = function(){
		divStack.unStack();
	}

	$scope.clearStack = function(){
		divStack.clear();
	}
}]);