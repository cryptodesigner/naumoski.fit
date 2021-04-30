<?php
	$sql = 'SELECT * FROM trainings';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$trainings = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">All Trainings</span>
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
			  		<strong>Trainings List</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<!-- <th>Seq.</th>-->
									<th>Client</th> 
									<th>Name</th>
									<th>Vezba</th>
									<th>Serii / Povt</th>
									<th>Technique</th>
									<th>Vreme</th>
									<th>Date</th>
									<th>Action</th>
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($trainings as $training): ?>
								<tr>
					  			<!-- <td>{{training['training_id']}}</td>-->
					  			<td><?= $training->clients_client_id; ?></td> 
					  			<td><?= $training->name; ?></td>
					  			<td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $training->vezba; ?>)">See Exercise</button></td>
					  			<td><?= $training->serii_povt; ?></td>
					  			<td><button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $training->tech; ?>)">See Option</button></td>
					  			<td><?= $training->vreme; ?></td>
					  			<td><?= $training->date; ?></td>
					  			<td>
									<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_training.php?training_id=<?= $training->training_id ?>" class='btn btn-danger'>Delete</a>
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
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Current Technique Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="modalName">Name:</div>
	        <div id="modalLink">Link:</div>
	        <div id="modalDescription">Description:</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Vezba-->
	<div class="modal fade" id="exampleVezbaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Current Exercise Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="modalVezbaName">Name:</div>
	        <div id="modalVezbaLink">Link:</div>
	        <div id="modalVezbaMuscle">Muskulna Grupa:</div>
	        <div id="modalVezbaDescription">Description:</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

</section>

<script type="text/javascript">
var modalName = document.getElementById("modalName")
var modalLink = document.getElementById("modalLink")
var modalDescription = document.getElementById("modalDescription")

	function seeOption(t){

		// console.log(t)

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
  				  modalName.innerHTML = "Name: " + theItem.name
  				  modalLink.innerHTML = "Link : " + theItem.link
  				  modalDescription.innerHTML = "Description : " + theItem.description

  				})
  				.catch((err) => {
  				  // Do something for an error here
  				})

	}
</script>

<script type="text/javascript">
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
            modalVezbaName.innerHTML = "Name: " + theItem.name
            modalVezbaLink.innerHTML = "Link : " + theItem.link_vezba
            modalVezbaMuscle.innerHTML = "Muskulna Grupa : " + theItem.muskulna_grupa
            modalVezbaDescription.innerHTML = "Description : " + theItem.description

          })
          .catch((err) => {
            // Do something for an error here
          })

  }
</script>