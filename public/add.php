<?php
require '../src/bootstrap.php';
render('header', ['title' => 'Ajouter un article'])
?>
<div class="container">
	<h1>Ajouter un événement</h1>
	<form action="" method="post" class="form">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Titre</label>
					<input type="text" required class="form-control" name="name" id="name">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="date">Date</label>
					<input type="date" required class="form-control" name="date" id="date">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="start">Démarrage</label>
					<input type="time" placeholder="HH:MM" 
					class="form-control" required name="start" id="start">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="end">Fin</label>
					<input type="time" required class="form-control" name="end" id="end">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="description">Démarrage</label>
					<textarea type="text" placeholder="Description de l'événement" 
					class="form-control" name="description" id="description"></textarea>
				</div>
			</div>
		</div>

		<div class="form-group">
			<button class="btn btn-primary">Ajouter l'événement</button>
		</div>
	</form>
</div>
<?php  ?>