<?php
	require 'db.php';
	$tehnika_id = $_GET['tehnika_id'];
	$sql = 'SELECT * FROM tehniki WHERE tehnika_id=:tehnika_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':tehnika_id' => $tehnika_id ]);
	$tech = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  && isset($_POST['link'])  && isset($_POST['description']) ) {
	  $name = $_POST['name'];
	  $link = $_POST['link'];
	  $description = $_POST['description'];

	  $sql = 'UPDATE tehniki SET name=:name, link=:link, description=:description WHERE tehnika_id=:tehnika_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':link' => $link, ':description' => $description, ':tehnika_id' => $tehnika_id])) {
	    // header("location: techniques.php");
	  }
	}
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Update Technique</span>
			</h1>
	  </div>
	  <form data-toggle="md-validator" action="" method="POST">
			<div class="row">
			  <div class="col-sm-6 col-sm-offset-3">
					<div class="demo-md-form-wrapper">
					
					<div class="md-form-group">
							<input value="<?= $tech->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Technique Name">
					</div>

					<div class="md-form-group">
							<input value="<?= $tech->link; ?>" class="md-form-control" type="text" name="link" id="link" placeholder="Link (youtube)">
					</div>
					
					<div class="md-form-group">
							<input value="<?= $tech->description; ?>" class="md-form-control" type="text" name="description" id="description" placeholder="Description">
					</div>

					<button class="btn btn-default btn-block" type="submit">Update Technique</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>