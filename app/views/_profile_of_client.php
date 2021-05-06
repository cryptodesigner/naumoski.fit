<?php

	$current_client = $_GET['client_id'];
	
	$sql = "SELECT * FROM clients WHERE client_id = '$current_client.';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$clients = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM measurements WHERE clients_client_id = '$current_client.';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$measurements = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM basics WHERE clients_client_id = '$current_client.';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$basics = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM schedules WHERE clients_client_id = '$current_client.';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$schedules = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM trainings WHERE clients_client_id = '$current_client.'
	  AND date = CURDATE()
	  ORDER BY vreme ASC";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$today_trainings = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM trainings WHERE clients_client_id = '$current_client.'
	  AND date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)
	  ORDER BY vreme ASC";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$tomorrow_trainings = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM trainings WHERE clients_client_id = '$current_client.'
	  AND date >= CURDATE()
	  ORDER BY vreme ASC";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$all_trainings = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM meals WHERE clients_client_id = '$current_client.'
	  AND date = CURDATE()
	  ORDER BY vreme ASC";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$today_meals = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM meals WHERE clients_client_id = '$current_client.'
	  AND date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)
	  ORDER BY vreme ASC";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$tomorrow_meals = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT * FROM meals WHERE clients_client_id = '$current_client.'
	  AND date >= CURDATE()
	  ORDER BY vreme ASC";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$all_meals = $statement->fetchAll(PDO::FETCH_OBJ);


	$sql = "SELECT m.name FROM managers m 
	  INNER JOIN clients c ON m.manager_id = c.managers_manager_id
	  WHERE client_id = '$current_client.';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$assigned_manager = $statement->fetchAll(PDO::FETCH_OBJ);

?>


<section>
	<div class="profile">
	  <div class="profile-header">
			<div class="profile-cover">
		  	<div class="profile-container">
					<div class="profile-card">
			  		<div class="profile-avetar">
							<img class="profile-avetar-img" width="128" height="128" src="../static/img/user.jpg" alt="Teddy Wilson">
					  </div>
					  <div class="profile-overview">
					  	<?php foreach($clients as $c): ?>
            	  <h1 class="profile-name"><?= $c->name; ?> <?= $c->surname; ?>'s Profile</h1>
            	<?php endforeach; ?>
							<!-- <h1 class="profile-name">{% for row in data %}{{row['name']}}'s Profile{% endfor %}</h1> -->
							<p>Client<a class="link-inverted"></a></p>
					  </div>
					</div>
					<div class="profile-tabs">
					  <ul class="profile-nav">
							<li><a onclick="openTab('Profile')">Profile</a></li>
							<li><a onclick="openTab('Trainings')">Trainings</a></li>
							<li><a onclick="openTab('Diets')">Diets</a></li>
					  </ul>
					</div>
				 </div>
			</div>
		</div>
	</div>

	<div class="profile-body">
		<div class="card-body">

			<div id="Profile" class="tab">
				<div class="">
					<?php foreach($clients as $c): ?>
					  <h3><?= $c->name; ?> <?= $c->surname; ?>'s Profile</h3>
					<?php endforeach; ?>
				</div>

				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<div class="card-actions">
								<button type="button" class="card-action card-toggler" title="Collapse"></button>
								<button type="button" class="card-action card-reload" title="Reload"></button>
								<button type="button" class="card-action card-remove" title="Remove"></button>
							</div>
							<strong>Client</strong>
						</div>
						<div class="card-body" data-toggle="match-height">
							<table class="table table-bordered table-striped table-wrap dataTable">
								<tr>
									<?php foreach($schedules as $s): ?>
									<th colspan="6">Budenje: </th>
									<td colspan="6"><?= $s->stanuvanje; ?></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($schedules as $s): ?>
									<th colspan="6">Zaspivanje: </th>
									<td colspan="6"><?= $s->legnuvanje; ?></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($schedules as $s): ?>
									<th colspan="6">Rabota: </th>
									<td colspan="6"><?= $s->rabota; ?></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($schedules as $s): ?>
									<th colspan="6">Pauzi: </th>
									<td colspan="6"><?= $s->pauzi; ?></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($schedules as $s): ?>
									<th colspan="6">Trening: </th>
									<td colspan="6"><?= $s->trening; ?></td>
									<?php endforeach; ?>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<div class="card-actions">
								<button type="button" class="card-action card-toggler" title="Collapse"></button>
								<button type="button" class="card-action card-reload" title="Reload"></button>
								<button type="button" class="card-action card-remove" title="Remove"></button>
							</div>
							<strong>Basics</strong>
						</div>
						<div class="card-body" data-toggle="match-height">
							<table class="table table-bordered table-striped table-wrap dataTable">
								<tr>
									<?php foreach($clients as $c): ?>
									<th colspan="6">Ime: </th>
									<td colspan="6"><?= $c->name; ?></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
               		<th colspan="6">Pol: </th>
               		<td colspan="6"><?= $b->pol; ?></td>
               		<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Rodenden: </th>
                	<td colspan="6"><?= $b->godini; ?></td>
                	<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
									<th colspan="6">Visina: </th>
									<td colspan="6"><?= $b->visina; ?></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Tezina: </th>
                	<td colspan="6"><?= $b->tezina; ?></td>
                	<?php endforeach; ?>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<div class="card-actions">
								<button type="button" class="card-action card-toggler" title="Collapse"></button>
								<button type="button" class="card-action card-reload" title="Reload"></button>
								<button type="button" class="card-action card-remove" title="Remove"></button>
							</div>
							<strong>Characteristics</strong>
						</div>
						<div class="card-body" data-toggle="match-height">
							<table class="table table-bordered table-striped table-wrap dataTable">
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Alergii: </th>
                	<td colspan="6"><?= $b->alergija; ?></td>
                	<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Netolerantnost: </th>
                	<td colspan="6"><?= $b->netolerantnost; ?></td>
                	<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Odbivnost: </th>
                	<td colspan="6"><?= $b->odbivnost; ?></td>
                	<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Zaboluvanja: </th>
                	<td colspan="6"><?= $b->zaboluvanja; ?></td>
                	<?php endforeach; ?>
								</tr>
								<tr>
									<?php foreach($basics as $b): ?>
                	<th colspan="6">Iskustvo: </th>
                	<td colspan="6"><?= $b->iskustvo; ?></td>
                	<?php endforeach; ?>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-body text-center" data-toggle="match-height">
						<div class="row">
							<div class="col-xs-6 col-xs-offset-3">
								<canvas data-chart="doughnut" data-labels='["Proteins", "Carbohidrates", "Fat"]' data-values='[{"backgroundColor": ["#F27820", "#058dc7", "#50b432"], "data": [50, 30, 20]}]' data-hide='["scalesX", "scalesY", "legend"]' data-cutout-percentage="80" height="150" width="150"></canvas>
							</div>
						</div>
						<h6 class="m-b-0">
							<span class="nowrap">
								<span class="p-x">
									<span class="icon icon-square icon-fw" style="color: #F27820"></span>
									Proteins
								</span>
								<span class="p-x">
									<span class="icon icon-square icon-fw" style="color: #058dc7"></span>
									Carbohydrates
								</span>
								<span class="p-x">
									<span class="icon icon-square icon-fw" style="color: #50b432"></span>
									Fats
								</span>
							</span>
						</h6>
						<h6 class="m-b-0">Daily diet calories value (kCal)</h6>
						<h6 class="m-b-0">Total Calories (kCal)</h6>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-body text-center" data-toggle="match-height">
						<canvas id="weightCanvas" data-chart="line" data-labels='["May", "Jun", "Jul", "Aug"]' data-values='[{"backgroundColor": "rgba(243, 129, 32, 0.7)", "borderColor": "#50b432", "borderWidth": 2, "pointBackgroundColor": "#F27820", "pointRadius": 3, "label": "Kilograms", "data": [75, 70, 60, 66]}]' data-hide='["gridLinesX", "legend"]' height="150" width="300"></canvas>
						<h6 class="m-b-0">Body Weight (Kg)</h6>
					</div>
				</div>
			</div>
		     
			<div id="Trainings" class="tab" style="display: none">
				<div class="">
					<?php foreach($clients as $c): ?>
        	  <h3><?= $c->name; ?> <?= $c->surname; ?>'s Training List</h3>
        	<?php endforeach; ?>
				</div>
				<div class="panel m-b-lg">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#trainingtoday" data-toggle="tab">Today</a></li>
						<li><a href="#trainingtomorrow" data-toggle="tab">Tomorrow</a></li>
						<li><a href="#trainingweek" data-toggle="tab">Week</a></li>
					</ul>
					<div class="tab-content">

						<div class="tab-pane fade active in" id="trainingtoday">
							<div class="card">
								<div class="card-header">
			  					<div class="card-actions">
										<button type="button" class="card-action card-toggler" title="Collapse"></button>
										<button type="button" class="card-action card-reload" title="Reload"></button>
										<button type="button" class="card-action card-remove" title="Remove"></button>
			  					</div>
			  					<strong>Trainings List</strong>
								</div>
								<div class="card-body">
							  	<table id="demo-datatables-buttons-1" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
							    	<thead>
							    	  <tr>
							    	    <th>Seq.</th>
							    	    <th>Name</th>
							    	    <th>Vezba</th>
							    	    <th>Serii/Povtoruvanja</th>
							    	    <th>Tehnika</th>
							    	    <th>Vreme</th>
							    	  </tr>
							    	</thead>
							    	<tbody>
							     		<?php foreach($today_trainings as $tt): ?>
                  		<tr>
                  	  	<td><?= $tt->training_id; ?></td>
                  	  	<td><?= $tt->name; ?></td>
                  	  	<td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $tt->vezba; ?>)">See Exercise</button></td>
                  	  	<td><?= $tt->serii_povt; ?></td>
                  	  	<td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $tt->tech; ?>)">See Tech</button></td>
                    		<td><?= $tt->vreme; ?></td>
                  		</tr>
                  		<?php endforeach; ?>
							   	 	</tbody>
							  	</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="trainingtomorrow">
							<div class="card">
								<div class="card-header">
			  					<div class="card-actions">
										<button type="button" class="card-action card-toggler" title="Collapse"></button>
										<button type="button" class="card-action card-reload" title="Reload"></button>
										<button type="button" class="card-action card-remove" title="Remove"></button>
			  					</div>
			  					<strong>Trainings List</strong>
								</div>
								<div class="card-body">
							  	<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
							    	<thead>
							    	  <tr>
							    	    <th>Seq.</th>
							    	    <th>Name</th>
							    	    <th>Vezba</th>
							    	    <th>Serii/Povtoruvanja</th>
							    	    <th>Tehnika</th>
							    	    <th>Vreme</th>
							    	  </tr>
							    	</thead>
							    	<tbody>
							      	<?php foreach($tomorrow_trainings as $tts): ?>
							      	<tr>
							       		<td><?= $tts->training_id; ?></td>
							       		<td><?= $tts->name; ?></td>
                  	 		<td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $tts->vezba; ?>)">See Exercise</button></td>
                  	  	<td><?= $tts->serii_povt; ?></td>
                  	  	<td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $tts->tech; ?>)">See Tech</button></td>
                    		<td><?= $tts->vreme; ?></td>
							      	</tr>
							      	<?php endforeach; ?>
							    	</tbody>
							  	</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="trainingweek">
							<div class="card">
								<div class="card-header">
			  					<div class="card-actions">
										<button type="button" class="card-action card-toggler" title="Collapse"></button>
										<button type="button" class="card-action card-reload" title="Reload"></button>
										<button type="button" class="card-action card-remove" title="Remove"></button>
			  					</div>
			  					<strong>Trainings List</strong>
								</div>
								<div class="card-body">
							  	<table id="demo-datatables-buttons-3" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
							    	<thead>
							    	  <tr>
							    	    <th>Seq.</th>
							    	    <th>Name</th>
							    	    <th>Vezba</th>
							    	    <th>Serii/Povtoruvanja</th>
							    	    <th>Tehnika</th>
							    	    <th>Vreme</th>
							    	    <th>Date</th>
							    	  </tr>
							    	</thead>
							    	<tbody>
							      	<?php foreach($all_trainings as $at): ?>
                  		<tr>
                  	  	<td><?= $at->training_id; ?></td>
                  	  	<td><?= $at->name; ?></td>
                  	  	<td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $at->vezba; ?>)">See Exercise</button></td>
                  	  	<td><?= $at->serii_povt; ?></td>
                  	  	<td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $at->tech; ?>)">See Tech</button></td>
                    		<td><?= $at->vreme; ?></td>
                    		<td><?= $at->date; ?></td>
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
	    
			<div id="Diets" class="tab" style="display: none">
				<div class="">
					<?php foreach($clients as $c): ?>
       		  <h3><?= $c->name; ?> <?= $c->surname; ?>'s Diet List</h3>
       		<?php endforeach; ?>
				</div>
				<div class="panel m-b-lg">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#mealtoday" data-toggle="tab">Today</a></li>
						<li><a href="#mealtomorrow" data-toggle="tab">Tomorrow</a></li>
						<li><a href="#mealweek" data-toggle="tab">Week</a></li>
					</ul>
					<div class="tab-content">

						<div class="tab-pane fade active in" id="mealtoday">
							<div class="card">
								<div class="card-header">
			  					<div class="card-actions">
										<button type="button" class="card-action card-toggler" title="Collapse"></button>
										<button type="button" class="card-action card-reload" title="Reload"></button>
										<button type="button" class="card-action card-remove" title="Remove"></button>
			  					</div>
			  					<strong>Diet List</strong>
								</div>
								<div class="card-body">
							  	<table id="demo-datatables-buttons-4" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
							    	<thead>
							    	  <tr>
							    	    <th>Seq.</th>
							    	    <th>Name</th>
							    	    <th>Vreme</th>
							    	    <th>Opcija 1</th>
							    	    <th>Opcija 2</th>
							    	    <th>Opcija 3</th>
							    	  </tr>
							    	</thead>
							    	<tbody>
							      	<?php foreach($today_meals as $tm): ?>
                 			<tr>
                 			  <td><?= $tm->meal_id; ?></td>
                 			  <td><?= $tm->name; ?></td>
                 			  <td><?= $tm->vreme; ?></td>
                 			  <td><?php if($tm->option1 != 0): ?> 
                 		      <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option1; ?>)">See Option</button>  
                   		  	<?php else: ?>
                   		  	  <p>No Option</p>
                   		  	<?php endif; ?>    
                   			</td>
                   			<td><?php if($tm->option2 != 0): ?> 
                   		    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option2; ?>)">See Option</button>  
                   		 		<?php else: ?>
                   		 		  <p>No Option</p>
                   		 		<?php endif; ?>    
                   			</td>
                   			<td><?php if($tm->option3 != 0): ?> 
                   			  <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option3; ?>)">See Option</button>  
                 		    	<?php else: ?>
                 		    	  <p>No Option</p>
                 		    	<?php endif; ?>    
                 		  	</td>
                 			</tr>
                 			<?php endforeach; ?>
							    	</tbody>
							  	</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="mealtomorrow">
							<div class="card">
								<div class="card-header">
			  					<div class="card-actions">
										<button type="button" class="card-action card-toggler" title="Collapse"></button>
										<button type="button" class="card-action card-reload" title="Reload"></button>
										<button type="button" class="card-action card-remove" title="Remove"></button>
			  					</div>
			  					<strong>Diet List</strong>
								</div>
								<div class="card-body">
							  	<table id="demo-datatables-buttons-5" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
							    	<thead>
							    	  <tr>
							    	    <th>Seq.</th>
							    	    <th>Name</th>
							    	    <th>Vreme</th>
							    	    <th>Opcija 1</th>
							    	    <th>Opcija 2</th>
							    	    <th>Opcija 3</th>
							    	  </tr>
							    	</thead>
							    	<tbody>
							      	<?php foreach($tomorrow_meals as $tms): ?>
                 			<tr>
                 			  <td><?= $tms->meal_id; ?></td>
                 			  <td><?= $tms->name; ?></td>
                 			  <td><?= $tms->vreme; ?></td>
                 			  <td><?php if($tms->option1 != 0): ?> 
                 		      <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option1; ?>)">See Option</button>  
                    	  	<?php else: ?>
                    	  	  <p>No Option</p>
                    	  	<?php endif; ?>    
                    		</td>
                    		<td><?php if($tms->option2 != 0): ?> 
                    	    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option2; ?>)">See Option</button>  
                    	  	<?php else: ?>
                    	  	  <p>No Option</p>
                    	  	<?php endif; ?>    
                    		</td>
                    		<td><?php if($tms->option3 != 0): ?> 
                    	    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option3; ?>)">See Option</button>  
                 		    	<?php else: ?>
                 		    	  <p>No Option</p>
                 		    	<?php endif; ?>    
                 		  	</td>
                 			</tr>
                 			<?php endforeach; ?>
							    	</tbody>
							  	</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="mealweek">
							<div class="card">
								<div class="card-header">
			  					<div class="card-actions">
										<button type="button" class="card-action card-toggler" title="Collapse"></button>
										<button type="button" class="card-action card-reload" title="Reload"></button>
										<button type="button" class="card-action card-remove" title="Remove"></button>
			  					</div>
			  					<strong>Diet List</strong>
								</div>
								<div class="card-body">
							  	<table id="demo-datatables-buttons-6" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
							    	<thead>
							    	  <tr>
							    	    <!-- <th>Seq.</th> -->
							    	    <th>Name</th>
							    	    <th>Vreme</th>
							    	    <th>Opcija 1</th>
							    	    <th>Opcija 2</th>
							    	    <th>Opcija 3</th>
							    	    <th>Date</th>
							    	  </tr>
							    	</thead>
							    	<tbody>
							    	  <?php foreach($all_meals as $ams): ?>
                  		<tr>
                  	  	<td><?= $ams->meal_id; ?></td>
                  	  	<td><?= $ams->name; ?></td>
                  	  	<td><?= $ams->vreme; ?></td>
                  	  	<td><?php if($ams->option1 != 0): ?> 
                  	      <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option1; ?>)">See Option</button>  
                   		  	<?php else: ?>
                   		  	  <p>No Option</p>
                   		  	<?php endif; ?>    
                   			</td>
                   			<td><?php if($ams->option2 != 0): ?> 
                   		    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option2; ?>)">See Option</button>  
                    	  	<?php else: ?>
                    	  	  <p>No Option</p>
                    	  	<?php endif; ?>    
                    		</td>
                    		<td><?php if($ams->option3 != 0): ?> 
                    	    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option3; ?>)">See Option</button>  
                  	    	<?php else: ?>
                  	    	  <p>No Option</p>
                  	    	<?php endif; ?>    
                  	  	</td>
                  	  	<td><?= $ams->date; ?></td>
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

		</div>
	</div>

	<!-- Modal Meal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content animated flipInY">
	      <div class="modal-header">
	        <h3 class="modal-title text-primary text-center" id="modalOpName"></h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h4 class="text-primary text-center">Состојки</h4>
	        <div id="modalSostojki" style="text-align: center;">Sostojki:</div>
	        <hr>
	        <h4 class="text-primary text-center">Макронутриенти</h4>
	        <div class="row">
	        	<div class="col-md-4">
	        		<div id="modalProteins" class="text-center">Proteini:</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div id="modalCarbohydrates" class="text-center">Jaglenohidrati:</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div id="modalFats" class="text-center">Masti:</div>
	        	</div>
	        </div>
	        <br>
	        <div class="text-center mark bg-primary" id="modalCalories">Kalorii:</div>
	        <hr>
	        <h4 class="text-primary text-center dt">Начин на Подготовка</h4>
	        <div id="modalDescription" style="text-align: center;">Description:</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Training -->
	<div class="modal fade" id="exampleTrainingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content animated flipInY">
	      <div class="modal-header">
	        <!--<h5 class="modal-title" id="modalTechName"></h5>-->
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<h4 class="text-primary text-center">Име на Техника</h4>
	        <div id="modalName" style="text-align: center;">Name:</div>
	        <hr>
	        <h4 class="text-primary text-center">Линк за Техника</h4>
	        <div id="modalLink" style="text-align: center;">Link:</div>
	        <hr>
	        <h4 class="text-primary text-center">Објаснување</h4>
	        <div id="modalTrainingDescription" style="text-align: center;">Description:</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Vezba-->
	<div class="modal fade" id="exampleVezbaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content animated flipInY">
	      <div class="modal-header">
	        <!--<h5 class="modal-title" id="modalVezbaName1"></h5>-->
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<h4 class="text-primary text-center">Име на Вежба</h4>
	        <div id="modalVezbaName" style="text-align: center;">Name:</div>
	        <hr>
	        <h4 class="text-primary text-center">Линк за Вежба</h4>
	        <div id="modalVezbaLink" style="text-align: center;">Link:</div>
	        <hr>
	        <h4 class="text-primary text-center">Мускулна Група</h4>
	        <div id="modalVezbaMuscle" style="text-align: center;">Muskulna Grupa:</div>
	        <hr>
	        <h4 class="text-primary text-center">Објаснување</h4>
	        <div id="modalVezbaDescription" style="text-align: center;">Description:</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
	      </div>
	    </div>
	  </div>
	</div>
</section>

<script type="text/javascript">
var modalOpName = document.getElementById("modalOpName")
var modalSostojki = document.getElementById("modalSostojki")
var modalProteins = document.getElementById("modalProteins")
var modalCarbohydrates = document.getElementById("modalCarbohydrates")
var modalFats = document.getElementById("modalFats")
var modalCalories = document.getElementById("modalCalories")
var modalDescription = document.getElementById("modalDescription")

modalSostojki.innerHTML = "proba"
console.log(modalSostojki)


  function seeOption(t){

    console.log(t)

    fetch("/chose_option.php", {
        	method: "POST",
        	headers: {
           	"Content-Type": "application/json",
           	Accept: 'application/json'
        	},
        		body: JSON.stringify(t)
      		}).then((response) => {
  				  return response.text()
  				})
  				.then((data) => {
  				  // Work with JSON data here  
  				  var theItem = JSON.parse(data.slice(57,-1))
  				  modalOpName.innerHTML = "" + theItem.name
  				  modalSostojki.innerHTML = "" + theItem.sostojki
  				  modalProteins.innerHTML = "Протеини<br>" + theItem.proteins + "гр"
  				  modalCarbohydrates.innerHTML = "Јагленохидрати<br>" + theItem.carbohydrates + "гр"
  				  modalFats.innerHTML = "Масти<br>" + theItem.fats + "гр"
  				  modalCalories.innerHTML = "Вкупно Калории : " + ((parseInt(theItem.proteins) * 4) + (parseInt(theItem.carbohydrates) * 4) + (parseInt(theItem.fats) * 9)) + " kCal"
  				  modalDescription.innerHTML = "" + theItem.description

  				})
  				.catch((err) => {
  				  console.log(err)
  				})

  }
</script>

<script type="text/javascript">
// var modalTechName = document.getElementById("modalTechName")
var modalName = document.getElementById("modalName")
var modalLink = document.getElementById("modalLink")
var modalTrainingDescription = document.getElementById("modalTrainingDescription")

	function seeOptionTraining(t){

		console.log(t)

		fetch("/chose_tech.php", {
        	method: "POST",
        	headers: {
           	"Content-Type": "application/json",
           	Accept: 'application/json'
        	},
        		body: JSON.stringify(t)
      		}).then((response) => {
      			  // console.log(response)
  				  return response.text()
  				})
  				.then((data) => {
  				  // Work with JSON data here
  				  // console.log(data[0])
  				  var theItem = JSON.parse(data.slice(57, -1))
  				  //modalTechName.innerHTML = "" + theItem.name
  				  modalName.innerHTML = "" + theItem.name
  				  modalLink.innerHTML = "" + theItem.link
  				  modalTrainingDescription.innerHTML = "" + theItem.description

  				})
  				.catch((err) => {
  				  // Do something for an error here
  				})

	}
</script>

<script type="text/javascript">
// var modalVezbaName1 = document.getElementById("modalVezbaName1")
var modalVezbaName = document.getElementById("modalVezbaName")
var modalVezbaLink = document.getElementById("modalVezbaLink")
var modalVezbaMuscle = document.getElementById("modalVezbaMuscle")
var modalVezbaDescription = document.getElementById("modalVezbaDescription")

  function seeVezba(t){

    console.log(t)

    fetch("/chose_vezba.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: 'application/json'
          },
            body: JSON.stringify(t)
          }).then((response) => {
              // console.log(response)
            return response.text()
          })
          .then((data) => {
            // Work with JSON data here
            // console.log(data[0])
            var theItem = JSON.parse(data.slice(57, -1))
            // modalVezbaName1.innerHTML = "" + theItem.name
            modalVezbaName.innerHTML = "" + theItem.name
            modalVezbaLink.innerHTML = "" + theItem.link_vezba
            modalVezbaMuscle.innerHTML = "" + theItem.muskulna_grupa
            modalVezbaDescription.innerHTML = "" + theItem.description

          })
          .catch((err) => {
            // Do something for an error here
          })

  }
</script>
