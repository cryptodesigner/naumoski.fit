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
			<span class="d-ib">Додавање Основни Информација</span>
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
				<select class="md-form-control" name="pol" id="pol" data-msg-required="Please indicate your gender." required>
					<option value="" disabled="disabled" selected="selected">Пол</option>
					<option value="Машко">Машко</option>
					<option value="Женско">Женско</option>
					<option value="Неопределено">Неопределено</option>
				</select>
				<label class="md-control-label"></label>
				</div>
					<div class="row">
						<div class="col-sm-12">
						  <div class="md-form-group md-label-floating">
                Роденден
                <input class="md-form-control" type="date" name="godini" id="godini"  data-msg-required="Роденден">
                <label class="md-control-label"></label>
              </div>
						</div>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="visina" id="visina" placeholder="Висина (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Тежина (кг)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="alergija" id="alergija" placeholder="Алергија на Храна (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="netolerantnost" id="netolerantnost" placeholder="Интолерантност на Храна (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="odbivnost" id="odbivnost" placeholder="Одбивност на Храна (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="zaboluvanja" id="zaboluvanja" placeholder="Заболуванја (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="iskustvo" id="iskustvo" data-msg-required="Please indicate your gender.">
							<option value="" disabled="disabled" selected="selected">Искуство во Теретана</option>
							<option value="Почетник">Почетник</option>
							<option value="Напреден">Напреден</option>
							<option value="Професионалец">Професионалец</option>
						</select>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="suplement" id="suplement" data-msg-required="Would you like to use suplements?">
							<option value="" disabled="disabled" selected="selected">Дали би користеле суплементи?</option>
							<option value="Да">Да</option>
							<option value="Не">Не</option>
						</select>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="tip_rabota" id="tip_rabota" data-msg-required="kakva rabota rabotite?">
							<option value="" disabled="disabled" selected="selected">Дали работата ви е физичка или психичка</option>
							<option value="Физичка">Физичка</option>
							<option value="Психичка">Психичка</option>
						</select>
					</div>
					<button class="btn btn-default btn-block" type="submit">Додади</button>
				 </div>
			</div>
		</form>
	</div>
</section>