<?php 

class UsersController{

	private $usersModel = null;

	public function __construct(){
		$this->usersModel = new UsersModel();
	}

	public function login(){
		$data['view'] = 'login_user.php';
		return $data;
	}

	public function check(){
		if( empty( $_REQUEST['username'] ) || empty( $_REQUEST['password'] ) ) {
			die( 'oops' );
		}

		$username = $_REQUEST['username'];
		$password = sha1( $_REQUEST['password'] );

		$user = $this->usersModel->get( $username, $password );

		if ( $user ) {
			$this->connect( $user->username, $user->id, $user->is_admin );
		}else{
			die( 'Erreur de connexion, utilisateur non présent dans la BDD');
		}
	}

	public function connect( $username, $id, $isAdmin ){

		if( $isAdmin == 1 ) {
			$_SESSION['isAdmin'] = '1';
		} else {
			$_SESSION['isAdmin'] = '0';
		}

		$_SESSION['user'] = $username;
		$_SESSION['id'] = $id;
		$_SESSION['connected'] = '1';
		header( 'Location: index.php?a=admin&e=pages' );
	}

	public function disconnect(){
		session_destroy();
		unset($_SESSION['user']);
		unset($_SESSION['connected']);
		header('Location: index.php?a=login&e=users');
	}

	public function register(){
		$data['view'] = 'register_user.php';
		return $data; 
	}

	public function create(){
		if( empty( $_REQUEST['username'] ) || empty( $_REQUEST['password'] ) ) {
			die( 'oops' );
		}

		$username = $_REQUEST['username'];
		$password = sha1( $_REQUEST['password'] );

		$this->usersModel->create( $username, $password);
		header( 'Location: index.php?a=login&e=users' );
	}

	public function modify(){
		if( empty( $_REQUEST['username'] ) || empty( $_REQUEST['password'] ) ) {
			die( 'oops' );
		}

		$username = $_REQUEST['username'];
		$password = sha1( $_REQUEST['password'] );

		$this->usersModel->create( $username, $password);
		header( 'Location: index.php?a=login&e=users' );
	}



	public function delete(){
		if( empty( $_REQUEST['username'] ) || empty( $_REQUEST['password'] ) ) {
			die( 'oops' );
		}

		$username = $_REQUEST['username'];
		$password = sha1( $_REQUEST['password'] );

		$this->usersModel->delete( $username, $password);
		header( 'Location: index.php?a=login&e=users' );
	}

}
