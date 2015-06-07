<?php

class EditorsController{

	private $editorsModel = null;

	public function __construct(){
		$this->editorsModel = new EditorsModel();
	}

	public function watcheditors() {

		$data['editors'] = $this->editorsModel->getAll();
		$data['view'] = "view_allEditors.php";

		return $data;
	}

	public function watchficheEditor() {
		if( isset( $_REQUEST['id'] ) ) {

			$data['editors'] = $this->editorsModel->getById( $_REQUEST['id'] );
			$data['view'] = "view_editor.php";

			return $data;
		}
	}

	public function create(){
		if($_SERVER['REQUEST_METHOD'] != 'POST' ) {
			die('oops');
		} else {

			var_dump($_POST);
			$sentName = $_POST['name'];
			$sentBio = $_POST['biography'];
			$sentImg = $_FILES['img_file']['name'];

			move_uploaded_file($_FILES['img_file']['tmp_name'], './img/editors/' . $_FILES['img_file']['name']);	 //Pour pouvoir enregistrer les images dans le dossier
			$this -> editorsModel -> create( $sentName, $sentBio, $sentImg );

			header( 'Location: index.php' );
		}
	}

	public function delete(){
		if($_SERVER['REQUEST_METHOD'] != 'POST' ){
			die('oops');
		} else {
			$id = $_POST['id'];
			$this-> editorsModel -> delete( $id );
			header('Location: index.php?a=watcheditors&e=editors');
		}
	}
}