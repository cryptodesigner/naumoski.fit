<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Uploaded Images</span>
			</h1>
	  </div>
	  <?php
	  	$d = '/uploads/';
foreach(glob($d.'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE) as $file){
    $imag[] =  basename($file);
}
	  ?>
	</div>
</section>