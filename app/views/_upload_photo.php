<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Прикачете Фотографија</span>
			</h1>

			<span><a style="color: white;" href="upload_photo.php">MK</a> <span style="color: white;">|</span> <a style="color: white;" href="upload_photo_en.php">EN</a></span>

	  </div>
	  <form data-toggle="md-validator" action="upload_photo.php" method="POST" enctype="multipart/form-data">
			<div class="row">
		  	<div class="col-sm-6 col-sm-offset-3">
					<div class="form-group">
			  		<label class="col-sm-3 control-label" for="form-control-9">Одбери Фотографија</label>
			  		<div class="col-sm-9">
							<input id="form-control-9" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" multiple="multiple">
							<p class="help-block">
				  			<small>Дозволени Екстензии: png, jpg, jpeg.</small>
							</p>
			  		</div>
					</div>
					<button class="btn btn-default btn-block" type="submit" value="Upload Image" name="submit">Прикачи</button>
		  	</div>
			</div>
	  </form>
	</div>
</section>