<?php
	$message = '';
  if (isset ($_POST['name'])  && isset($_POST['sostojki'])  && isset($_POST['proteins'])  && isset($_POST['carbohydrates']) && isset($_POST['fats']) && isset($_POST['description'])) {
    $name = $_POST['name'];
    $sostojki = $_POST['sostojki'];
    $proteins = $_POST['proteins'];
    $carbohydrates = $_POST['carbohydrates'];
    $fats = $_POST['fats'];
    $description = $_POST['description'];

    $sql = 'INSERT INTO options(name, sostojki, proteins, carbohydrates, fats, description) VALUES(:name, :sostojki, :proteins, :carbohydrates, :fats, :description)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':sostojki' => $sostojki, ':proteins' => $proteins, ':carbohydrates' => $carbohydrates, ':fats' => $fats, ':description' => $description])) {
      $message = 'Успешно Додадено';
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
			  <span class="d-ib">Додади Оброк</span>
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
							<input class="md-form-control" type="text" name="name" id="name" placeholder="Име На Оброк">
							<label class="md-control-label"></label>
					</div>

					<div class="md-form-group">
							<input class="md-form-control" type="text" name="sostojki" id="sostojki" placeholder="Состојки">
							<label class="md-control-label"></label>
					</div>
					
					<div class="md-form-group">
							<input class="md-form-control" type="text" name="proteins" id="proteins" placeholder="Протеини (гр)">
							<label class="md-control-label"></label>
					</div>
					
					<div class="md-form-group">
							<input class="md-form-control" type="text" name="carbohydrates" id="carbohydrates" placeholder="Јаглехидрати (гр)">
							<label class="md-control-label"></label>
					</div>
					
					<div class="md-form-group">
							<input class="md-form-control" type="text" name="fats" id="fats" placeholder="Масти (гр)">
							<label class="md-control-label"></label>
					</div>

					<div class="md-form-group">
							<input class="md-form-control" type="text" name="description" id="description" placeholder="Дескрипција">
							<label class="md-control-label"></label>
					</div>

					<button class="btn btn-default btn-block" type="submit">Додади Оброк</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>