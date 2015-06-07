<?php

class BooksModel extends Model{

	public function getRecent( $start, $count ){
		$sql ="SELECT books.id, books.title, books.description, books.img_file, categories.name as category, authors.id as authorId, authors.name as author, languages.name as language, libraries.id as libraryId, libraries.name as library, editors.id as editorId, editors.name as editor, years.name as year FROM books
               JOIN years ON books.year_id = years.id
               JOIN editors ON books.editor_id = editors.id
               JOIN authors ON books.author_id = authors.id 
               JOIN libraries ON books.library_id = libraries.id
               JOIN languages ON books.language_id = languages.id
               JOIN categories ON books.category_id = categories.id 
			   ORDER BY books.id desc LIMIT {$start}, {$count}";

		$requete = $this->connexion->query($sql);
		return $requete->fetchAll();

	}

	// authors = champs <-> id = table

	public function getById($id){ //Pour récuperer un seul livre

		$sql ='SELECT books.id AS book_id, books.title, books.description, books.img_file, categories.name as category, languages.name as language, libraries.id as libraryId, libraries.name as library, authors.id as authorId, authors.name as author, editors.id as editorId, editors.name as editor, years.name as year FROM books
               JOIN years ON books.year_id = years.id
               JOIN editors ON books.editor_id = editors.id
               JOIN authors ON books.author_id = authors.id 
               JOIN libraries ON books.library_id = libraries.id
               JOIN languages ON books.language_id = languages.id
               JOIN categories ON books.category_id = categories.id WHERE books.id = :id';

		$requete = $this->connexion->prepare($sql);

		$requete->execute([':id' =>$id]);
		return $requete->fetch();
	}


	// authors = champs <-> id = table

	public function getIdsById($id){ //Pour récuperer un seul livre

		$sql ='SELECT * FROM books WHERE id = :id';

		$requete = $this->connexion->prepare($sql);

		$requete->execute([':id' =>$id]);



		return $requete->fetch();
	}

	public function search($searchString)
	{
		$sql ="SELECT * FROM books WHERE title LIKE :querystring";

		$requete = $this->connexion->prepare($sql);

		$requete->execute([':querystring' =>'%'.$searchString.'%']);
		return $requete;
	}
	public function create( $title, $author, $year, $editor, $library, $language, $category, $description, $img ){

		$sql = 'INSERT INTO books( title, author_id, year_id, editor_id, library_id, language_id, category_id, description, img_file )
				VALUES( :title, :author_id, :year_id, :editor_id, :library_id, :language_id, :category_id, :description, :img );';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':title' => $title,
			':author_id' => $author,
			':year_id' => $year,
			':editor_id' => $editor,
			':library_id' => $library,
			':language_id' => $language,
			':category_id' => $category,
			':description' => $description,
			':img' => $img,
		]);
	}

	public function modify($id, $title, $author, $year, $editor, $library, $language, $category, $description, $img=null ) {

		if ($img!=null)
		{

			$sql = 'UPDATE books SET title=:title, author_id=:author_id, year_id=:year_id, editor_id=:editor_id, library_id=:library_id, language_id=:language_id, category_id=:category_id, description=:description, img_file=:img_file WHERE id=:id;';
			$data = [
					':id' => $id,
					':title' => $title,
					':author_id' => $author,
					':year_id' => $year,
					':editor_id' => $editor,
					':library_id' => $library,
					':language_id' => $language,
					':category_id' => $category,
					':description' => $description,
					':img_file' => $img
				];
			
		} else
		{
			$sql = 'UPDATE books SET title=:title, author_id=:author_id, year_id=:year_id, editor_id=:editor_id, library_id=:library_id, language_id=:language_id, category_id=:category_id, description=:description WHERE id=:id;';
			$data = [
					':id' => $id,
					':title' => $title,
					':author_id' => $author,
					':year_id' => $year,
					':editor_id' => $editor,
					':library_id' => $library,
					':language_id' => $language,
					':category_id' => $category,
					':description' => $description
				];
		}

		//die(var_dump($data));

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute($data);
	}

	public function delete( $id ) {
		$sql = 'DELETE FROM books WHERE books.id = :id';

		$pdost = $this -> connexion -> prepare( $sql );
		$pdost -> execute([
			':id' => $id,
		]);
	}

	public function count() {
		$sql = 'SELECT COUNT(*) AS total FROM books';
		$req = $this->connexion->query($sql);
		$data = $req->fetch();
		return $data->total;
	}

	public function getFavourites( $userId ){
		$sql = 'SELECT books.id as book_id,
					   books.title as title,
					   books.description as book_desc,
					   authors.id as author_id,
					   authors.name as author_name,
					   editors.id as editor_id,
					   editors.name as editor_name,
					   languages.name as language_name,
					   languages.id as language_id,
					   libraries.id as library_id,
					   libraries.name as library_name,
					   years.id as year_id,
					   years.name as year_name,
					   books.img_file as img_file,
					   categories.name as category_name,
					   category_id
				FROM Favourites
				JOIN books ON book_id = books.id
				JOIN authors ON author_id = authors.id
				JOIN editors ON editor_id = editors.id
				JOIN languages ON language_id = languages.id
				JOIN libraries ON library_id = libraries.id
				JOIN years ON year_id = years.id
				JOIN categories ON category_id = categories.id
				WHERE favourites.user_id = :id
				ORDER BY books.id DESC';
		$pdost = $this->connexion->prepare( $sql );
		$pdost -> execute( [
			':id' => $userId
		] );
		return $pdost -> fetchAll();
	}
}