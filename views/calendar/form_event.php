<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Titre</label>
					<input type="text" value="<?= isset($data['name']) ? h($data['name']) : ''; ?>" class="form-control" name="name" id="name">
					<?php if (isset($errors['name'])): ?>
						<p class="help-block"><?= $errors['name']; ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="date">Date</label>
					<input type="date" value="<?= isset($data['date']) ? h($data['date']) : ''; ?>" class="form-control" name="date" id="date">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="start">Démarrage</label>
					<input type="time" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>" placeholder="HH:MM" 
					class="form-control" name="start" id="start">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="end">Fin</label>
					<input type="time" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>" class="form-control" name="end" id="end">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="description">Démarrage</label>
					<textarea type="text" placeholder="Description de l'événement" 
					class="form-control" name="description" id="description"><?= isset($data['description']) ? h($data['description']) : ''; ?></textarea>
				</div>
			</div>
		</div>