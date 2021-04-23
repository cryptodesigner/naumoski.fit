<?php 	
 	$sql = "SELECT * FROM clients";
 	$statement = $connection->prepare($sql);
  	$statement->execute();
  	$people = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">All Clients</span>
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
			  			<strong>Clients List</strong>
						</div>
						<div class="card-body">
			  		 	<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
								<thead>
				  				<tr>
										<th>Seq.</th>
										<th>Name / Surname</th>
										<th>Email</th>
										<th>Action</th>
										<th>Profile</th>
				  				</tr>
								</thead>
								<tbody>
				  				<?php foreach($people as $person): ?>
				  				<tr>
										<td><?= $person->client_id; ?></td>
										<td><?= $person->name; $person->surname; ?></td>
										<td><?= $person->client_id; ?></td>
										<td>
					  						<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?client_id=<?= $person->client_id ?>" class='btn btn-danger'>Delete</a>
										</td>
										<td>
					  					<a href="/clients_profile/{{row['client_id']}}" class="btn btn-default btn-xs">Profile</a>
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
	</div>
</section>