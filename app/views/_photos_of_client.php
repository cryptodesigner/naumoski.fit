<?php
	$user_id = $_GET['client_id'];
?>

<style>
	<?php include 'static/css/gallery.css'; ?>
</style>

<section>
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Uploaded Images</span>
			</h1>
	  </div>

	  <div class="wrap">
	  	<div class="gallery">
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
    				echo '<img src="' . IMAGEPATH . $directoryfile . '" height="300" width="auto" alt="' . $directoryfile . '" /> ';
    			}
    		}
			}

			closedir($handle); 
		?>
	  	</div>
	  </div>
	  

	</div>
</section>


<script>
	"use strict";

	class Gallery{

	constructor(settings) {
		// Slider Options
		let defaults = {
			next_by_click_img: true,
			speed: 400,
			play: true,
			auto_play_speed: 2000,
			button_play: 'fa fa-play-circle',
			button_stop: 'fa fa-stop-circle',
			button_next: 'fa fa-chevron-circle-right',
			button_prev: 'fa fa-chevron-circle-left',
			button_close: 'fa fa-times-circle',
		}

		this.options = $.extend(defaults, settings);


		// Adding PopUp HtmlContent
		$('body').append('<div id="overlay" class="overlay"><div class="popup" id="popupBody"></div></div>');
		this.overlay = $('.overlay');
		this.popup = $('.popup');

		// Variable for preventing multiple clicking
		this.isRun = false;
	}

	open(content, image) {
		// Open overlay
		this.overlay.addClass('open');

		// Creating buttons
		this.popup.append('<span id="close"><i></i></span><span id="next"><i></i></span><span id="prev"><i></i></span>');
		if(this.options.play === true) {
			this.popup.append('<div class="play_wrap"><span id="play"><i></i></span><span id="stop"><i></i></span></div>');
		}
		this.closeButton = $('#close');
		this.nextButton = $('#next');
		this.prevButton = $('#prev');
		this.playButton = $('#play');
		this.stopButton = $('#stop');

		// Adding content
		this.content = $(content).clone();
		this.popup.append(this.content);
		this.index = $(image).index();

		// Running functions
		this.slider();
		this.close();
		this.styles();
		this.autoplay();


		return this;
	}

	close(){
		this.closeButton.on('click', (e) => {
			this.overlay.removeClass('open');
			$('.popup').empty();
		});
	}

	slider(){
		// Show the clicked img & adjusting sizes of popUp Window
		this.content.eq(this.index).css('opacity', 1).css('display', 'block');

		// Click on function buttons of the slider
		this.nextButton.on('click', (e) => { this.next()});
		this.prevButton.on('click', (e) => { this.prev()});

		$(document).keydown((e) => {
			if(e.which == 39) {
				this.next();
			}
			if(e.which == 37) {
				this.prev();
			}
		});

		if(this.options.next_by_click_img !== false){
			this.content.on('click', (e) => { this.next()});
			this.content.css('cursor', 'pointer');
		}

	}

	next(){
		if(this.isRun) {
			return;
		}

		this.isRun = true;


		this.content.eq(this.index).animate({
			'opacity': 0
		}, this.options.speed);

		this.content.eq(this.index).css('display', 'none');


		this.index++;
		if(this.index > this.content.length - 1){
			this.index = 0;
		}

		this.content.eq(this.index).css('display', 'block');
		
		this.content.eq(this.index).animate({
				'opacity': 1
			}, this.options.speed, () => {
				this.isRun = false;
			});
	}

	prev(){
		if(this.isRun) {
			return;
		}

		this.isRun = true;

		this.content.eq(this.index).animate({
			'opacity': 0
		}, this.options.speed);

		this.content.eq(this.index).css('display', 'none');
		
		this.index--;
		if(this.index < 0){
			this.index = this.content.length - 1;
		}

		this.content.eq(this.index).css('display', 'block');
		
		this.content.eq(this.index).animate({
			'opacity': 1
		}, this.options.speed, () => {
			this.isRun = false;
		});
	}


	styles(){
		this.playButton.addClass(this.options.button_play);
		this.stopButton.addClass(this.options.button_stop);
		$('.popup span#next i').addClass(this.options.button_next);
		$('.popup span#prev i').addClass(this.options.button_prev);
		$('.popup span#close i').addClass(this.options.button_close);
	}


	autoplay(){
		this.playButtonOn = false;

		this.playButton.on('click', (e) => {
			this.playButtonOn = setInterval(() => {
				this.next();
			},this.options.auto_play_speed);
			this.playButton.hide();
			this.stopButton.show();

		});

		this.stopButton.on('click', () => {
			clearInterval(this.playButtonOn);
			this.playButtonOn = false;
			this.playButton.show();
			this.stopButton.hide();
		});


	}

}


/* ***** */
/* USE GALLERY CLASS */
/* ***** */

$(function () {
	let popup = new Gallery({
		next_by_click_img: true,
		speed: 400,
		auto_play_speed: 2000
	});

	$('.gallery img').on('click', function(e){
		popup.open('.gallery img', this);
	});

});
</script>