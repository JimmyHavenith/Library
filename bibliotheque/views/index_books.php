<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>bibli</title>
	<link type="text/css" rel="stylesheet" href="./css/style.css" media="screen, projection" />
</head>
<body>
	<div id="header">
		<div id="headerTop">
			<ul class="connexion">
				<li>
					<?php if( isset($_SESSION['connected'] )) :?>
						<a href="index.php?a=disconnect&e=users">
							se deconnecter
						</a>
					<?php else :?>
						<a href="index.php?a=login&e=users">
							connexion
						</a>
					<?php endif; ?>
				<li>
					<?php if( isset( $_SESSION['connected'] ) && $_SESSION['isAdmin'] == '0' ): ?>
						<a href="index.php?a=watchfave&e=books" id="addfav">
							voir mes favoris
						</a>
					<?php endif ;?>
				</li>
			</ul>
			<form class="searchTop" action="index.php?a=search_result&e=pages" method="post">
				<input type="search" class="searchBar" placeholder="Rechercher un livre ici" name="search_query" id="query"/>
				<input class="envoyer" type="submit" value="OK !">
			</form>
		</div>
		<div id="headerDown">
			<h1>
				<a href="#"><span class="fWord">Biblio</span><span class="sWord">.com</span></a>
			</h1>
			<ul class="menu">
				<li><a class="page-active" href="#">Accueil</a></li>
				<li><a href="index.php?a=pagination&e=books">Livres</a></li>
				<li><a href="index.php?a=watchauthors&e=authors">Auteurs</a></li>
				<li><a href="index.php?a=watcheditors&e=editors">Éditeurs</a></li>
				<li><a href="index.php?a=watchlibraries&e=libraries">Bibliothèques</a></li>
				<?php if(isset($_SESSION['connected']) && $_SESSION['isAdmin'] == '1' ): ?>
					<li>
						<a href="index.php?a=admin&e=pages">
							Administration
						</a>
					</li>
				<?php endif; ?>
			</ul>
			<hr>
		</div>
	</div>
	<div id="content">
		<div class="news">
			<h2>Les nouveautés</h2>
			<h3>Disponibles dés maintenant !</h3>
			<ul class="livresNouveaux">
				<?php

				$books = $data['books'];

				foreach($books as $book): ?>
					<li>
						<a href="index.php?a=view&e=books&id=<?= $book->id; ?>">
							<img title="<?= $book->title ?>"src="./img/cover/<?= $book->img_file ?>">
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="searchMain">
			<h2>À la recherche d'un livre ?</h2>
			<h3>Faites une recherche ci-dessous pour trouver le livre de vos rêves !</h3>
			<form action="index.php?a=search_result&e=pages" method="post">
				<input type="search" class="searchBarBot" placeholder="Rechercher un livre ici" name="search_query" id="query"/>
				<input class="envoyerBot" type="submit" value="RECHERCHER">
			</form>
		</div>
	</div>
	<div id="footer">
		<p>
			© Copyright 2015 | Biblio.com | All rights reserved.
		</br>
			Created and developed by <a href="http://m.memegen.com/74ktsc.jpg">Jimmy Havenith</a>
		</p>
	</div>
</body>
</html>