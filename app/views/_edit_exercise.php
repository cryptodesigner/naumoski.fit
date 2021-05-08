<?php
	require 'db.php';
	$vezba_id = $_GET['vezba_id'];
	$sql = 'SELECT * FROM vezbi WHERE vezba_id=:vezba_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':vezba_id' => $vezba_id ]);
	$vezba = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  && isset($_POST['link_vezba'])  && isset($_POST['muskulna_grupa']) && isset($_POST['description']) ) {
	  $name = $_POST['name'];
	  $link_vezba = $_POST['link_vezba'];
	  $muskulna_grupa = $_POST['muskulna_grupa'];
	  $description = $_POST['description'];

	  $sql = 'UPDATE vezbi SET name=:name, link_vezba=:link_vezba, muskulna_grupa=:muskulna_grupa, description=:description WHERE vezba_id=:vezba_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':link_vezba' => $link_vezba, ':muskulna_grupa' => $muskulna_grupa, ':description' => $description, ':vezba_id' => $vezba_id])) {
	    // header("location: exercises.php");
	  }
	}
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Edit Exercise</span>
			</h1>
	  </div>
	  <form data-toggle="md-validator" action="" method="POST">
			<div class="row">
			  <div class="col-sm-6 col-sm-offset-3">
					<div class="demo-md-form-wrapper">
					
					<div class="md-form-group">
							<input value="<?= $vezba->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Exercise Name">
					</div>

					<div class="md-form-group">
							<input value="<?= $vezba->link_vezba; ?>" class="md-form-control" type="text" name="link_vezba" id="link_vezba" placeholder="Link na Vezba">
					</div>
					
					<div class="md-form-group">
						<select value="<?= $vezba->muskulna_grupa; ?>" class="md-form-control" name="muskulna_grupa" id="muskulna_grupa" data-msg="Muscle">
							<option value="" disabled="disabled" selected="selected">Muscle</option>
							<option value="Гради">Гради</option>
							<option value="Грб">Грб</option>
							<option value="Рамо">Рамо</option>
							<option value="Бицепс">Бицепс</option>
							<option value="Трицепс">Трицепс</option>
							<option value="Стомак">Стомак</option>
							<option value="Нозе">Нозе</option>
						</select>
					</div>
					
					<div class="md-form-group">
							<input value="<?= $vezba->description; ?>" class="md-form-control" type="text" name="description" id="description" placeholder="Description">
					</div>

					<button class="btn btn-default btn-block" type="submit">Update Exercise</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>