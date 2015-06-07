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
			<h2 id="bouquin">
				Modifier ce livre ?  
			</h2>
			<form  class="formulaire" method="post" action="index.php?a=modify&e=books" enctype="multipart/form-data">
				<div>
					<input type="hidden" id="id" name="id" value="<?= $data['book']->id ?>">
					<input type="text" id="title" name="title" placeholder="titre" value="<?= $data['book']->title ?>">
					<select name="author" id="author">
						<?php foreach( $data['authors'] as $author ): ?>
							<option value = "<?= $author->id ?>" <?php if ($author->id==$data['book']->author_id) echo(' selected="selected"'); ?>> <?= $author->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="year" id="year">
						<?php foreach( $data['years'] as $year ): ?>
							<option value = "<?= $year->id ?>" <?php if ($year->id==$data['book']->year_id) echo(' selected="selected"'); ?>> <?= $year->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="editor" id="editor">
						<?php foreach( $data['editors'] as $editor ): ?>
							<option value="<?= $editor->id ?>" <?php if($editor->id==$data['book']->editor_id) echo(' selected="selected"'); ?>> <?= $editor->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="category" id="category">
						<?php foreach( $data['categories'] as $category ): ?>
							<option value = "<?= $category->id ?>" <?php if($category->id==$data['book']->category_id) echo(' selected="selected"'); ?>> <?= $category->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="library" id="library">
						<?php foreach( $data['libraries'] as $library ): ?>
							<option value = "<?= $library->id ?>" <?php if($library->id==$data['book']->library_id) echo(' selected="selected"'); ?>> <?= $library->name ?></option>
						<?php endforeach; ?>
					</select>
					<select name="language" id="language">
						<?php foreach( $data['languages'] as $language ): ?>
							<option value="<?= $language->id ?>" <?php if($language->id==$data['book']->language_id) echo('selected="selected"'); ?>> <?= $language->name ?></option>
						<?php endforeach; ?>
					</select>
					<img class="imgCourante" src="./img/cover/<?= $data['book']->img_file ?>"/>
					<input type="file" id="img_file" name="img_file">
					<textarea name="description" id="description" placeholder="resumé"><?= $data['book']->description ?></textarea>

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