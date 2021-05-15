<?php
	$sql = 'SELECT * FROM options';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$meals = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Листа На Оброци</span>
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
			  			<strong>Листа На Оброци</strong>
						</div>
						<div class="card-body">
			  			<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
								<thead>
				  				<tr>
										<th>Р.б.</th>
										<th>Име</th>
										<th>Состојки</th>
										<th>Протеини</th>
										<th>Јаглехидрати</th>
										<th>Масти</th>
										<th>Дескрипција</th>
										<th>Бриши</th>
										<th>Уреди</th>
				  				</tr>
								</thead>
								<tbody>
				  				<?php foreach($meals as $meal): ?>
									<tr>
					  				<td><?= $meal->option_id; ?></td>
					  				<td><?= $meal->name; ?></td>
					  				<td><?= $meal->sostojki; ?></td>
					  				<td><?= $meal->proteins; ?></td>
					  				<td><?= $meal->carbohydrates; ?></td>
					  				<td><?= $meal->fats; ?></td>
					  				<td><?= $meal->description; ?></td>
					  				<td>
										<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_option.php?option_id=<?= $meal->option_id ?>" class='btn btn-danger'>Бриши</a>
					  				</td>
					  				<td>
										<a href="edit_meal.php?option_id=<?= $meal->option_id ?>" class='btn btn-default'>Уреди</a>
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