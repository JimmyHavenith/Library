<?php

session_start();
//Définition de l'include_path, à adapter selon votre configuration
set_include_path('configs;controllers;models;views;Helpers'.get_include_path());

// -------- enregistrement de la fonction à exécuter à chaque nouvelle instanciation
spl_autoload_register(function ($className) {
	include($className . '.class.php');
});

// -------- Gestion de la white list des routes
include('routes.php');

$routeParts = explode('/', $routes['default']);
//explode ca sert à diviser au slash et ca crée un tableau avec les deux valeurs

$a = isset($_REQUEST['a']) ? $_REQUEST['a'] : $routeParts[0]; //a = fonction = action
$e = isset($_REQUEST['e']) ? $_REQUEST['e'] : $routeParts[1]; //e = controller = entité

$route = $a . '/' . $e;
if(!in_array($route, $routes)){
	echo '404 page indisponible';
	die();
}

//Détermination du controler à utiliser
$controllerName = ucfirst($e) . 'Controller';
$controller = new $controllerName;

//Exécution de a fonction correspondant à l'action demandée
$data = call_user_func([$controller, $a]);

include($data['view']);	

