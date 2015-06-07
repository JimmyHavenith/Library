<?php

if(!defined('DB_NAME')){
	define('DB_NAME', 'bibliotheque');
}
if(!defined('USER_NAME')){
	define('USER_NAME', 'root');
}
if(!defined('PASSWORD')){
	define('PASSWORD', '');
}
if(!defined('HOST_NAME')){
	define('HOST_NAME', 'localhost');
}

$db_options = [
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

//FETCH_OBJ = $book->titre
//FETCH_ASSOC = $book['titre']

