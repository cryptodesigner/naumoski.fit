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
			  <span class="d-ib">All Measurements</span>
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
		  			<strong>Clients Measurements List</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Seq.</th>
									<th>Tezina</th>
									<th>Vrat</th>
									<th>Gradi</th>
									<th>Pod Gradi</th>
									<th>Papok</th>
									<th>Kolk</th>
									<th>Raka</th>
									<th>But</th>
									<th>Date</th>
									<th>Action Del</th>
									<th>Action Upd</th>
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
					  				<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_measurement.php?measurement_id=<?= $m->measurement_id ?>" class='btn btn-danger'>Delete</a>
									</td>
									<td>
					  				<a href="edit_measurement.php?measurement_id=<?= $m->measurement_id ?>" class='btn btn-default'>Edit</a>
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