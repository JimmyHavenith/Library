<?php

class LibrariesController{

	private $librariesModel = null;

	public function __construct(){
		$this->librariesModel = new LibrariesModel();
	}

	public function watchlibraries() {

		$data['libraries'] = $this->librariesModel->getAll();
		$data['view'] = "view_allLibraries.php";

		return $data;
	}

	public function watchficheLibrary(){

		if(isset($_REQUEST['id'])){

			$data['libraries'] = $this->librariesModel->getById($_REQUEST['id']);
			$data['view'] = "view_library.php";

			return $data;
		}
	}

	public function create(){
		if($_SERVER['REQUEST_METHOD'] != 'POST' ) {
			die('oops');
		} else {

			$sentName = $_POST['name'];
			$sentBio = $_POST['biography'];
			$sentImg = $_FILES['img_file']['name'];

			move_uploaded_file($_FILES['img_file']['tmp_name'], './img/libraries/' . $_FILES['img_file']['name']);
			$this -> librariesModel -> create( $sentName, $sentBio, $sentImg );

			header( 'Location: index.php' );
		}
	}

	public function delete(){
		if($_SERVER['REQUEST_METHOD'] != 'POST' ){
			die('oops');
		} else {
			$id = $_POST['id'];
			$this-> librariesModel -> delete( $id );
			header('Location: index.php?a=watchlibraries&e=libraries');
		}
	}
}