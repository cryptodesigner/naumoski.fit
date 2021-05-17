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
	    $message = 'Ажурирано Успешно';
	  }
	  else{
  		$message = 'Настанат проблем, обидете се повторно';
  	}
	}
?>

<section>
<div class="layout-content-body">
	<div class="title-bar">
	  <h1 class="title-bar-title">
			<span class="d-ib">Уредување на Клиент</span>
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
			  <div class="row">
				<div class="col-xs-6">
				  <div class="md-form-group">
					<input value="<?= $client->name; ?>" class="md-form-control" type="text" name="name" id="name" placeholder="Име">
				  </div>
				</div>
				<div class="col-xs-6">
				  <div class="md-form-group">
					<input value="<?= $client->surname; ?>" class="md-form-control" type="text" name="surname" id="surname" placeholder="Презиме">
				  </div>
				</div>
			  </div>
			</div>
			<div class="md-form-group">
			  <input value="<?= $client->email; ?>" class="md-form-control" type="text" name="email" id="email" placeholder="Емаил">
			</div>
			<!-- <div class="md-form-group">
			  <input class="md-form-control" type="password" name="password" id="password" placeholder="Password">
			</div> -->
			<button class="btn btn-default btn-block" type="submit">Ажурирај Клиент</button>
		  </div>
		</div>
	  </div>
	</form>
</div>
</section>