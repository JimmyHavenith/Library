<?php 

class AuthorsController{

	private $authorsModel = null;

	public function __construct(){
		$this->authorsModel = new AuthorsModel();

	}

	public function watchauthors() {

		$data['authors'] = $this->authorsModel->getAll();
		$data['view'] = "view_allAuthors.php";

		return $data;
	}

	public function watchficheAuthor() {
		if( isset($_REQUEST['id']) ) {

			$data['authors'] = $this->authorsModel->getById($_REQUEST['id']);
			$data['view'] = "view_author.php";

			return $data;	
		}
	
	}

	public function create(){
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			die('oops');
		} else{

		var_dump($_POST);
		$sentName = $_POST['name'];
		$sentBio = $_POST['biography'];
		$sentImg = $_FILES['img_file']['name'];

		move_uploaded_file($_FILES['img_file']['tmp_name'], './img/authors/' . $_FILES['img_file']['name']); //Pour pouvoir enregistrer les images dans le dossier

		$this -> authorsModel -> create( $sentName, $sentBio, $sentImg ); //Pour envoyer les données dans la base de donnée

		header('Location: index.php'); //Pour pouvoir rediriger directement vers l'index, ATTENTION-> pas d'espace avant les " : "

		} 
	}

	public function delete(){
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			die('oops');
		}else{
			$id = $_POST['id'];
			$this-> authorsModel -> delete( $id );
			header('Location: index.php?a=watchauthors&e=authors');
		}
	}
}
