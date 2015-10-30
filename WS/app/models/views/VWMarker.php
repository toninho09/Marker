<?php

class VWMarker extends BaseModel {
	protected $table = 'VWMarker';

	/**
	 * FAZ O FILTRO PELA LATITUDE E LONGITUDE
	 * @param   $query    
	 * @param  FLOAT $lat      LATITUDE
	 * @param  FLOAT $long     LONGITUDE
	 * @param  float  $distance DISTANCIA APARTIR DO PONTO CENTRAL
	 * @return QUERY           
	 */
	public function scopefilterLatLong($query,$lat = null,$long = null,$distance = 0.2){
		if(is_numeric($long) && is_numeric($lat)){
			return $query = $query->whereBetween('latitude',[($lat-$distance),($lat+$distance)])
			->whereBetween('longitude',[($long-$distance),($long+$distance)]);
		}
	}

	/**
	 * FILTRA PELO USUARIO QUE CRIOU O MARKER
	 * @param   $query 
	 * @param  INT $user  ID DO USUARIO
	 * @return QUERY        
	 */
	public function scopefilterUser($query,$user = null){
		if($user){
			if(is_array($user)){
				return $query = $query->whereIn('userId',$user);
			}
			return $query = $query->where('userId',$user);
		}
	}

	/**
	 * FILTRA PELA CATEGORIA DO MARKER
	 * @param   $query    
	 * @param  INT $category ID DA CATEGORIA
	 * @return QUERY           
	 */
	public function scopefilterCategory($query,$category = null){
		if($category){
			if(is_array($category)){
				return $query = $query->whereIn('categoryId',$category);
			}
			return $query = $query->where('categoryId',$category);
		}		
	}

	/**
	 * FILTRA PELOS DIAS PASSADOS DESDE QUE FOI POSTADO O MARKER
	 * @param    $query 
	 * @param  INT $days  DIAS
	 * @return QUERY         
	 */
	public function scopepreviusDays($query,$days = 7){
		$dateMaker = date('Y-m-d',strtotime(date('Y-m-d')." - ".$days." days"));
		return $query->where('date','>=',$dateMaker);
	}
}
