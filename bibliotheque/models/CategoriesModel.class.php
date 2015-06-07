<?php

class CategoriesModel extends Model{
	public function getAll() {
		$sql = 'SELECT id, name FROM categories';
		$req = $this->connexion->query($sql);
		return $req->fetchAll();
	}
}