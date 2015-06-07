<?php

class YearsModel extends Model{
	public function getAll() {
		$sql = 'SELECT id, name FROM years';
		$req = $this->connexion->query($sql);
		return $req->fetchAll();
	}
}