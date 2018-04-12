<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Calendrier en PHP</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/calendar.css">
	<title><?= isset($title) ? h($title) : 'Mon Calendrier'; ?></title>
</head>
<body>
<nav class="navbar navbar-dark bg-primary mb-3">
	<a href="/index.php"class="navbar-brand">Calendrier en PHP</a>
</nav>