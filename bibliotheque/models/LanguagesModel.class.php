<?php

class LanguagesModel extends Model{
	public function getAll() {
		$sql = 'SELECT id, name FROM languages';
		$req = $this->connexion->query($sql);
		return $req->fetchAll();
	}
}