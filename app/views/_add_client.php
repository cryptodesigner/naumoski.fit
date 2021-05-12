<?php
  $message = '';
  if (isset ($_POST['name']) && isset ($_POST['surname']) && isset ($_POST['email']) && isset ($_POST['password'])) {
    $managers_manager_id = $_SESSION["manager_id"];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $sql = 'INSERT INTO clients(managers_manager_id, name, surname, email, password) VALUES(:managers_manager_id, :name, :surname, :email, :password)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':managers_manager_id' => $managers_manager_id, ':name' => $name, ':surname' => $surname, ':email' => $email, ':password' => $password])) {
      $message = 'Client Added Successfully';
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
			<span class="d-ib">Add Client</span>
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
					<input class="md-form-control" type="text" name="name" id="name" placeholder="Name">
					<label class="md-control-label"></label>
				  </div>
				</div>
				<div class="col-xs-6">
				  <div class="md-form-group">
					<input class="md-form-control" type="text" name="surname" id="surname" placeholder="Surname">
					<label class="md-control-label"></label>
				  </div>
				</div>
			  </div>
			</div>
			<div class="md-form-group">
			  <input class="md-form-control" type="text" name="email" id="email" placeholder="Email">
			  <label class="md-control-label"></label>
			</div>
			<div class="md-form-group">
			  <input class="md-form-control" type="password" name="password" id="password" placeholder="Password">
			  <label class="md-control-label"></label>
			</div>
			<button id="demo-show-toast" class="btn btn-default btn-block" type="submit">Add Client</button>
		  </div>
		</div>
	  </div>
	</form>
</div>
</section>