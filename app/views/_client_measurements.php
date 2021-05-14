<?php
	$clients_client_id = $_SESSION["client_id"];
 	$sql = "SELECT * FROM measurements WHERE clients_client_id = $clients_client_id ";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $measurements = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Листа На Мерења</span>
			</h1>
	  </div>
	  <div class="row gutter-xs">
			<div class="col-xs-12">
		 		<div class="card">
					<div class="card-header">
		  			<div class="card-actions">
							<button type="button" class="card-action card-toggler" title="Collapse"></button>
							<button type="button" class="card-action card-reload" title="Reload"></button>
							<button type="button" class="card-action card-remove" title="Remove"></button>
		  			</div>
		  			<strong>Листа На Мерења</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Р.б.</th>
									<th>Тежина</th>
									<th>Врат</th>
									<th>Гради</th>
									<th>Под Гради</th>
									<th>Папок</th>
									<th>Колк</th>
									<th>Рака</th>
									<th>Бут</th>
									<th>Дата</th>
									<th>Бриши</th>
									<th>Уреди</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($measurements as $m): ?>
								<tr>
									<td><?= $m->measurement_id; ?></td>
									<td><?= $m->tezina; ?></td>
									<td><?= $m->vrat; ?></td>
									<td><?= $m->gradi; ?></td>
									<td><?= $m->pod_gradi; ?></td>
									<td><?= $m->papok; ?></td>
									<td><?= $m->kolk; ?></td>
									<td><?= $m->raka; ?></td>
									<td><?= $m->but; ?></td>
									<td><?= $m->cur_date; ?></td>
									<td>
					  				<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_measurement.php?measurement_id=<?= $m->measurement_id ?>" class='btn btn-danger'>Бриши</a>
									</td>
									<td>
					  				<a href="edit_measurement.php?measurement_id=<?= $m->measurement_id ?>" class='btn btn-default'>Уреди</a>
									</td>
				  			</tr>
				  			<?php endforeach; ?>
							</tbody>
			 	 		</table>
					</div>
		  	</div>
			</div>
	  </div>
	</div>
</section>