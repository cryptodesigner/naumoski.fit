<?php
	require 'db.php';
	$meal_id = $_GET['meal_id'];
	$sql = 'SELECT * FROM meals WHERE meal_id=:meal_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':meal_id' => $meal_id ]);
	$meal = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  || isset($_POST['vreme'])  || isset($_POST['option1'])  || isset($_POST['option2'])  || isset($_POST['option3'])  || isset($_POST['date']) ) {
	  $name = $_POST['name'];
	  $vreme = $_POST['vreme'];

	  if(empty($_POST['option1'])){
	  	$option1 = 0;
	  }
	  else{
	  	$option1 = $_POST['option1'];
	  }

	  if(empty($_POST['option2'])){
	  	$option2 = 0;
	  }
	  else{
	  	$option2 = $_POST['option2'];
	  }

	  if(empty($_POST['option3'])){
	  	$option3 = 0;
	  }
	  else{
	  	$option3 = $_POST['option3'];
	  }

	  // $option1 = $_POST['option1'];
	  // $option2 = $_POST['option2'];
	  // $option3 = $_POST['option3'];
	  $date = $_POST['date'];
	  $sql = 'UPDATE meals SET name=:name, vreme=:vreme, option1=:option1, option2=:option2, option3=:option3, date=:date WHERE meal_id=:meal_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':vreme' => $vreme, ':option1' => $option1, ':option2' => $option2, ':option3' => $option3, ':date' => $date, ':meal_id' => $meal_id])) {
	    $message = 'Ажурирано Успешно';
	  }
	  else{
  		$message = 'Настанат проблем, обидете се повторно';
  	}
	}


	$sql = "SELECT * FROM options";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $options = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Уредување Диета на Клиент</span>
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
						<input value="<?= $meal->name; ?>" class="md-form-control" type="text" name="name" id="name"  placeholder="Име на Оброк">
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<select class="md-form-control" name="option1" id="option1" placeholder="Опција 1">
							<option value="" disabled="disabled" selected="selected">Опција 1</option>
							<?php foreach($options as $option): ?>
								<option value="<?= $option->option_id; ?>"><?= $option->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<select class="md-form-control" name="option2" id="option2" placeholder="Опција 2">
							<option value="" disabled="disabled" selected="selected">Опција 2</option>
							<?php foreach($options as $option): ?>
								<option value="<?= $option->option_id; ?>"><?= $option->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<select class="md-form-control" name="option3" id="option3" placeholder="Опција 3">
							<option value="" disabled="disabled" selected="selected">Опција 3</option>
							<?php foreach($options as $option): ?>
								<option value="<?= $option->option_id; ?>"><?= $option->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="md-form-group">
						<input value="<?= $meal->vreme; ?>" class="md-form-control" type="text" name="vreme" id="vreme" placeholder="Време">
					</div>
				</div>
				<div class="col-sm-5">
					<div class="md-form-group">
						<div class="md-form-group md-label-floating">
							<input value="<?= $meal->date; ?>" class="md-form-control" style="width: 38%;" name="date" id="date" type="date" data-format="dd/MM/yyyy" data-msg-required="Please enter date" required>
						</div>
					</div>
				</div>
				<button class="btn btn-default btn-block" type="submit">Ажурирај Диета</button>
			</div>
	  </form>
	</div>
</section>