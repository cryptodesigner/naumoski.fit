<section>
	<div class="layout-content-body">
		<div class="title-bar">
		  <h1 class="title-bar-title">
				<span class="d-ib">Add Training</span>
		  </h1>
		</div>
		<form data-toggle="md-validator" action="{{url_for('add_training')}}" method="POST">
		  <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
			  	<div class="demo-md-form-wrapper">
						<div class="md-form-group">
				  		<input class="md-form-control" type="text" name="name" id="name" placeholder="Training Name">
				  		<label class="md-control-label"></label>
						</div>
						<div class="md-form-group">
				  		<input class="md-form-control" type="text" name="serii_povt" id="serii_povt" placeholder="Serii / Povtoruvanja">
				  		<label class="md-control-label"></label>
						</div>
						<div class="md-form-group">
				  		<input class="md-form-control" type="text" name="link_vezba" id="link_vezba" placeholder="Video Link na Vezba (youtube)">
				  		<label class="md-control-label"></label>
						</div>
						<div class="md-form-group">
				  		<input class="md-form-control" type="text" name="tech" id="tech" placeholder="Tehnologija na Realiziranje">
				  		<label class="md-control-label"></label>
						</div>
						<div class="md-form-group">
				  		<input class="md-form-control" type="text" name="link_tech" id="link_tech" placeholder="Video Link za Tehnika (youtube)">
				  		<label class="md-control-label"></label>
						</div>
						<div class="md-form-group">
				  		<input class="md-form-control" type="text" name="description" id="description" placeholder="Description">
				  		<label class="md-control-label"></label>
						</div>
						<button class="btn btn-default btn-block" type="submit">Add Training</button>
			  	</div>
				</div>
		  </div>
		</form>
	</div>
</section>