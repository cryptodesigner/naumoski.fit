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
									<!-- <th>Seq.</th>
									<th>Client</th> -->
									<th>Name</th>
									
									<th>Vreme</th>
									<th>Option1</th>
									<th>Option2</th>
									<th>Option3</th>
									<th>Date</th>
									<!-- <th>Action</th> -->
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($meals as $meal): ?>
				  			<tr>
									<td><?= $meal->name; ?></td>
									<td><?= $meal->vreme; ?></td>

									<td>";
									  if ($meal->option1 == 0){echo <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption($meal->option1)">See Option</button>}
									  else {echo 'No Option';}
									  echo
									"</td>
									
									<td><?= $meal->option2; ?></td>
									<td><?= $meal->option3; ?></td>
									<td><?= $meal->date ?></td>
									
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
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Current Option Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="modalSostojki">Sostojki:</div>
	        <div id="modalProteins">Proteini:</div>
	        <div id="modalCarbohydrates">Jaglenohidrati:</div>
	        <div id="modalFats">Masti:</div>
	        <div id="modalDescription">Description:</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
console.log(modalSostojki)


	function seeOption(t){

		console.log(t)

		fetch("/chose_option", {
        	method: "POST",
        	headers: {
           	"Content-Type": "application/json",
           	Accept: 'application/json'
        	},
        		body: JSON.stringify(t)
      		}).then((response) => {
      			  console.log(response)
  				  return response.json()
  				})
  				.then((data) => {
  				  // Work with JSON data here
  				  console.log(data[0])
  				  modalSostojki.innerHTML = "Sostoji: " + data[0].sostojki
  				  modalProteins.innerHTML = "Proteini : " + data[0].proteins
  				  modalCarbohydrates.innerHTML = "Jaglenohidrati : " + data[0].carbohydrates
  				  modalFats.innerHTML = "Masti : " + data[0].fats
  				  modalDescription.innerHTML = "Description : " + data[0].description

  				})
  				.catch((err) => {
  				  // Do something for an error here
  				})

	}
</script>