 <?php
 /**
    Template Name: Showcase Template
   */
 ?>
 <?php get_header(); ?>
 
<div class="spacer"></div>

<div class="container content" id="showcase-content-wrapper">

	<div class="row">
		<div id="vidContainer1" class="vid-container col-md-6 col-xs-12">
			<video id="halftileTest" class="embed-responsive" autoplay loop preload="auto" poster="/wp-content/uploads/2017/08/half-tile-placeholder.png" height="auto" width="auto" onClick="playPause(this);">
				<source src="/wp-content/uploads/2017/08/Half-Tile-Handbrake.mp4"></source>
				<source src="/wp-content/uploads/2017/08/Half-Tile-Handbrake.webm"></source>
				<source src="/wp-content/uploads/2017/07/halftileTest.ogv"></source>
				Sorry! This video has issues loading in this browser. Please try an updated version or another broswer to view this video.
			</video>
		</div>
		<div id="vidText1" class="vid-text col-md-6 col-xs-12">
			<div id="textWrapper1" class="text-wrapper">
				<p class="text-title"><?php _e('Rotary Test Connectors', 'integral-child'); ?></p>
				<p class="text-content"><i><?php _e('How to test terminal locations reliably and cheaply.', 'integral-child'); ?></i></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="vidContainer2" class="vid-container col-md-6 col-xs-12 col-md-push-6">
			<video autoplay loop preload="auto" class="embed-responsive" poster="/wp-content/uploads/2017/08/ECU-flash-station-placeholder.png" onClick="playPause(this);">
				<source src="/wp-content/uploads/2017/08/Ecu-flash-station-handbrake.mp4"></source>
				<source src="/wp-content/uploads/2017/08/Ecu-flash-station-handbrake.webm"></source>
				<source src="/wp-content/uploads/2017/07/ECU-Flash-Station.ogv"></source>
				Sorry! This video has issues loading in this browser. Please try an updated version or another broswer to view this video.
			</video>
		</div>
	
		<div id="vidText2" class="vid-text col-md-6 col-xs-12 col-md-pull-6">
			<div id="textWrapper2" class="text-wrapper">	
				<p class="text-title"><?php _e('ECU Programming Station Interfaces', 'integral-child'); ?></p>
				<p class="text-content"><i><?php _e('How to make 180 simultaneous connections reliably 100,000s of times.', 'integral-child'); ?></i></p>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div id="vidContainer3" class="vid-container col-md-6 col-xs-12">
			<video autoplay loop preload="auto" class="embed-responsive" poster="/wp-content/uploads/2017/08/fuel-rail-placeholder.png" onClick="playPause(this);">
				<source src="/wp-content/uploads/2017/08/Fuel-rail-handbrake.mp4"></source>
				<source src="/wp-content/uploads/2017/08/Fuel-rail-handbrake.webm"></source>
				<source src="/wp-content/uploads/2017/07/Fuel-Rail.ogv"></source>
				Sorry! This video has issues loading in this browser. Please try an updated version or another broswer to view this video.
			</video>
		</div>
		<div id="vidText3" class="vid-text col-md-6 col-xs-12">
			<div id="textWrapper3" class="text-wrapper">	
				<p class="text-title"><?php _e('Pneumatic Test Tiles', 'integral-child'); ?></p>
				<p class="text-content"><i><?php _e('How to connect to an engine sensor that can be in any orientation with no space to move!', 'integral-child'); ?></i></p>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
