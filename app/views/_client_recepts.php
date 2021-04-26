<?php
 	$sql = "SELECT * FROM recepts";
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
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-1" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<th>Seq.</th>
									<th>Name</th>
									<th>Description</th>
									<th>Link</th>
				  			</tr>
							</thead>
							<tbody>
				 				<?php foreach($recepts as $r): ?>
				 	 			<tr>
									<td><?= $r->recept_id; ?></td>
									<td><?= $r->name; ?></td>
									<td><?= $r->description; ?></td>
									<td><?= $r->link; ?></td>
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