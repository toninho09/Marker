var mapHelper = {
	map : null,
	init : function(map){
		this.map = map;
	},
	addMarker: function(latitude,longitude,title,snippet){
		this.map.addMarker({
			'position': new plugin.google.maps.LatLng(latitude, longitude),
			'title': title,
			'snippet': snippet
		}, function(marker) {
		  marker.showInfoWindow();
		});
	},
	clear : function(){
		this.map.clear();
	}

}