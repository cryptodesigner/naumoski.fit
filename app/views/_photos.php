<?php
	$user_id = $_SESSION["client_id"];
?>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Uploaded Images</span>
			</h1>
	  </div>
	  <?php

	  	function str_starts_with ( $haystack, $needle ) {
  			return strpos( $haystack , $needle ) === 0;
  		}

			define('IMAGEPATH', 'uploads/');

			if (is_dir(IMAGEPATH)){
    		$handle = opendir(IMAGEPATH);
			}
			else{
    		echo 'No image directory';
			}

			$directoryfiles = array();
			while (($file = readdir($handle)) !== false) {
    		$newfile = str_replace(' ', '_', $file);
    		// rename(IMAGEPATH . $file, IMAGEPATH . $newfile);
    		$directoryfiles[] = $newfile;
			}

			// echo "$user_id";

			foreach($directoryfiles as $directoryfile){
    		if(strlen($directoryfile) > 3){
    			if(str_starts_with($directoryfile, $user_id)){
    				echo '<img src="' . IMAGEPATH . $directoryfile . '" alt="' . $directoryfile . '" /> ';
    			}
    		}
			}

			closedir($handle); 
		?>
	</div>
</section>