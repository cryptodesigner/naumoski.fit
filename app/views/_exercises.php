<?php
	$sql = 'SELECT * FROM vezbi';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$exercises = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">All Exercises</span>
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
			  			<strong>Exercise List</strong>
						</div>
						<div class="card-body">
			  			<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
								<thead>
				  				<tr>
										<th>Seq.</th>
										<th>Name</th>
										<th>Link na Vezba</th>
										<th>Muskulna Grupa</th>
										<th>Description</th>
										<th>Action</th>
				  				</tr>
								</thead>
								<tbody>
				  				<?php foreach($exercises as $ex): ?>
									<tr>
					  				<td><?= $ex->vezba_id; ?></td>
					  				<td><?= $ex->name; ?></td>
					  				<td><?= $ex->link_vezba; ?></td>
					  				<td><?= $ex->muskulna_grupa; ?></td>
					  				<td><?= $ex->description; ?></td>
					  				<td>
										<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?vezba_id=<?= $ex->vezba_id ?>" class='btn btn-danger'>Delete</a>
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