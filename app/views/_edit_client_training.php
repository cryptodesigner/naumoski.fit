<?php
	require 'db.php';
	$training_id = $_GET['training_id'];
	$sql = 'SELECT * FROM trainings WHERE training_id=:training_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':training_id' => $training_id ]);
	$training = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  && isset($_POST['vreme'])  && isset($_POST['vezba'])  && isset($_POST['serii_povt'])  && isset($_POST['tech'])  && isset($_POST['date']) ) {
	  $name = $_POST['name'];
	  $vreme = $_POST['vreme'];
	  $vezba = $_POST['vezba'];
	  $serii_povt = $_POST['serii_povt'];
	  $tech = $_POST['tech'];
	  $date = $_POST['date'];
	  $sql = 'UPDATE trainings SET name=:name, vreme=:vreme, vezba=:vezba, serii_povt=:serii_povt, tech=:tech, date=:date WHERE training_id=:training_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':vreme' => $vreme, ':vezba' => $vezba, ':serii_povt' => $serii_povt, ':tech' => $tech, ':date' => $date, ':training_id' => $training_id])) {
	    $message = 'Ажурирано Успешно';
	  }
	  else{
  		$message = 'Настанат проблем, обидете се повторно';
  	}
	}

	$sql = "SELECT * FROM tehniki";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $tehniki = $statement->fetchAll(PDO::FETCH_OBJ);

  $sql = "SELECT * FROM vezbi";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $exercises = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Уредување Тренинг на Клиент</span>
			</h1>
			<?php if(!empty($message)): ?>
      <div class="alert alert-success">
        <?= $message; ?>
      </div>
    	<?php endif; ?>
	  </div>
	  <form data-toggle="md-validator" action="" method="POST">
	  	<div class="row">
				<div class="col-sm-3">
					<div class="md-form-group">
						<input value="<?= $training->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Име На Тренинг">
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<select class="md-form-control" name="vezba" id="vezba" placeholder="Вежба">
							<option value="" disabled="disabled" selected="selected">Вежба</option>
							<?php foreach($exercises as $ex): ?>
								<option value="<?= $ex->vezba_id; ?>"><?= $ex->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<input value="<?= $training->serii_povt; ?>" class="md-form-control" type="text" name="serii_povt" id="serii_povt" placeholder="Серии">
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<select class="md-form-control" name="tech" id="tech" placeholder="Техника">
							<option value="" disabled="disabled" selected="selected">Техника</option>
							<?php foreach($tehniki as $t): ?>
								<option value="<?= $t->tehnika_id; ?>"><?= $t->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<input value="<?= $training->vreme; ?>" class="md-form-control" type="text" name="vreme" id="vreme" placeholder="Време">
					</div>
				</div>
				<div class="col-sm-5">
					<div class="md-form-group">
						<div class="md-form-group md-label-floating">
							<input value="<?= $training->date; ?>" class="md-form-control" style="width: 38%;" name="date" id="date" type="date" data-format="dd/MM/yyyy" data-msg-required="Please enter date" required>
						</div>
					</div>
				</div>
				<button class="btn btn-default btn-block" type="submit">Ажурирај Тренинг</button>
			</div>
	  </form>
	</div>
</section>