<?php

class PagesController {

	private $authorsModel = null;
	private $yearsModel = null;
	private $editorsModel = null;
	private $languagesModel = null;
	private $librariesModel = null;
	private $categoriesModel = null;
	private $booksModel = null;

	public function __construct() {
		$this-> authorsModel = new AuthorsModel();
		$this-> yearsModel = new YearsModel();
		$this-> editorsModel = new EditorsModel();
		$this-> languagesModel = new LanguagesModel();
		$this-> librariesModel = new LibrariesModel();
		$this-> categoriesModel = new CategoriesModel();
		$this-> booksModel = new BooksModel();
	}


	public function admin(){
		if( !isset( $_SESSION['connected'] ) || $_SESSION['connected'] !== '1' ){
			header('Location: index.php?a=login&e=users' );
		}
		else if( $_SESSION['isAdmin'] == '0' ) {
			header('Location: index.php');
		}

		$data['authors'] = $this->authorsModel->getAll();
		$data['years'] = $this->yearsModel->getAll();
		$data['editors'] = $this->editorsModel->getAll();
		$data['languages'] = $this->languagesModel->getAll();
		$data['libraries'] = $this->librariesModel->getAll();
		$data['categories'] = $this->categoriesModel->getAll();

		$data['view'] = 'admin.php';
		return $data;
	}

	public function modify_book(){
		if( !isset( $_SESSION['connected'] ) || $_SESSION['connected'] !== '1' ){
			header('Location: index.php?a=login&e=users' );
		}
		else if( $_SESSION['isAdmin'] == '0' ) {
			header('Location: index.php');
		}

		// tu choppes toutes les références pour peupler les selects
		$data['authors'] = $this->authorsModel->getAll();
		$data['years'] = $this->yearsModel->getAll();
		$data['editors'] = $this->editorsModel->getAll();
		$data['languages'] = $this->languagesModel->getAll();
		$data['libraries'] = $this->librariesModel->getAll();
		$data['categories'] = $this->categoriesModel->getAll();

		// tu dois aussi chopper l'entrée correspondant à ton bouquin pour pouvoir mettre l'une ou l'autre option de tes select en selected

		$data['book'] = $this->booksModel->getIdsById($_GET['id']);

		//die(var_dump($data['book']));

		//die(var_dump($data));

		$data['view'] = 'modify_book.php';
		return $data;
	}

	function search_result(){
		// tu choppes toutes les références pour peupler les selects
		$data['authors'] = $this->authorsModel->getAll();
		$data['years'] = $this->yearsModel->getAll();
		$data['editors'] = $this->editorsModel->getAll();
		$data['languages'] = $this->languagesModel->getAll();
		$data['libraries'] = $this->librariesModel->getAll();
		$data['categories'] = $this->categoriesModel->getAll();

		// tu dois aussi chopper l'entrée correspondant à ton bouquin pour pouvoir mettre l'une ou l'autre option de tes select en selected

		//die($_POST['s']);
		$data['books_request'] = $this->booksModel->search($_POST['search_query']);

		//die(var_dump($data['books']));

		//die(var_dump($data));

		$data['view'] = 'search_result.php';
		return $data;
	}
} 