<?php
	require 'db.php';
	$client_id = $_GET['client_id'];
	$sql = 'SELECT * FROM clients WHERE client_id=:client_id';
	$statement = $connection->prepare($sql);
	$statement->execute([':client_id' => $client_id ]);
	$client = $statement->fetch(PDO::FETCH_OBJ);
	if (isset ($_POST['name'])  && isset($_POST['surname'])  && isset($_POST['email']) ) {
	  $name = $_POST['name'];
	  $surname = $_POST['surname'];
	  $email = $_POST['email'];
	  // $password = $_POST['password'];
	  // $password = md5($password);
	  
	  $sql = 'UPDATE clients SET name=:name, surname=:surname, email=:email WHERE client_id=:client_id';
	  $statement = $connection->prepare($sql);
	  if ($statement->execute([':name' => $name, ':surname' => $surname, ':email' => $email, ':client_id' => $client_id])) {
	    // header("location: clients.php");
	  }
	}
?>

<section>
<div class="layout-content-body">
	<div class="title-bar">
	  <h1 class="title-bar-title">
			<span class="d-ib">Edit Client</span>
	  </h1>
	</div>
	
	<form data-toggle="md-validator" action="" method="POST">
	  <div class="row">
		<div class="col-sm-6 col-sm-offset-3">
		  <div class="demo-md-form-wrapper">
			<div class="md-form-group">
			  <div class="row">
				<div class="col-xs-6">
				  <div class="md-form-group">
					<input value="<?= $client->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Name">
				  </div>
				</div>
				<div class="col-xs-6">
				  <div class="md-form-group">
					<input value="<?= $client->surname; ?>" class="md-form-control" type="text" name="surname" id="surname" placeholder="Surname">
				  </div>
				</div>
			  </div>
			</div>
			<div class="md-form-group">
			  <input value="<?= $client->email; ?>" class="md-form-control" type="text" name="email" id="email" placeholder="Email">
			</div>
			<!-- <div class="md-form-group">
			  <input class="md-form-control" type="password" name="password" id="password" placeholder="Password">
			</div> -->
			<button class="btn btn-default btn-block" type="submit">Update Client</button>
		  </div>
		</div>
	  </div>
	</form>
</div>
</section>