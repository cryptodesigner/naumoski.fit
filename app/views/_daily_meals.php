<?php
	$sql = 'SELECT * FROM meals';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$meals = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">All Daily Meals</span>
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
			  		<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<!-- <th>Seq.</th>-->
									<th>Client</th> 
									<th>Name</th>
									
									<th>Vreme</th>
									<th>Option1</th>
									<th>Option2</th>
									<th>Option3</th>
									<th>Date</th>
									<th>Action</th>
									<!-- <th>Action</th> -->
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($meals as $meal): ?>
				  			<tr>
				  				<td><?= $meal->clients_client_id; ?></td>
									<td><?= $meal->name; ?></td>
									<td><?= $meal->vreme; ?></td>
									<td><?php if($meal->option1 != 0): ?> 
                 		      <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $meal->option1; ?>)">See Option</button>  
                   		  <?php else: ?>
                   		    <p>No Option</p>
                   		  <?php endif; ?>    
                   		</td>
                   		<td><?php if($meal->option2 != 0): ?> 
                   		    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $meal->option2; ?>)">See Option</button>  
                   		  <?php else: ?>
                   		    <p>No Option</p>
                   		  <?php endif; ?>    
                   		</td>
                   		<td><?php if($meal->option3 != 0): ?> 
                   		    <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $meal->option3; ?>)">See Option</button>  
                 		    <?php else: ?>
                 		      <p>No Option</p>
                 		    <?php endif; ?>    
                 		  </td>
									<td><?= $meal->date ?></td>
									<td>
										<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_meal.php?meal_id=<?= $meal->meal_id ?>" class='btn btn-danger'>Delete</a>
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

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content animated flipInY">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Current Option Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<h4 class="text-primary text-center">Opcija - Sostojki</h4>
	        <div id="modalSostojki" style="text-align: center;">Sostojki:</div>
	        <hr>
	        <h4 class="text-primary text-center">Macro Nutrienti</h4>
	        <div id="modalProteins" style="text-align: center;">Proteini:</div>
	        <div id="modalCarbohydrates" style="text-align: center;">Jaglenohidrati:</div>
	        <div id="modalFats" style="text-align: center;">Masti:</div>
	        <hr>
	        <h4 class="text-primary text-center">Objasnuvanje</h4>
	        <div id="modalDescription" style="text-align: center;">Description:</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</section>

<script type="text/javascript">
var modalSostojki = document.getElementById("modalSostojki")
var modalProteins = document.getElementById("modalProteins")
var modalCarbohydrates = document.getElementById("modalCarbohydrates")
var modalFats = document.getElementById("modalFats")
var modalDescription = document.getElementById("modalDescription")

modalSostojki.innerHTML = "proba"
// console.log(modalSostojki)


	function seeOption(t){

		// console.log(t)


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
  				  modalSostojki.innerHTML = "" + theItem.sostojki
  				  modalProteins.innerHTML = "Proteini : " + theItem.proteins
  				  modalCarbohydrates.innerHTML = "Jaglenohidrati : " + theItem.carbohydrates
  				  modalFats.innerHTML = "Masti : " + theItem.fats
  				  modalDescription.innerHTML = "" + theItem.description

  				})
  				.catch((err) => {
  				  console.log(err)
  				})

	}
</script>