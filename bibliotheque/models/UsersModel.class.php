<?php 

class UsersModel extends Model{

	public function get( $username, $password ){

		$sql = 'SELECT * FROM users WHERE username=:username AND password=:password';
		$pdost = $this->connexion->prepare($sql);
		$pdost->execute( [
			':username' => $username,
			':password' => $password
			] );
		return $pdost->fetch();
	}

	public function create( $username, $password ){

		$sql = 'INSERT INTO users(username, password) VALUES(:username, :password)';
		$pdost = $this->connexion->prepare($sql);
		$pdost->execute( [
			':username' => $username,
			':password' => $password
			] );
	}

	public function addToFaves( $userId, $bookId ) {
		$sql = 'INSERT INTO favourites( user_id, book_id ) VALUES( :user_id, :book_id )';
		$pdost = $this->connexion->prepare($sql);
		$pdost->execute( [
			':user_id' => $userId,
			':book_id' => $bookId
			] );
	}

	public function delToFaves( $userId, $bookId ) {
		$sql = 'DELETE FROM favourites WHERE user_id = :user_id AND book_id = :book_id';
		$pdost = $this->connexion->prepare($sql);
		$pdost->execute( [
			':user_id' => $userId,
			':book_id' => $bookId
			] );
	}

	public function watchAllFaves( $userId, $bookId ) {
		$sql = 'SELECT * FROM favourites WHERE user_id = :user_id AND book_id = :book_id';
		$pdost = $this->connexion->prepare($sql);
		$pdost->execute( [
			':user_id' => $userId,
			':book_id' => $bookId
 			] );
	}
}