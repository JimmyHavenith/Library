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
						<a class="page-active" href="index.php?a=admin&e=pages">
							Administration
						</a>
					</li>
				<?php endif; ?>
			</ul>
			<hr>
		</div>
	</div>
	<div id="content">
		<div id="pageAdmin">
			<h1>
				Administration 
			</h1>
			<ul class="ancre">
				<li><a href="#bouquin">Ajouter un livre</a></li>
				<li><a href="#auteur">Ajouter un auteur</a></li>
				<li><a href="#editeur">Ajouter un editeur</a></li>
				<li><a href="#biblio">Ajouter une bibliothèque</a></li>
			</ul>
			<h2 id="bouquin">
				Ajouter un livre à la bibliothèque ? 
			</h2>
			<form  class="formulaire" method="post" action="index.php?a=create&e=books" enctype="multipart/form-data">
				<div>
					<input type="text" id="title" name="title" placeholder="titre">
					<select name="author" id="author">
						<?php foreach( $data['authors'] as $author ): ?>
							<option value = "<?= $author->id ?>"> <?= $author->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="year" id="year">
						<?php foreach( $data['years'] as $year ): ?>
							<option value = "<?= $year->id ?>"> <?= $year->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="editor" id="editor">
						<?php foreach( $data['editors'] as $editor ): ?>
							<option value="<?= $editor->id ?>"> <?= $editor->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="category" id="category">
						<?php foreach( $data['categories'] as $category ): ?>
							<option value = "<?= $category->id ?>"> <?= $category->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="library" id="library">
						<?php foreach( $data['libraries'] as $library ): ?>
							<option value = "<?= $library->id ?>"> <?= $library->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="language" id="language">
						<?php foreach( $data['languages'] as $language ): ?>
							<option value="<?= $language->id ?>"> <?= $language->name ?></option>
						<?php endforeach; ?>
					</select>
					<input type="file" id="img_file" name="img_file">
					<textarea name="description" id="description" placeholder="resumé"></textarea>

					<input id="validerLivre" type="submit">
				</div>
			</form>
			<h2 id="auteur">
				Ajouter un auteur à la bibliothèque ? 
			</h2>
			<form class="formulaire" method="post" action="index.php?a=create&e=authors" enctype="multipart/form-data">
				<div>
					<input type="text" id="name" name="name" placeholder="nom de l'auteur">
					<input type="file" id="img_file" name="img_file">
					<textarea name="biography" id="biography" placeholder="biographie de l'auteur"></textarea>

					<input id="validerLivre" type="submit">
				</div>
			</form>
			<h2 id="editeur">
				Ajouter un éditeur à la bibliothèque ? 
			</h2>
			<form class="formulaire" method="post" action="index.php?a=create&e=editors" enctype="multipart/form-data">
				<div>
					<input type="text" id="name" name="name" placeholder="nom de l'editeur">
					<input type="file" id="img_file" name="img_file">
					<textarea name="biography" id="biography" placeholder="description de l'éditeur"></textarea>

					<input id="validerLivre" type="submit">
				</div>
			</form>
			<h2 id="biblio">
				Ajouter une bibliothèque ? 
			</h2>
			<form class="formulaire" method="post" action="index.php?a=create&e=libraries" enctype="multipart/form-data">
				<div>
					<input type="text" id="name" name="name" placeholder="nom de la bibliothèque">
					<input type="file" id="img_file" name="img_file">
					<textarea name="biography" id="biography" placeholder="description de la bibliothèque"></textarea>

					<input id="validerLivre" type="submit">
				</div>
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