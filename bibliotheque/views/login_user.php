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
		<div id="pageConnexion">
			<h1>
				se connecter
			</h1>
			<div id="connect">
				<div id="phrase">
					<h2>
						Vous tentez d'accéder à un contenu qui nécessite  que vous soyez connecté(e).
					</h2>
				</div>
				<form class="connectProfil" method="post" action="index.php?a=check&e=users">
						<input type="text" name="username" placeholder="votre pseudo">
						<input class="mdp" name="password" type="password" placeholder="votre mot de passe">
						<p>
							<input type="submit" id="valider" value="valider">
						</p>
				</form>
			</div>
			<div id="createAccount">
				<h3>
					Vous n'avez pas de compte sur Biblio.com ? 
				</h3>
				<p>
					C'est rapide, gratuit, et vous permettra de créer votre propre liste de livres... 
				</p>
				<ul>
					<li>
						<a href="index.php?a=register&e=users">
							s'inscrire
						</a>
					</li>
				</ul>
					<!-- <input type="submit" id="create" value="create"> -->
			</div>
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