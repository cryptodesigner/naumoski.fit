<?php
	require 'db.php';
	$basic_id = $_GET['basic_id'];
	$sql = 'SELECT * FROM basics WHERE basic_id=:basic_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':basic_id' => $basic_id ]);
	$basic = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['pol'])  && isset($_POST['godini'])  && isset($_POST['visina'])  && isset($_POST['tezina'])  && isset($_POST['alergija'])  && isset($_POST['netolerantnost'])  && isset($_POST['odbivnost'])  && isset($_POST['zaboluvanja'])  && isset($_POST['iskustvo']) ) {
	  $pol = $_POST['pol'];
	  $godini = $_POST['godini'];
	  $visina = $_POST['visina'];
	  $tezina = $_POST['tezina'];
	  $alergija = $_POST['alergija'];
	  $netolerantnost = $_POST['netolerantnost'];
	  $odbivnost = $_POST['odbivnost'];
	  $zaboluvanja = $_POST['zaboluvanja'];
	  $iskustvo = $_POST['iskustvo'];
	  $sql = 'UPDATE basics SET pol=:pol, godini=:godini, visina=:visina, tezina=:tezina, alergija=:alergija, netolerantnost=:netolerantnost, odbivnost=:odbivnost, zaboluvanja=:zaboluvanja, iskustvo=:iskustvo WHERE basic_id=:basic_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':pol' => $pol, ':godini' => $godini, ':visina' => $visina, ':tezina' => $tezina, ':alergija' => $alergija, ':netolerantnost' => $netolerantnost, ':odbivnost' => $odbivnost, ':zaboluvanja' => $zaboluvanja, ':iskustvo' => $iskustvo, ':basic_id' => $basic_id])) {
	    // header("location: meals.php");
	  }
	}
?>

<section>
	<div class="layout-content-body">
		<div class="title-bar">
		  <h1 class="title-bar-title">
			<span class="d-ib">Edit Basics</span>
		  </h1>
		</div>
		<form data-toggle="md-validator" action="" method="POST">
		  <div class="row">
			<div class="col-sm-6 col-sm-offset-3">
			  <div class="md-form-group">
				<select value="<?= $basic->pol; ?>" class="md-form-control" name="pol" id="pol" data-msg-required="Please indicate your gender." required>
					<option value="" disabled="disabled" selected="selected">Gender</option>
					<option value="M">Male</option>
					<option value="F">Female</option>
					<option value="N">Not specified</option>
				</select>
				</div>
					<div class="row">
						<div class="col-sm-12">
						  <div class="md-form-group md-label-floating">
								<input class="md-form-control" type="date" name="godini" id="godini" data-format="dd/MM/yyyy" data-msg-required="Please enter your birth date">
						  </div>
						</div>
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->visina; ?>" class="md-form-control" type="text" name="visina" id="visina" placeholder="Visina (cm)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->tezina; ?>" class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Tezina (kg)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->alergija; ?>" class="md-form-control" type="text" name="alergija" id="alergija" placeholder="Alergija (ako ima)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->netolerantnost; ?>" class="md-form-control" type="text" name="netolerantnost" id="netolerantnost" placeholder="Netolerantnost (ako ima)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->odbivnost; ?>" class="md-form-control" type="text" name="odbivnost" id="odbivnost" placeholder="Odbivnost (ako ima)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->zaboluvanja; ?>" class="md-form-control" type="text" name="zaboluvanja" id="zaboluvanja" placeholder="Zaboluvanja (ako ima)">
					</div>
					<div class="md-form-group">
					  <input value="<?= $basic->iskustvo; ?>" class="md-form-control" type="text" name="iskustvo" id="iskustvo" placeholder="Iskustvo vo teretana (ako ima)">
					</div>
					<button class="btn btn-default btn-block" type="submit">Update Basics</button>
				 </div>
			</div>
		</form>
	</div>
</section>