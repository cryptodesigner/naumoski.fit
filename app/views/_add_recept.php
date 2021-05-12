<?php
	$message = '';
  if (isset ($_POST['name']) && isset ($_POST['description']) && isset ($_POST['link'])) {
  	$managers_manager_id = $_SESSION["manager_id"];
  	$name = $_POST['name'];
  	$description = $_POST['description'];
  	$link = $_POST['link'];
  
  	$sql = 'INSERT INTO recepts(managers_manager_id, name, description, link) VALUES(:managers_manager_id, :name, :description, :link)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':managers_manager_id' => $managers_manager_id, ':name' => $name, ':description' => $description, ':link' => $link])) {
  	  $message = 'Recept Added Successfully';
  	}
  	else{
      $message = 'Problem Occured, Try Again';
    }
  }
?>
<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
		  	<span class="d-ib">Add Recept</span>
			</h1>
			<?php if(!empty($message)): ?>
      <div class="alert alert-success">
        <?= $message; ?>
      </div>
    	<?php endif; ?>
	  </div>
	  <form data-toggle="md-validator" action="" method="POST">
			<div class="row">
		  	<div class="col-sm-6 col-sm-offset-3">
					<div class="demo-md-form-wrapper">
			  		<div class="md-form-group">
							<input class="md-form-control" type="text" name="name" id="name" placeholder="Recept Name">
							<label class="md-control-label"></label>
			  		</div>
			  		<div class="md-form-group">
							<input class="md-form-control" type="text" name="description" id="description" placeholder="Description">
							<label class="md-control-label"></label>
			  		</div>
			  		<div class="md-form-group">
							<input class="md-form-control" type="text" name="link" id="link" placeholder="Link">
							<label class="md-control-label"></label>
			  		</div>
			  		<button class="btn btn-default btn-block" type="submit">Add Recept</button>
					</div>
		  	</div>
			</div>
	  </form>
	</div>
</section>