<?php
	$manager_id = $_SESSION['manager_id'];
  $sql = 'SELECT * FROM managers WHERE manager_id = :manager_id';
  $statement = $connection->prepare($sql);
  $statement->execute([':manager_id' => $manager_id ]);
  $person = $statement->fetch(PDO::FETCH_OBJ);

  $message = '';
  if (isset ($_POST['newpass'])) {
    $newpass = $_POST['newpass'];
    $newpass = md5($newpass);
    $sql = 'UPDATE managers SET password = :newpass WHERE manager_id = :manager_id';
    $statement = $connection->prepare($sql);

    if ($statement->execute([':newpass' => $newpass, ':manager_id' => $manager_id])) {
      $message = 'Password Changed Successfully';
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
	      <span class="d-ib">Change Password</span>
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
	            <input class="md-form-control" type="password" name="newpass" id="newpass" minlength="6" placeholder="New Password" required>
	            <label class="md-control-label"></label>
	          </div>
	          
	          <button class="btn btn-default btn-block" type="submit">Submit</button>
	        </div>
	      </div>
	    </div>
	  </form>
	</div>
</section>