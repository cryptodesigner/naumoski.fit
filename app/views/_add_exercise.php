<?php
	$message = '';
  	if (isset ($_POST['name'])  && isset($_POST['link_vezba'])  && isset($_POST['muskulna_grupa'])  && isset($_POST['description'])) {
    $name = $_POST['name'];
    $link_vezba = $_POST['link_vezba'];
    $muskulna_grupa = $_POST['muskulna_grupa'];
    $description = $_POST['description'];

    $sql = 'INSERT INTO vezbi(name, link_vezba, muskulna_grupa, description) VALUES(:name, :link_vezba, :muskulna_grupa, :description)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':link_vezba' => $link_vezba, ':muskulna_grupa' => $muskulna_grupa, ':description' => $description])) {
      $message = 'Успешно Додадено';
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
			  <span class="d-ib">Додади Вежба</span>
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
							<input class="md-form-control" type="text" name="name" id="name" placeholder="Име на Вежба">
					</div>

					<div class="md-form-group">
							<input class="md-form-control" type="text" name="link_vezba" id="link_vezba" placeholder="Линк">
							<label class="md-control-label"></label>
					</div>
					
					<div class="md-form-group">
						<select class="md-form-control" name="muskulna_grupa" id="muskulna_grupa" data-msg="Muscle">
							<option value="" disabled="disabled" selected="selected">Мускулна Група</option>
							<option value="Гради">Гради</option>
							<option value="Грб">Грб</option>
							<option value="Рамо">Рамо</option>
							<option value="Бицепс">Бицепс</option>
							<option value="Трицепс">Трицепс</option>
							<option value="Стомак">Стомак</option>
							<option value="Нозе">Нозе</option>
						</select>
					</div>
					
					<div class="md-form-group">
							<input class="md-form-control" type="text" name="description" id="description" placeholder="Дескрипција">
					</div>

					<button class="btn btn-default btn-block" type="submit">Додади Вежба</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>