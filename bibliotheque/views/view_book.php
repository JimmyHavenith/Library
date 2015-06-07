<?php $book = $data['book']; ?>


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
		<div id="fiche">
			<h1><?= $book->title; ?></h1>
			<h2>
				Par <a href="index.php?a=watchficheAuthor&e=authors&id=<?= $book->authorId; ?>"><?= $book->author ?></a>
			</h2>	
			<p>
				<img alt="bouquin" src="./img/cover/<?= $book->img_file ?>">
			</p>
			<table summary = "informations sur le livres">
				<tbody>
					<tr>
						<th>éditeur</th>
						<th>genre</th>
						<th>emplacement</th>
						<th>langue</th>
						<th>date</th>
					</tr>
					<tr>
						<td><a href="index.php?a=watchficheEditor&e=editors&id=<?= $book->editorId ; ?>"><?= $book->editor ?></a></td>
						<td><?= $book->category ?></td>
						<td><a href="index.php?a=watchficheLibrary&e=libraries&id=<?= $book->libraryId; ?>"><?= $book->library ?></a></td>
						<td><?= $book->language ?></td>
						<td><?= $book->year ?></td>
					</tr>
				</tbody>
			</table>
			<p class="description"><?= $book->description ?></p>
		</div>
		<div id="pageUser">
			<ul>
				<?php if( isset($_SESSION['connected'] ) && $_SESSION['isAdmin'] == '0' ): ?>
					<?php if( $data['isInFavourites'] ): ?>
						<li><a class="del" href="index.php?a=delfave&e=books&id=<?= $book->book_id ?>" id="supprimer"> supprimer </a></li>
					<?php else: ?>
					<li><a class="add" href="index.php?a=addfave&e=books&id=<?= $book->book_id ?>" id="ajouter"> ajouter </a></li>
					<?php endif; ?>
				<?php endif; ?>
				<?php if( isset($_SESSION['connected'] ) && $_SESSION['isAdmin'] == '0' ): ?>
					<li><a class="watch" href="index.php?a=watchfave&e=books&id=<?= $book->book_id ?>" id="watchfav"> voir mes favoris </a></li>
				<?php endif; ?>
				<?php if( isset($_SESSION['connected'] ) && $_SESSION['isAdmin'] == '1' ): ?>
					<form class="formulaire" method="post" action="index.php?a=delete&e=books" enctype="multipart/form-data">
						<div>
							<input type="hidden" name="id" value="<?= $book->book_id ?>">
							<input type="submit" id="supprimerBook" value="supprimer">
						</div>	
					</form>
				<?php endif; ?>				
				<?php if( isset($_SESSION['connected'] ) && $_SESSION['isAdmin'] == '1' ): ?>
					<li><a id="modifyBook" class="modify" href="index.php?a=modify_book&e=pages&id=<?= $book->book_id ?>" id="watchfav"> modifier </a></li>
				<?php endif; ?>
			</ul>
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