<?php
	$clients_client_id = $_SESSION["client_id"];
 	$sql = "SELECT * FROM schedules WHERE clients_client_id = $clients_client_id ";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $schedules = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
	    <h1 class="title-bar-title">
	      <span class="d-ib">List of Schedules
	      </span>
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
	          <strong>List of Schedules
	          </strong>
	        </div>
	        <div class="card-body">
	          <table id="demo-datatables-buttons-8" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
	            <thead>
	              <tr>
	                <th>Seq.</th>
	                <th>Waking time</th>
	                <th>Sleep time</th>
	                <th>Work / School</th>
	                <th>Break</th>
	                <th>Training</th>
	                <th>Cardio</th>
	                <th>Other Activities</th>
	                <th>Delete</th>
	                <th>Edit</th>
	              </tr>
	            </thead>
	            <tbody>
	              <?php foreach($schedules as $s): ?>
	              <tr>
	                <td><?= $s->schedule_id; ?></td>
	                <td><?= $s->stanuvanje; ?></td>
	                <td><?= $s->legnuvanje; ?></td>
	                <td><?= $s->rabota; ?></td>
	                <td><?= $s->pauzi; ?></td>
	                <td><?= $s->trening; ?></td>
	                <td><?= $s->cardio; ?></td>
	                <td><?= $s->description; ?></td>
	                <td>
	                  <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_schedule.php?schedule_id=<?= $s->schedule_id ?>" class='btn btn-danger'>Delete</a>
	                </td>
	                <td>
	                  <a href="edit_schedule.php?schedule_id=<?= $s->schedule_id ?>" class='btn btn-default'>Edit</a>
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