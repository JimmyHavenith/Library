<?php 

class BooksController{

	private $books = null;
	private $userModel = null;
	private $editors = null;

	public function __construct(){
		$this->books = new BooksModel();
		$this->usersModel = new UsersModel();
		$this->editors = new EditorsModel();

	}

	function index(){
		$data['books'] =  $this->books->getRecent(0,5);

		$data['view'] = "index_books.php";

		return $data;
	}

	public function view(){
		if( isset($_REQUEST['id']) ){
			$isInFavourites = false;
			if( isset($_SESSION['connected']) ){
				$favourites = $this->books->getFavourites($_SESSION['id']);
				foreach( $favourites as $book ) {
					if( $_REQUEST['id'] == $book->book_id) {
						$isInFavourites = true;
					}
				}
			}
			$data['book'] = $this->books->getById($_REQUEST['id']);
			$data['view'] = "view_book.php";
			$data['isInFavourites'] = $isInFavourites;
			return $data;

		} else{
			die('oops');
		}
	}

	public function create(){
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			die('oops');
		} else{

		var_dump($_POST);
		$sentTitle = $_POST['title'];
		$sentAuthor = $_POST['author'];
		$sentYear = $_POST['year'];
		$sentEditor = $_POST['editor'];
		$sentLanguage = $_POST['language'];
		$sentLibrary = $_POST['library'];
		$sentCategory = $_POST['category'];
		$sentDesc = $_POST['description'];
		$sentImg = $_FILES['img_file']['name'];

		move_uploaded_file($_FILES['img_file']['tmp_name'], './img/cover/' . $_FILES['img_file']['name']); //Pour pouvoir enregistrer les images dans le dossier

		$this -> books -> create( $sentTitle, $sentAuthor, $sentYear, $sentEditor, $sentLanguage, $sentLibrary, $sentCategory, $sentDesc, $sentImg ); //Pour envoyer les données dans la base de donnée

		header('Location: index.php'); //Pour pouvoir rediriger directement vers l'index, ATTENTION-> pas d'espace avant les " : "

		} 
	}

	public function modify(){
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			die('oops');
		} else {
			//die(var_dump($_POST));
			$id = $_POST['id'];
			$modifTitle = $_POST['title'];
			$modifAuthor = $_POST['author'];
			$modifYear = $_POST['year'];
			$modifEditor = $_POST['editor'];
			$modifLanguage = $_POST['language'];
			$modifLibrary = $_POST['library'];
			$modifCategory = $_POST['category'];
			$modifDesc = $_POST['description'];
			
			if (isset($_FILES['img_file']) && isset($_FILES['img_file']['name']) && $_FILES['img_file']['name']!="")
			{
				$modifImg = $_FILES['img_file']['name'];
				move_uploaded_file($_FILES['img_file']['tmp_name'], './img/cover/' . $_FILES['img_file']['name']);
			} else
			{
				$modifImg = null;
			}
			

			$this -> books -> modify( $id, $modifTitle, $modifAuthor, $modifYear, $modifEditor, $modifLanguage, $modifLibrary, $modifCategory, $modifDesc, $modifImg );

			header( 'Location: index.php' );
		}
	}

	public function delete(){
		if($_SERVER['REQUEST_METHOD'] != 'POST' ){
			die('oops');
		} else {
			$id = $_POST['id'];
			$this-> books -> delete( $id );
			header('Location: index.php');
		}
	}

	public function pagination(){
		// On compte le nombre de livre dans la table et on calcule le nb de pages que ca donne
		$totalBooks = $this->books->count();
		// On décide du nombre de livres à afficher sur une page
		$perPage = 2;
		//On calcule le premier livre à récuperer
		$start = Paginate::getStart( $perPage, $totalBooks );
		//On récupère les livres
		$data['books'] = $this -> books -> getRecent( $start, $perPage );
		//On précise le nom de la vue à utiliser
		$data['view'] = "pagination_books.php";
		$data['totalPages'] = Paginate::getTotal( $totalBooks, $perPage );
		return $data;
	} 

	public function addfave() {
		if( !isset( $_GET['id'] ) ){
			die('heu non');
		} else if( !isset($_SESSION['id']) ){
			die('heu tu n es pas connecter');
		}

		$userId = $_SESSION['id'];
		$bookId = $_GET['id'];

		$this->usersModel->addToFaves( $userId, $bookId );
		header('Location: index.php?a=view&e=books&id='.$_GET['id']);
	}

	public function delfave() {
		if( !isset( $_GET['id'] ) ){
			die('heu non');
		} else if( !isset($_SESSION['id']) ){
			die('heu tu n es pas connecter');
		}

		$userId = $_SESSION['id'];
		$bookId = $_GET['id'];

		$this->usersModel->delToFaves( $userId, $bookId );
		header('Location: index.php?a=view&e=books&id='.$_GET['id']);
	}

	public function watchfave() {
		if( !isset($_SESSION['id']) ){
			die('heu tu n es pas connecter');
		}

		$userId = $_SESSION['id'];

		$this->books->getFavourites( $userId );
		$data['books'] = $this->books->getFavourites( $userId ); 
		$data['view'] = 'favourites_user.php';
		return $data;
	}
}
