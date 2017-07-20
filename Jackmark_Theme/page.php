<?php // Default Template for Jackmark Theme ?>

<?php get_header(); ?>

<div class="container-fluid content">
	<div class="row">
		<div class="col-md-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			     <h2 class="entry-title"><?php the_title(); ?></h2>
			    
			     <div class="entry">

			       <?php the_content(); ?>

			     </div>

			     
			 </div>
			
			 <?php endwhile;?>

			 <?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>

