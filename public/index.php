<?php
require '../src/bootstrap.php';
$pdo = getPDO();
$events = new \Calendar\Events($pdo);
$month = new Calendar\Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' .(6 +7 *($weeks-1)). ' days');
$events = $events->getEventsBetweenByDay($start, $end);

require '../views/header.php';
?>
<div class="calendar">
	<div class="container">
		<?php 
		if (isset($_GET['success'])) {
			?>
				<div class="alert alert-success">
					L'événement a bien été enregistrer
				</div>
			<?php	
		}
		?>
	</div>
	<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
	<h1><?= $month->toString();  ?></h1>
	<div>
		<a href="/index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>"
		   class="btn btn-primary">&lt</a>
		<a href="/index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>"
		   class="btn btn-primary">&gt</a>
	</div>
</div>
<table class="calendar__table calendar__table--<?= $weeks;?>weeks">
	<?php for($i = 0;  $i < $weeks; $i++):
		?>
		<tr>
			<?php foreach ($month->days as $k => $day): 
			$date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
				$eventForDay = $events[$date->format('Y-m-d')] ?? [];
				$isToday = date('Y-m-d') === $date->format('Y-m-d');
			?>
				<td class="<?= $month->withinMonth($date) ? '' : 'calendar_othermonth'; ?> <?= $isToday ? 'is-today' : ''; ?>">
					<?php if ($i === 0): ?>
						<div class="calendar__weekday">
							<?= $day; ?>
						</div>
					<?php endif ?>
					<a href="add.php?date=<?= $date->format('Y-m-d'); ?>" class="calendar__day">
						<?= $date->format('d'); ?>
					</a>
					<?php foreach ($eventForDay as $event): ?>
						<div class="calendar__event">
							<?= (new DateTime($event['start']))->format('H:i') ?>
							- <a href="/edit.php?id=<?= $event['id'];  ?>"><?= h($event['description']); ?></a>
						</div>
					<?php endforeach ?>

				</td>
			<?php endforeach ?>
			
		</tr>
	<?php endfor;?>
	<a href="/add.php" class="calendar__button">+</a>
</div>
<?php require '../views/footer.php'; ?>