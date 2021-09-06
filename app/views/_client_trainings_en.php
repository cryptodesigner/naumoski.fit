<?php
	$clients_client_id = $_SESSION["client_id"];
 	$sql = "SELECT * FROM trainings WHERE clients_client_id = $clients_client_id ";
 	$statement = $connection->prepare($sql);
  $statement->execute();
  $trainings = $statement->fetchAll(PDO::FETCH_OBJ);
?>


<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">List of Trainings</span>
			</h1>

			<span><a style="color: white;" href="client_trainings.php">MK</a> <span style="color: white;">|</span> <a style="color: white;" href="client_trainings_en.php">EN</a></span>
			
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
			  		<strong>List of Trainings</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-5" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<th>Seq.</th>
									<th>Name</th>
									<th>Exercise</th>
									<th>Ser/Rep</th>
									<th>Technique</th>
									<th>Date</th>
									<th>Time</th>
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($trainings as $t): ?>
								<tr>
					  			<td><?= $t->training_id; ?></td>
					  			<td><?= $t->name; ?></td>
					  			<td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $t->vezba; ?>)">Show</button></td>
					  			<td><?= $t->serii_povt; ?></td>
					  			<td><button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $t->tech; ?>)">Show</button></td>
					  			<td><?= $t->date; ?></td>
					  			<td><?= $t->vreme; ?></td>
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
	        <!--<h5 class="modal-title" id="modalTechName"></h5>-->
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h4 class="text-primary text-center">Tech Name</h4>
	        <div id="modalName" style="text-align: center;">Name:</div>
	        <hr>
	        <h4 class="text-primary text-center">Tech Link</h4>
	        <div class="text-center">
	        	<!-- <button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="modalLink" data-target="#myModal">Watch</button> -->
	        	<a id="modalLink" target="blank">Link:</a>
	        </div>
	        <hr>
	        <h4 class="text-primary text-center">Description</h4>
	        <div id="modalDescription" style="text-align: center;">Description:</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
	        <h4 class="text-primary text-center">Exercise Name</h4>
	        <div id="modalVezbaName" style="text-align: center;">Name:</div>
	        <hr>
	        <h4 class="text-primary text-center">Exercise Link</h4>
	        <div class="text-center">
	        	<!-- <button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="modalVezbaLink" data-target="#myModal">Watch</button> -->
	        	<a id="modalVezbaLink" target="blank">Link:</a>
	        </div>
	        <hr>
	        <h4 class="text-primary text-center">Muscle Group</h4>
	        <div id="modalVezbaMuscle" style="text-align: center;">Muscle Group:</div>
	        <hr>
	        <h4 class="text-primary text-center">Description</h4>
	        <div id="modalVezbaDescription" style="text-align: center;">Description:</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    	  <div class="modal-body">
    	   	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	      <span aria-hidden="true">&times;</span>
    	    </button>        
    		  <!-- 16:9 aspect ratio -->
					<div class="embed-responsive embed-responsive-16by9">
  					<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
					</div>
		    </div>
		  </div>
		</div>
	</div> 

</section>


<script type="text/javascript">
// var modalTechName = document.getElementById("modalTechName")
var modalName = document.getElementById("modalName")
var modalLink = document.getElementById("modalLink")
var modalDescription = document.getElementById("modalDescription")

	function seeOption(t){

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
  				  modalLink.href = theItem.link
  				  modalDescription.innerHTML = "" + theItem.description

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
            modalVezbaLink.innerHTML = theItem.link_vezba
            modalVezbaLink.href = theItem.link_vezba
            modalVezbaMuscle.innerHTML = "" + theItem.muskulna_grupa
            modalVezbaDescription.innerHTML = "" + theItem.description

          })
          .catch((err) => {
            // Do something for an error here
          })

  }
</script>


<script>
	$(document).ready(function() {
	// Gets the video src from the data-src on each button
	var $videoSrc;  
	$('.video-btn').click(function() {
	    $videoSrc = $(this).data( "src" );
	});
	console.log($videoSrc);
	// when the modal is opened autoplay it  
	$('#myModal').on('shown.bs.modal', function (e) {
	// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... 	you never know what you're gonna get
	$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
	})
	// stop playing the youtube video when I close the modal
	$('#myModal').on('hide.bs.modal', function (e) {
	    // a poor man's stop video
	    $("#video").attr('src',$videoSrc); 
	})   
	// document ready  
	});
</script>