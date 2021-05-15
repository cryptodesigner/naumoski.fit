<?php
	require 'db.php';
	$schedule_id = $_GET['schedule_id'];
	$sql = 'SELECT * FROM schedules WHERE schedule_id=:schedule_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':schedule_id' => $schedule_id ]);
	$schedule = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['stanuvanje'])  && isset($_POST['legnuvanje'])  && isset($_POST['rabota'])  && isset($_POST['pauzi'])  && isset($_POST['trening'])  && isset($_POST['cardio'])  && isset($_POST['description']) ) {
	  $stanuvanje = $_POST['stanuvanje'];
	  $legnuvanje = $_POST['legnuvanje'];
	  $rabota = $_POST['rabota'];
	  $pauzi = $_POST['pauzi'];
	  $trening = $_POST['trening'];
	  $cardio = $_POST['cardio'];
	  $description = $_POST['description'];
	  $sql = 'UPDATE schedules SET stanuvanje=:stanuvanje, legnuvanje=:legnuvanje, rabota=:rabota, pauzi=:pauzi, trening=:trening, cardio=:cardio, description=:description WHERE schedule_id=:schedule_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':stanuvanje' => $stanuvanje, ':legnuvanje' => $legnuvanje, ':rabota' => $rabota, ':pauzi' => $pauzi, ':trening' => $trening, ':cardio' => $cardio, ':description' => $description, ':schedule_id' => $schedule_id])) {
	    $message = 'Ажурирано Успешно';
	  }
	  else{
  		$message = 'Настанат проблем, обидете се повторно';
  	}
	}
?>

<section>
	<div class="layout-content-body">
  <div class="title-bar">
		<h1 class="title-bar-title">
		  <span class="d-ib">Уредување на Распоред</span>
		</h1>
		<?php if(!empty($message)): ?>
      <div class="alert alert-success">
        <?= $message; ?>
      </div>
    	<?php endif; ?>
  </div>
  <form data-toggle="md-validator" action="" method="POST">
		<div class="row">
		  <div class="col-sm-6 col-sm-offset-3">
				<div class="md-form-group">
				  <select class="md-form-control" name="stanuvanje" id="stanuvanje" data-msg-required="Vreme na budenje" required>
						<option value="" disabled="disabled" selected="selected">Време на Будење</option>
						<option value="05:00">05:00</option>
						<option value="05:30">05:30</option>
						<option value="06:00">06:00</option>
						<option value="06:30">06:30</option>
						<option value="07:00">07:00</option>
						<option value="07:30">07:30</option>
						<option value="08:00">08:00</option>
						<option value="08:30">08:30</option>
						<option value="09:00">09:00</option>
						<option value="09:30">09:30</option>
						<option value="10:00">10:00</option>
						<option value="10:30">10:30</option>
						<option value="11:00">11:00</option>
						<option value="11:30">11:30</option>
						<option value="12:00">12:00</option>
				  </select>
				</div>
				<div class="md-form-group">
		  		<select class="md-form-control" name="legnuvanje" id="legnuvanje" data-msg-required="Vreme na legnuvanje" required>
						<option value="" disabled="disabled" selected="selected">Време на Заспивање</option>
						<option value="21:00">21:00</option>
						<option value="21:30">21:30</option>
						<option value="22:00">22:00</option>
						<option value="22:30">22:30</option>
						<option value="23:00">23:00</option>
						<option value="23:30">23:30</option>
						<option value="00:00">00:00</option>
						<option value="00:30">00:30</option>
						<option value="01:00">01:00</option>
						<option value="01:30">01:30</option>
						<option value="02:00">02:00</option>
						<option value="02:30">02:30</option>
						<option value="03:00">03:00</option>
						<option value="03:30">03:30</option>
						<option value="04:00">04:00</option>
		  		</select>
				</div>
				<div class="md-form-group">
				  <input value="<?= $schedule->rabota; ?>" class="md-form-control" type="text" name="rabota" id="rabota" placeholder="Работа / Школо (од - до) ако има смени (од - до)">
				</div>
				<div class="md-form-group">
				  <input value="<?= $schedule->pauzi; ?>" class="md-form-control" type="text" name="pauzi" id="pauzi" placeholder="Пауза (од - до)">
				</div>
				<div class="md-form-group">
				  <input value="<?= $schedule->trening; ?>" class="md-form-control" type="text" name="trening" id="trening" placeholder="Тренинг (преферирано време)">
				</div>
				<div class="md-form-group">
				  <input value="<?= $schedule->cardio; ?>" class="md-form-control" type="text" name="cardio" id="cardio" placeholder="Кардио (преферирано време)">
				</div>
				<div class="md-form-group">
				  <input value="<?= $schedule->description; ?>" class="md-form-control" type="text" name="description" id="description" placeholder="Други Физички Активности">
				</div>
				<button class="btn btn-default btn-block" type="submit">Ажурирај Распоред</button>
	  	</div>
		</div>
  </form>
</div>
</section>