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
			  		<table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
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
	    <div class="modal-content animated flipInY">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTechName"></h5>
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
	        <div id="modalDescription" style="text-align: center;">Description:</div>

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
	        <h5 class="modal-title" id="modalVezbaName1"></h5>
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
var modalTechName = document.getElementById("modalTechName")
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
  				  modalTechName.innerHTML = "" + theItem.name
  				  modalName.innerHTML = "" + theItem.name
  				  modalLink.innerHTML = "" + theItem.link
  				  modalDescription.innerHTML = "" + theItem.description

  				})
  				.catch((err) => {
  				  // Do something for an error here
  				})

	}
</script>

<script type="text/javascript">
var modalVezbaName1 = document.getElementById("modalVezbaName1")
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
            modalVezbaName1.innerHTML = "" + theItem.name
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