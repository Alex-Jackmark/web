 <?php
 /**
    Template Name: Contact Template
   */
 ?>
 <?php get_header(); ?>

<div class="container-fluid" id="contact-content-wrapper">

	<div id="contact-wrapper" class="row">
	
				
		<div id="contact-side-content" class="col-md-3 col-xs-12">
			<div id="contact-info">
				<p class="contact-text"><b><u>Jackmark Engineering Ltd.</u></b></p>
				<p class="contact-text">
					<p>Scott Lidgett Road,</p>
					<p>Longport,</p>
					<p>Stoke-on-Trent,</p>
					<p>Staffordshire,</p>
					<p>ST6 4NQ</p>
					<br>
					<p><u><?php _e('Tel:', 'integral-child'); ?></u> 0044 (0)1782 825555</p>
					<p><u><?php _e('Tel:', 'integral-child'); ?></u> 0044 (0)1782 834647</p>
					<p><u><?php _e('Fax:', 'integral-child'); ?></u> 0044 (0)1782 834169</p>
					<br>
					<p><u><?php _e('E-mail:', 'integral-child'); ?></u> enquiries@jackmark.com</p>
				</p>
			</div>
			<div id="open-hours">
					<p class="contact-text"><b><u><?php _e('Open Hours:', 'integral-child'); ?></u></b></p>
					<p class="contact-text">
						<p><?php _e('Mon-Thur: 08:00 - 17:00', 'integral-child'); ?></p>
						<p><?php _e('Friday: 08:00 - 13:00', 'integral-child'); ?></p>
						<p><?php _e('Sat + Sun: Closed', 'integral-child'); ?></p>
					</p>
			</div>
		</div>

		<div id="contact-main-content" class="col-md-9 col-xs-12">
			<div id="gmaps-container">
				<div id="gmaps">
					<?php echo do_shortcode('[wpgmza id="1"]'); ?>
				</div>
			</div>
			<div id="contact-form-container">
				<div id="contact-form">
					<h4><?php _e('Contact/Enquiries:', 'integral-child'); ?></h4>
					<br>
					<?php echo do_shortcode('[cscf-contact-form]'); ?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>
