<?php
	$client_id = $_SESSION['client_id']; 	
 	$sql = "SELECT * FROM meals WHERE clients_client_id = '$client_id.' ORDER BY date DESC, vreme ASC;";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $meals = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">List of Meals</span>
			</h1>

			<span><a style="color: white;" href="client_meals.php">MK</a> <span style="color: white;">|</span> <a style="color: white;" href="client_meals_en.php">EN</a></span>
			
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
						<strong>List of Meals</strong>
					</div>
					<div class="card-body">
						<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Seq.</th>
									<th>Name</th>
									<th>Time</th>
									<th>Option 1</th>
									<th>Option 2</th>
									<th>Option 3</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($meals as $meal): ?>
								<tr>
									<td><?= $meal->meal_id; ?></td>
									<td><?= $meal->name; ?></td>
									<td><?= $meal->vreme; ?></td>
									<td><?php if($meal->option1 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $meal->option1; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                    </td>
                    <td><?php if($meal->option2 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $meal->option2; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                    </td>
                    <td><?php if($meal->option3 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $meal->option3; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                    </td>
									<td><?= $meal->date; ?></td>
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
	        <h3 class="modal-title text-primary text-center" id="modalOpName"></h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h4 class="text-primary text-center">Ingredients</h4>
	        <div id="modalSostojki" style="text-align: center;">Ingredients:</div>
	        <hr>
	        <h4 class="text-primary text-center">Macronutrients</h4>
	        <div class="row">
	        	<div class="col-md-4">
	        		<div id="modalProteins" class="text-center">Proteins:</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div id="modalCarbohydrates" class="text-center">Carbohydrates:</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div id="modalFats" class="text-center">Fats:</div>
	        	</div>
	        </div>
	        <br>
	        <div class="text-center mark bg-primary" id="modalCalories">calories:</div>
	        <hr>
	        <h4 class="text-primary text-center dt">Method of Preparation</h4>
	        <div id="modalDescription" style="text-align: center;">Description:</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
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

	// modalSostojki.innerHTML = "proba"
	// console.log(modalSostojki)


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
  				  modalProteins.innerHTML = "????????????????<br>" + theItem.proteins + "????"
  				  modalCarbohydrates.innerHTML = "????????????????????????<br>" + theItem.carbohydrates + "????"
  				  modalFats.innerHTML = "??????????<br>" + theItem.fats + "????"
  				  modalCalories.innerHTML = "???????????? ?????????????? : " + ((parseInt(theItem.proteins) * 4) + (parseInt(theItem.carbohydrates) * 4) + (parseInt(theItem.fats) * 9)) + " kCal"
  				  modalDescription.innerHTML = "" + theItem.description

  				})
  				.catch((err) => {
  				  console.log(err)
  				})

		}
	</script>