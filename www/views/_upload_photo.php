<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Upload Images</span>
			</h1>
	  </div>
	  <form data-toggle="md-validator" action="upload_photo.php" method="POST" enctype="multipart/form-data">
			<div class="row">
		  	<div class="col-sm-6 col-sm-offset-3">
					<div class="form-group">
			  		<label class="col-sm-3 control-label" for="form-control-9">File input</label>
			  		<div class="col-sm-9">
							<input id="form-control-9" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" multiple="multiple">
							<p class="help-block">
				  			<small>Allowed types: png, jpg, jpeg.</small>
							</p>
			  		</div>
					</div>
					<button class="btn btn-default btn-block" type="submit" value="Upload Image" name="submit">Upload</button>
		  	</div>
			</div>
	  </form>
	</div>
</section>