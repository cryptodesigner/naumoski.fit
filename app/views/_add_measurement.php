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
  	  $message = 'Measurement Added Successfully';
  	}
  	else{
      $message = 'Problem Occured, Try Again';
    }
  }
?>
<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
		  	<span class="d-ib">Додади Мерење</span>
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
			  		<input class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Тежина (кг)">
			  		<label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="vrat" id="vrat" placeholder="Врат (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="gradi" id="gradi" placeholder="Гради (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="pod_gradi" id="pod_gradi" placeholder="Под Гради (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="papok" id="papok" placeholder="Папок (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="kolk" id="kolk" placeholder="Колк (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="raka" id="raka" placeholder="Рака (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="but" id="but" placeholder="Бут (цм)">
					  <label class="md-control-label"></label>
					</div>
					<button class="btn btn-default btn-block" type="submit">Додади Мерење</button>
		  	</div>
			</div>
	  </form>
	</div>
</section>