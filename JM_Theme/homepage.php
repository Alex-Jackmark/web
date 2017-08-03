<?php
/**
 * Template Name: Custom Homepage
 *
 */
?>

<?php get_header(); ?>

<div class="container-fluid" id="home-content-wrapper">
	<div class="row">
		<div class="col-md-12" id="home-content">
			<div id="shade">
				<?php
					//echo '<img class="" src="' . wp_get_attachment_url(8) . '" alt= ///BRIEF DESCRIPTION OF IMG///"/>';
					# INCLUDE BOOTSTRAP TEXT/DIV OVERLAY AND CENTER OVER IMAGE.
				?>
				<div id="intro">
					<p>Jackmark Engineering (incorporating Jackmark International) is a pioneer in the design field of electrical automotive test interface design and manufacture.</p>
					<p>Founded in 1979 to meet the needs of the UK automotive industry Jackmark has grown into a global supplier to the global automotive industry.</p>
					<a class="btn btn-danger" href="/products">VIEW PRODUCTS</a> 
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
