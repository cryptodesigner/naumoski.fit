<?php
	require 'db.php';
	$option_id = $_GET['option_id'];
	$sql = 'SELECT * FROM options WHERE option_id=:option_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':option_id' => $option_id ]);
	$option = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  && isset($_POST['sostojki'])  && isset($_POST['proteins'])  && isset($_POST['carbohydrates'])  && isset($_POST['fats'])  && isset($_POST['description']) ) {
	  $name = $_POST['name'];
	  $sostojki = $_POST['sostojki'];
	  $proteins = $_POST['proteins'];
	  $carbohydrates = $_POST['carbohydrates'];
	  $fats = $_POST['fats'];
	  $description = $_POST['description'];
	  $sql = 'UPDATE options SET name=:name, sostojki=:sostojki, proteins=:proteins, carbohydrates=:carbohydrates, fats=:fats, description=:description WHERE option_id=:option_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':sostojki' => $sostojki, ':proteins' => $proteins, ':carbohydrates' => $carbohydrates, ':fats' => $fats, ':description' => $description, ':option_id' => $option_id])) {
	    // header("location: meals.php");
	  }
	}
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Update Meal Option</span>
			</h1>
	  </div>
	  <form data-toggle="md-validator" action="" method="POST">
			<div class="row">
			  <div class="col-sm-6 col-sm-offset-3">
					<div class="demo-md-form-wrapper">
					
					<div class="md-form-group">
							<input value="<?= $option->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Meal Option Name">
					</div>

					<div class="md-form-group">
							<input value="<?= $option->sostojki; ?>" class="md-form-control" type="text" name="sostojki" id="sostojki" placeholder="Sostojki">
					</div>
					
					<div class="md-form-group">
							<input value="<?= $option->proteins; ?>" class="md-form-control" type="text" name="proteins" id="proteins" placeholder="Amount of Proteins">
					</div>
					
					<div class="md-form-group">
							<input value="<?= $option->carbohydrates; ?>" class="md-form-control" type="text" name="carbohydrates" id="carbohydrates" placeholder="Amount of Carbohydarates">
					</div>
					
					<div class="md-form-group">
							<input value="<?= $option->fats; ?>" class="md-form-control" type="text" name="fats" id="fats" placeholder="Amount of Fats">
					</div>

					<div class="md-form-group">
							<input value="<?= $option->description; ?>" class="md-form-control" type="text" name="description" id="description" placeholder="Description">
					</div>

					<button class="btn btn-default btn-block" type="submit">Update Meal Option</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>