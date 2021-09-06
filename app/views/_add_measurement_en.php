<?php
	$message = '';
  if (isset ($_POST['tezina']) && isset ($_POST['vrat']) && isset ($_POST['gradi']) && isset ($_POST['pod_gradi']) && isset ($_POST['papok']) && isset ($_POST['kolk']) && isset ($_POST['raka']) && isset ($_POST['but'])) {
  	$clients_client_id = $_SESSION["client_id"];
  	$tezina = $_POST['tezina'];
  	$vrat = $_POST['vrat'];
  	$gradi = $_POST['gradi'];
  	$pod_gradi = $_POST['pod_gradi'];
    $papok = $_POST['papok'];
    $kolk = $_POST['kolk'];
    $raka = $_POST['raka'];
    $but = $_POST['but'];
    $cur_date = date("Y-m-d");
  	$sql = 'INSERT INTO measurements(clients_client_id, tezina, vrat, gradi, pod_gradi, papok, kolk, raka, but, cur_date) VALUES(:clients_client_id, :tezina, :vrat, :gradi, :pod_gradi, :papok, :kolk, :raka, :but, :cur_date)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':clients_client_id' => $clients_client_id, ':tezina' => $tezina, ':vrat' => $vrat, ':gradi' => $gradi, ':pod_gradi' => $pod_gradi, ':papok' => $papok, ':kolk' => $kolk, ':raka' => $raka, ':but' => $but, ':cur_date' => $cur_date])) {
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
		  	<span class="d-ib">Add Measurement</span>
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
			  		<input class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Weight (kg)">
			  		<label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="vrat" id="vrat" placeholder="Neck (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="gradi" id="gradi" placeholder="Chest (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="pod_gradi" id="pod_gradi" placeholder="Lower Chest (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="papok" id="papok" placeholder="Navel (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="kolk" id="kolk" placeholder="Hip (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="raka" id="raka" placeholder="Arm (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="but" id="but" placeholder="Thigh (cm)">
					  <label class="md-control-label"></label>
					</div>
					<button class="btn btn-default btn-block" type="submit">Add Measurement</button>
		  	</div>
			</div>
	  </form>
	</div>
</section>