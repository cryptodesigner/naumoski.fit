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
			  <span class="d-ib">Уредување на Техника</span>
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
					<div class="demo-md-form-wrapper">
					
					<div class="md-form-group">
							<input value="<?= $tech->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Име на Техника">
					</div>

					<div class="md-form-group">
							<input value="<?= $tech->link; ?>" class="md-form-control" type="text" name="link" id="link" placeholder="Линк (youtube)">
					</div>
					
					<div class="md-form-group">
							<input value="<?= $tech->description; ?>" class="md-form-control" type="text" name="description" id="description" placeholder="Дескрипција">
					</div>

					<button class="btn btn-default btn-block" type="submit">Ажурирај Техника</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>