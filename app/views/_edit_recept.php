<?php
	require 'db.php';
	$recept_id = $_GET['recept_id'];
	$sql = 'SELECT * FROM recepts WHERE recept_id=:recept_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':recept_id' => $recept_id ]);
	$recept = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  && isset($_POST['description'])  && isset($_POST['link']) ) {
	  $name = $_POST['name'];
	  $description = $_POST['description'];
	  $link = $_POST['link'];
	 
	  $sql = 'UPDATE recepts SET name=:name, description=:description, link=:link WHERE recept_id=:recept_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':description' => $description, ':link' => $link, ':recept_id' => $recept_id])) {
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
		  	<span class="d-ib">Уредување на Рецепта</span>
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
							<input value="<?= $recept->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Име на Рецепт">
			  		</div>
			  		<div class="md-form-group">
							<input value="<?= $recept->description; ?>" class="md-form-control" type="text" name="description" id="description" placeholder="Дескрипција">
			  		</div>
			  		<div class="md-form-group">
							<input value="<?= $recept->link; ?>" class="md-form-control" type="text" name="link" id="link" placeholder="Линк">
			  		</div>
			  		<button class="btn btn-default btn-block" type="submit">Ажурирај Рецепта</button>
					</div>
		  	</div>
			</div>
	  </form>
	</div>
</section>