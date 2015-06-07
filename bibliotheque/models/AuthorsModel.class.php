<?php

class AuthorsModel extends Model{

	public function getAll(){
		$sql = 'SELECT authors.id, authors.name FROM authors';
		$req = $this->connexion->prepare($sql);

		$req->execute();
		return $req->fetchAll();
	}

	public function getById($id){
		$sql = 'SELECT authors.id, authors.name, authors.biography, authors.img_file FROM authors WHERE authors.id = :id';
		$req = $this->connexion->prepare($sql);

		$req->execute([':id' => $id]);
		return $req->fetch();
	}

	public function create( $name, $biography, $img ) {
		$sql = 'INSERT INTO authors( name, biography, img_file )
				VALUES( :name, :biography, :img );';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':name' => $name,
			':biography' => $biography,
			':img' => $img,
		]);
	}

	public function delete( $id ){

		$sql = 'DELETE FROM authors WHERE authors.id = :id';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':id' => $id,
		]);
	}
}