<?php
	$sql = 'SELECT * FROM recepts';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$recepts = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">All Recepts</span>
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
			  		<strong>Recepts List</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<th>Seq.</th>
									<th>Manager</th>
									<th>Name</th>
									<th>Description</th>
									<th>Link</th>
									<th>Action Del</th>
									<th>Action Upd</th>
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($recepts as $recept): ?>
				  			<tr>
									<td><?= $recept->recept_id; ?></td>
									<td><?= $recept->managers_manager_id; ?></td>
									<td><?= $recept->name; ?></td>
									<td><?= $recept->description; ?></td>
									<td><?= $recept->link; ?></td>
									<td>
					  				<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_recept.php?recept_id=<?= $recept->recept_id ?>" class='btn btn-danger'>Delete</a>
									</td>
									<td>
					  				<a href="edit_recept.php?recept_id=<?= $recept->recept_id ?>" class='btn btn-default'>Edit</a>
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