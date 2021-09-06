<?php
	$clients_client_id = $_SESSION["client_id"];
 	$sql = "SELECT * FROM basics WHERE clients_client_id = $clients_client_id ";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $basics = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">List of Basic Information</span>
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
		  			<strong>List of Basic Information</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-8" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Seq..</th>
									<th>Gender</th>
									<th>Birthday</th>
									<th>Height</th>
									<th>WEight</th>
									<th>Alergies</th>
									<th>Intelerance</th>
									<th>Rejection</th>
									<th>Diseases</th>
									<th>Experience</th>
									<th>Suplements?</th>
									<th>Job Type?</th>
									<th>Delete</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($basics as $b): ?>
								<tr>
									<td><?= $b->basic_id; ?></td>
									<td><?= $b->pol; ?></td>
									<td><?= $b->godini; ?></td>
									<td><?= $b->visina; ?></td>
									<td><?= $b->tezina; ?></td>
									<td><?= $b->alergija; ?></td>
									<td><?= $b->netolerantnost; ?></td>
									<td><?= $b->odbivnost; ?></td>
									<td><?= $b->zaboluvanja; ?></td>
									<td><?= $b->iskustvo; ?></td>
									<td><?= $b->suplement; ?></td>
									<td><?= $b->tip_rabota; ?></td>
									<td>
					  				<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_basic.php?basic_id=<?= $b->basic_id ?>" class='btn btn-danger'>Delete</a>
									</td>
									<td>
					  				<a href="edit_basic.php?basic_id=<?= $b->basic_id ?>" class='btn btn-default'>Edit</a>
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