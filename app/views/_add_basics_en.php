<?php
	$message = '';
  if (isset ($_POST['pol']) && isset ($_POST['godini']) && isset ($_POST['visina']) && isset ($_POST['tezina']) && isset ($_POST['alergija']) && isset ($_POST['netolerantnost']) && isset ($_POST['odbivnost']) && isset ($_POST['zaboluvanja']) && isset ($_POST['iskustvo']) && isset ($_POST['suplement']) && isset ($_POST['tip_rabota'])) {
  	$clients_client_id = $_SESSION["client_id"];
  	$pol = $_POST['pol'];
  	$godini = $_POST['godini'];
  	$visina = $_POST['visina'];
  	$tezina = $_POST['tezina'];
    $alergija = $_POST['alergija'];
    $netolerantnost = $_POST['netolerantnost'];
    $odbivnost = $_POST['odbivnost'];
    $zaboluvanja = $_POST['zaboluvanja'];
    $iskustvo = $_POST['iskustvo'];
    $suplement = $_POST['suplement'];
    $tip_rabota = $_POST['tip_rabota'];
  	$sql = 'INSERT INTO basics(clients_client_id, pol, godini, visina, tezina, alergija, netolerantnost, odbivnost, zaboluvanja, iskustvo, suplement, tip_rabota) VALUES(:clients_client_id, :pol, :godini, :visina, :tezina, :alergija, :netolerantnost, :odbivnost, :zaboluvanja, :iskustvo, :suplement, :tip_rabota)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':clients_client_id' => $clients_client_id, ':pol' => $pol, ':godini' => $godini, ':visina' => $visina, ':tezina' => $tezina, ':alergija' => $alergija, ':netolerantnost' => $netolerantnost, ':odbivnost' => $odbivnost, ':zaboluvanja' => $zaboluvanja, ':iskustvo' => $iskustvo, ':suplement' => $suplement, ':tip_rabota' => $tip_rabota])) {
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
			<span class="d-ib">Add Basic Information</span>
		  </h1>

		  <span><a style="color: white;" href="add_basics.php">MK</a> <span style="color: white;">|</span> <a style="color: white;" href="add_basics_en.php">EN</a></span>
		  
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
				<select class="md-form-control" name="pol" id="pol" data-msg-required="Please indicate your gender." required>
					<option value="" disabled="disabled" selected="selected">Gender</option>
					<option value="Машко">Male</option>
					<option value="Женско">Female</option>
					<option value="Неопределено">Undetermined</option>
				</select>
				<label class="md-control-label"></label>
				</div>
					<div class="row">
						<div class="col-sm-12">
						  <div class="md-form-group md-label-floating">
                Birth day
                <input class="md-form-control" type="date" name="godini" id="godini"  data-msg-required="Роденден">
                <label class="md-control-label"></label>
              </div>
						</div>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="visina" id="visina" placeholder="Height (cm)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Weight (kg)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="alergija" id="alergija" placeholder="Alergies (if any)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="netolerantnost" id="netolerantnost" placeholder="Intolerance (if any)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="odbivnost" id="odbivnost" placeholder="Rejection (if any)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="zaboluvanja" id="zaboluvanja" placeholder="Sickness (if any)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="iskustvo" id="iskustvo" data-msg-required="Please indicate your gender.">
							<option value="" disabled="disabled" selected="selected">Experience in the Gym</option>
							<option value="Почетник">Beginner</option>
							<option value="Напреден">Intermediate</option>
							<option value="Професионалец">Professional</option>
						</select>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="suplement" id="suplement" data-msg-required="Would you like to use suplements?">
							<option value="" disabled="disabled" selected="selected">Would you use supplements?</option>
							<option value="Да">Yes</option>
							<option value="Не">No</option>
						</select>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="tip_rabota" id="tip_rabota" data-msg-required="kakva rabota rabotite?">
							<option value="" disabled="disabled" selected="selected">Is your job physical or mental?</option>
							<option value="Физичка">Physical</option>
							<option value="Психичка">Mental</option>
						</select>
					</div>
					<button class="btn btn-default btn-block" type="submit">Add</button>
				 </div>
			</div>
		</form>
	</div>
</section>