<?php 

class Paginate{

	public static function getStart( $perPage, $totalBooks ){
		$totalPages = self::getTotal( $totalBooks, $perPage );
		$page = self::getPage( $totalPages );
		$start = ( $page > 1 ) ? ( $page * $perPage ) - $perPage : 0;
		// condition ? CALCUL SI >1 - SINON on revient à 0 qui est = à la page 1
		return $start;
	}

	public static function getPage( $totalPages ){
		if( isset( $_GET['page'] ) ){
			$page = intval( $_GET['page'] );
			if( $page > $totalPages ){
				$page = $totalPages;
			}
		} else {
			$page = 1;
		}
		return $page;
	}

	// cv diviser le nb total de livre que tu as pas le nombre par page 
	public static function getTotal( $totalBooks, $perPage ){
		return ceil( $totalBooks / $perPage );
	}
}