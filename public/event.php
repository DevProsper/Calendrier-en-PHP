<?php
require '../src/bootstrap.php';
$pdo = getPDO();
$events = new \Calendar\Events($pdo);
if (!isset($_GET['id'])) {
	header('Location: 404.php');
}
try {
	$event = $events->find($_GET['id']);	
} catch (Exception $e) {
	e404();
}
render('header', ['title' => $event->getName()]);
?>
<div class="container">
	<h1>Evenement : <?= h($event->getName()); ?></h1>
	<p>Date : <?= $event->getStart()->format('d/m/Y'); ?></p>
	<p>Date : <?= $event->getStart()->format('H:i'); ?></p>
	<p>Date : <?= $event->getEnd()->format('H:i'); ?></p>
	<p>Description : <?= h($event->getDescription()); ?></p>
</div>
<?php require '../views/footer.php'; ?>