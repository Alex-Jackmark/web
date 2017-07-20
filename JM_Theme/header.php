<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        
		<?php
			if ( ! function_exists( '_wp_render_title_tag' ) ) {
				function theme_slug_render_title() {
		?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
				}
				add_action( 'wp_head', 'theme_slug_render_title' );
			}
		?>
		
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
	
	<body <?php body_class(); ?>>
	
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="row">
					<div class="navbar-header col-xs-12 col-md-2">
						<div class="container-fluid">
							<div class="row">
								<div id="navbar-toggle-wrapper" class="col-xs-4">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-menu-container">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
				
								<?php echo '<h1 class="col-xs-4 col-md-12"><a class="navbar-brand" href="' . esc_url( home_url() ) . '">';
								echo '<img class="img-responsive" src="' . wp_get_attachment_url(9)  . '" alt="Jackmark Engineering Ltd."/>'; 
								echo '</a></h1>'; ?>
				
								<?php if ( has_nav_menu( 'language-switcher' ) ) : ?>

									<?php
										wp_nav_menu( array(
											'menu'              => 'language-switcher',
											'theme_location'    => 'language-switcher',
											'container'         => 'div',
											'container_class'   => 'col-xs-4',
											'container_id'      => 'language-switcher',
											'menu_class'        => 'nav navbar-nav',
											'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
											'walker'            => new WP_Bootstrap_Navwalker()
										));
									?>

								<?php endif; ?>
							</div>
						</div>
					</div>
					<div id="test-menu-wrapper" class="col-md-8">
				
						<?php if ( has_nav_menu( 'primary' ) ) : ?>

								<?php
									wp_nav_menu( array(
										'menu'              => 'primary',
										'theme_location'    => 'primary',
										'container'         => 'div',
										'container_class'   => 'collapse navbar-collapse col-md-8',
										'container_id'      => 'primary-menu-container',
										'menu_class'        => 'nav navbar-nav',
										'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
										'walker'            => new WP_Bootstrap_Navwalker()
									));
								?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</nav>
