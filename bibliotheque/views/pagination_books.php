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
				</li>
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
				<li><a href="index.php">Accueil</a></li>
				<li><a class="page-active" href="index.php?a=pagination&e=books">Livres</a></li>
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
		<div id="favoris">
			<h1>
				nos livres
			</h1>
			<?php

			$books = $data['books'];

			foreach( $books as $book ): ?>
				<table summary = "liste de livres">
					<tbody>
						<tr>
							<th class="first"><a href="index.php?a=view&e=books&id=<?= $book->id; ?>"><?= $book->title; ?>
							</a></th>
							<th>auteur</th>
							<th>éditeur</th>
							<th>genre</th>
							<th class="last">emplacement</th>
						</tr>
						<tr>
							<td class="image"><img src="./img/cover/<?= $book->img_file ?>"></td>
							<td><a href="index.php?a=watchficheAuthor&e=authors&id=<?= $book->authorId ?>"><?= $book->author ?></a></td>
							<td><a href="index.php?a=watchficheEditor&e=editors&id=<?= $book->editorId ?>">bayard</a></td>
							<td><?= $book->category ?></td>
							<td><a href="index.php?a=watchficheLibrary&e=libraries&id=<?= $book->libraryId ?>">Marchin</a></td>
						</tr>
					</tbody>
					<hr class="delimit" />
				</table>
			<?php endforeach; ?>

			<?php for( $i = 1; $i < $data['totalPages']; ++$i ): ?>
				<a href="?a=pagination&e=books&page=<?= $i ?>"><?= $i ?></a>
				</a>
			<?php endfor; ?>
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