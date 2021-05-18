<?php
	$sql = 'SELECT * FROM recepts';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$recepts = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
<script src="https://cdn.rawgit.com/JacobLett/bootstrap4-latest/master/bootstrap-4-latest.min.js"></script>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Листа На Рецепти</span>
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
			  		<strong>Листа На Рецепти</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-8" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
				  			<tr>
									<th>Р.б.</th>
									<th>Менаџер</th>
									<th>Име</th>
									<th>Дескрипција</th>
									<th>Линк</th>
									<th>Бриши</th>
									<th>Уреди</th>
				  			</tr>
							</thead>
							<tbody>
				  			<?php foreach($recepts as $recept): ?>
				  			<tr>
									<td><?= $recept->recept_id; ?></td>
									<td><?= $recept->managers_manager_id; ?></td>
									<td><?= $recept->name; ?></td>
									<td><?= $recept->description; ?></td>
									<td><button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="<?= $recept->link; ?>" data-target="#myModal">Преглед</button></td>
									<td>
					  				<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_recept.php?recept_id=<?= $recept->recept_id ?>" class='btn btn-danger'>Бриши</a>
									</td>
									<td>
					  				<a href="edit_recept.php?recept_id=<?= $recept->recept_id ?>" class='btn btn-default'>Уреди</a>
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