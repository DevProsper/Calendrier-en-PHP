<?php 
require '../vendor/autoload.php';
function dd(...$vars){
	foreach ($vars as $var) {
		echo "<pre>";
			print_r($var);
		echo "</pre>";
	}
}

function getPDO() : PDO{
	return $pdo = new PDO('mysql:host=localhost;dbname=calendar', 'root', '',[
    		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    	]);
}

function h(string $value = null): string{
	if($value == null){
		return '';
	}
	return htmlentities($value);
}

function e404(){
	require '../public/404.php';
	exit();
}

function render(string $view, $params = []){
	extract($params);
	include "../views/{$view}.php";
}