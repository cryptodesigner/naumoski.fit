<?php
	require 'db.php';
	$measurement_id = $_GET['measurement_id'];
	$sql = 'SELECT * FROM measurements WHERE measurement_id=:measurement_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':measurement_id' => $measurement_id ]);
	$measurement = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['tezina'])  && isset($_POST['vrat'])  && isset($_POST['gradi'])  && isset($_POST['pod_gradi'])  && isset($_POST['papok'])  && isset($_POST['kolk'])  && isset($_POST['raka'])  && isset($_POST['but']) ) {
	  $tezina = $_POST['tezina'];
	  $vrat = $_POST['vrat'];
	  $gradi = $_POST['gradi'];
	  $pod_gradi = $_POST['pod_gradi'];
	  $papok = $_POST['papok'];
	  $kolk = $_POST['kolk'];
	  $raka = $_POST['raka'];
	  $but = $_POST['but'];
	  $sql = 'UPDATE measurements SET tezina=:tezina, vrat=:vrat, gradi=:gradi, pod_gradi=:pod_gradi, papok=:papok, kolk=:kolk, raka=:raka, but=:but WHERE measurement_id=:measurement_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':tezina' => $tezina, ':vrat' => $vrat, ':gradi' => $gradi, ':pod_gradi' => $pod_gradi, ':papok' => $papok, ':kolk' => $kolk, ':raka' => $raka, ':but' => $but, ':measurement_id' => $measurement_id])) {
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
		  	<span class="d-ib">Edit Measurements</span>
			</h1>

			<span><a style="color: white;" href="edit_measurement.php">MK</a> <span style="color: white;">|</span> <a style="color: white;" href="edit_measurement_en.php">EN</a></span>
			
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
			  		<input value="<?= $measurement->tezina; ?>" class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Weight (kg)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->vrat; ?>" class="md-form-control" type="text" name="vrat" id="vrat" placeholder="Neck (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->gradi; ?>" class="md-form-control" type="text" name="gradi" id="gradi" placeholder="Chest (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->pod_gradi; ?>" class="md-form-control" type="text" name="pod_gradi" id="pod_gradi" placeholder="Lower Chest (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->papok; ?>" class="md-form-control" type="text" name="papok" id="papok" placeholder="Navel (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->kolk; ?>" class="md-form-control" type="text" name="kolk" id="kolk" placeholder="Hip (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->raka; ?>" class="md-form-control" type="text" name="raka" id="raka" placeholder="Arm (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $measurement->but; ?>" class="md-form-control" type="text" name="but" id="but" placeholder="But (cm)">
					</div>
					<button class="btn btn-default btn-block" type="submit">Update Measurements</button>
		  	</div>
			</div>
	  </form>
	</div>
</section>