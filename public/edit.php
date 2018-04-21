<?php
require '../src/bootstrap.php';
$pdo = getPDO();
$events = new \Calendar\Events($pdo);
$errors = [];

try {
    $event = $events->find($_GET['id'] ?? null);
} catch (Exception $e) {
    e404();
}catch (Error $e) {
    e404();
}
$data = [
    'name' => $event->getName(),
    'description' => $event->getDescription(),
    'date' => $event->getStart()->format('Y-m-d'),
    'start' => $event->getEnd()->format('H:i'),
    'end' => $event->getEnd()->format('H:i')
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($data);
    if(empty($errors)){
        $events->hydrate($event, $data);
        $events->update($event);
        header('Location: /index.php?success=1');
        exit();
    }
}
render('header', ['title' => $event->getName()]);
?>
<div class="container">
    <h1>Editer l'événement : <?= h($event->getName()); ?></h1>
    <form action="" method="post" class="form">
        <?php render('calendar/form_event', ['data' => $data, 'errors' => $errors])  ?>
        <div class="form-group">
            <button class="btn btn-primary">Modifier l'événement</button>
        </div>
    </form>
</div>
<?php require '../views/footer.php'; ?>