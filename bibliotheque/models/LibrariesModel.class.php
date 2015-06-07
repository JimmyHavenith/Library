<?php

class LibrariesModel extends Model{

	public function getAll() {
		$sql = 'SELECT id, name FROM libraries';
		$req = $this->connexion->prepare($sql);

		$req->execute();
		return $req->fetchAll();
	}

	public function getById($id) {
		$sql = 'SELECT libraries.id, libraries.name, libraries.biography, libraries.img_file FROM libraries WHERE libraries.id = :id';
		$req = $this->connexion->prepare($sql);

		$req->execute([':id' => $id]);
		return $req->fetch();
	}

	public function create( $name, $biography, $img ){
		$sql = 'INSERT INTO libraries( name, biography, img_file )
				VALUES( :name, :biography, :img);';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':name' => $name,
			':biography' => $biography, 
			':img' => $img,
		]);
	}

	public function delete( $id ) {
		$sql = 'DELETE FROM libraries WHERE libraries.id = :id';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':id' => $id,
		]);
	}
}