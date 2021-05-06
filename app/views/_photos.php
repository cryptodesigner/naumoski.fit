<?php
	$user_id = $_SESSION["client_id"];
?>

<style>
	<?php include 'static/css/gallery.css'; ?>
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Uploaded Images</span>
			</h1>
	  </div>

	  <div class="gallery">
  	<div class="img-w">
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
		</div>

	</div>
</section>


<div class="gallery">
  <div class="img-w">
    <img src="https://images.unsplash.com/photo-1485766410122-1b403edb53db?dpr=1&auto=format&fit=crop&w=1500&h=846&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485793997698-baba81bf21ab?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485871800663-71856dc09ec4?dpr=1&auto=format&fit=crop&w=1500&h=2250&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485871882310-4ecdab8a6f94?dpr=1&auto=format&fit=crop&w=1500&h=2250&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485872304698-0537e003288d?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485872325464-50f17b82075a?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1470171119584-533105644520?dpr=1&auto=format&fit=crop&w=1500&h=886&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485881787686-9314a2bc8f9b?dpr=1&auto=format&fit=crop&w=1500&h=969&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
  <div class="img-w">
  	<img src="https://images.unsplash.com/photo-1485889397316-8393dd065127?dpr=1&auto=format&fit=crop&w=1500&h=843&q=80&cs=tinysrgb&crop=" alt="" />
  </div>
</div>




<script>
	$(function() {
  $(".img-w").each(function() {
    $(this).wrap("<div class='img-c'></div>")
    let imgSrc = $(this).find("img").attr("src");
     $(this).css('background-image', 'url(' + imgSrc + ')');
  })
            
  
  $(".img-c").click(function() {
    let w = $(this).outerWidth()
    let h = $(this).outerHeight()
    let x = $(this).offset().left
    let y = $(this).offset().top
    
    
    $(".active").not($(this)).remove()
    let copy = $(this).clone();
    copy.insertAfter($(this)).height(h).width(w).delay(500).addClass("active")
    $(".active").css('top', y - 8);
    $(".active").css('left', x - 8);
    
      setTimeout(function() {
    copy.addClass("positioned")
  }, 0)
    
  })
})

$(document).on("click", ".img-c.active", function() {
  let copy = $(this)
  copy.removeClass("positioned active").addClass("postactive")
  setTimeout(function() {
    copy.remove();
  }, 500)
})
</script>