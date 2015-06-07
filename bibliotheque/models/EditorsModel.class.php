<?php

class EditorsModel extends Model{

	public function getAll() {
		$sql = 'SELECT id, name FROM editors';
		$req = $this->connexion->prepare($sql);

		$req->execute();
		return $req->fetchAll();
	}

	public function getById($id) {
		$sql = 'SELECT editors.id, editors.name, editors.biography, editors.img_file FROM editors WHERE editors.id = :id';
		$req = $this->connexion->prepare($sql);

		$req->execute([':id' => $id]);
		return $req->fetch();
	}
	
	public function create( $name, $biography, $img ){
		$sql = 'INSERT INTO editors( name, biography, img_file )
				VALUES( :name, :biography, :img );';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':name' => $name,
			':biography' => $biography,
			':img' => $img,
		]);
	}

	public function delete( $id ){
		$sql = 'DELETE FROM editors WHERE editors.id = :id';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':id' => $id,
		]);
	}
}
