<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Add Exercise</span>
			</h1>
	  </div>
	  <form data-toggle="md-validator" action="" method="POST">
			<div class="row">
			  <div class="col-sm-6 col-sm-offset-3">
					<div class="demo-md-form-wrapper">
					
					<div class="md-form-group">
							<input class="md-form-control" type="text" name="name" id="name" placeholder="Exercise Name">
							<label class="md-control-label"></label>
					</div>

					<div class="md-form-group">
							<input class="md-form-control" type="text" name="link_vezba" id="link_vezba" placeholder="Link na Vezba">
							<label class="md-control-label"></label>
					</div>
					
					<div class="md-form-group">
						<select class="md-form-control" name="muskulna_grupa" id="muskulna_grupa" data-msg="Muscle">
							<option value="" disabled="disabled" selected="selected">Muscle</option>
							<option value="Раце">Раце</option>
							<option value="Нозе">Нозе</option>
							<option value="Грб">Грб</option>
							<option value="Гради">Гради</option>
						</select>
					</div>
					
					<div class="md-form-group">
							<input class="md-form-control" type="text" name="description" id="description" placeholder="Description">
							<label class="md-control-label"></label>
					</div>

					<button class="btn btn-default btn-block" type="submit">Add Exercise</button>
					</div>
			</div>
			</div>
	  </form>
	</div>
</section>