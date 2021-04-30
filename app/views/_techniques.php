<?php
	$sql = 'SELECT * FROM tehniki';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$techs = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Techniques</span>
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
			  			<strong>Techniques List</strong>
						</div>
						<div class="card-body">
			  			<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
								<thead>
				  				<tr>
										<th>Seq.</th>
										<th>Name</th>
										<th>Link</th>
										<th>Description</th>
										<th>Action Del</th>
										<th>Action Upd</th>
				  				</tr>
								</thead>
								<tbody>
				  				<?php foreach($techs as $tech): ?>
									<tr>
					  				<td><?= $tech->tehnika_id; ?></td>
					  				<td><?= $tech->name; ?></td>
					  				<td><?= $tech->link; ?></td>
					  				<td><?= $tech->description; ?></td>
					  				<td>
											<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_tech.php?tehnika_id=<?= $tech->tehnika_id ?>" class='btn btn-danger'>Delete</a>
					  				</td>
					  				<td>
											<a href="edit_tech.php?tehnika_id=<?= $tech->tehnika_id ?>" class='btn btn-default'>Edit</a>
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