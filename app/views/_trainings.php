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
			  <span class="d-ib">Листа На Тренинзи</span>
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
			  		<strong>Листа На Тренинзи</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-8" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<!-- <th>Seq.</th>-->
									<th>Клиент</th> 
									<th>Име</th>
									<th>Вежба</th>
									<th>Серии / Повт</th>
									<th>Техника</th>
									<th>Време</th>
									<th>Дата</th>
									<th>Бриши</th>
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($trainings as $training): ?>
								<tr>
					  			<!-- <td>{{training['training_id']}}</td>-->
					  			<td><?= $training->clients_client_id; ?></td> 
					  			<td><?= $training->name; ?></td>
					  			<td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $training->vezba; ?>)">Преглед</button></td>
					  			<td><?= $training->serii_povt; ?></td>
					  			<td><button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $training->tech; ?>)">Преглед</button></td>
					  			<td><?= $training->vreme; ?></td>
					  			<td><?= $training->date; ?></td>
					  			<td>
									<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_training.php?training_id=<?= $training->training_id ?>" class='btn btn-danger'>Бриши</a>
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
	        <div class="text-center">
	        	<!-- <a class="btn btn-primary video-btn" data-toggle="modal" id="modalVezbaLink" data-src="modalVezbaLink" data-target="#myModal">Watch</a> -->
	        	<a id="modalLink" target="blank">Link:</a>
	        </div>
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
	        <div class="text-center">
	        	<!-- <a type="button" class="btn btn-primary video-btn" data-toggle="modal" href="modalVezbaLink" data-target="#myModal">Watch</a> -->
	        	<a id="modalVezbaLink" target="blank">Link:</a>
	        </div>
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

	<!-- Modal Video -->
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
            modalVezbaLink.innerHTML = "" + theItem.link_vezba
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