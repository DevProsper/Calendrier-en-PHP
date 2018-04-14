<?php
require '../src/bootstrap.php';
render('header', ['title' => 'Ajouter un article']);
$data = [
	'date' => $_GET['date'] ?? null
];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = $_POST;
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($_POST);
    if(empty($errors)){
		$events = new \Calendar\Events(getPDO());
		$event = $events->hydrate(new \Calendar\Event(), $data);
		$events->create($event);
		header('Location: /index.php?success=1');
		exit();
    }
}
?>
<div class="container">
	<?php if (!empty($errors)): ?>
		<div class="alert alert-danger">
			Merci de corriger vos erreurs :)
		</div>
	<?php endif ?>
	<h1>Ajouter un événement</h1>
	<form action="" method="post" class="form">
		<?php render('calendar/form_event', ['data' => $data, 'errors' => $errors])  ?>
		<div class="form-group">
			<button class="btn btn-primary">Ajouter l'événement</button>
		</div>
	</form>
</div>
<?php  ?>