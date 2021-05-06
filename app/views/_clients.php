<?php
	$current_manager = $_SESSION['manager_id']; 	
 	$sql = "SELECT * FROM clients WHERE managers_manager_id = '$current_manager.';";
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
			  		 	<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
								<thead>
				  				<tr>
										<th>Seq.</th>
										<th>Name</th>
										<th>Surname</th>
										<th>Email</th>
										<th>Action Del</th>
										<th>Action Upd</th>
										<th>Profile</th>
										<th>Photos</th>
				  				</tr>
								</thead>
								<tbody>
				  				<?php foreach($people as $person): ?>
				  				<tr>
										<td><?= $person->client_id; ?></td>
										<td><?= $person->name; ?></td>
										<td><?= $person->surname; ?></td>
										<td><?= $person->email; ?></td>
										<td>
					  						<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_client.php?client_id=<?= $person->client_id ?>" class='btn btn-danger'>Delete</a>
										</td>
										<td>
					  						<a href="edit_client.php?client_id=<?= $person->client_id ?>" class='btn btn-default'>Edit</a>
										</td>
										<td>
					  						<a href="profile_of_client.php?client_id=<?= $person->client_id ?>" class='btn btn-default'>Profile</a>
										</td>
										<td>
					  						<a href="photos_of_client.php?client_id=<?= $person->client_id ?>" class='btn btn-primary'>Photos</a>
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