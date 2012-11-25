<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Light
 * @since Light 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<div id="main" class="clearfix">
		<div class="section">
		
		<header id="masthead" class="site-header" role="banner">
			<hgroup>
				<h1 class="site-title clearfix"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if ( of_get_option('logo', false) ) { ?>
					<img src="<?php echo of_get_option('logo'); ?>" alt="<?php echo bloginfo( 'name' ) ?>" />
				<?php } else {
					bloginfo( 'name' );
				}?>
				</a></h1>
				<?php if ( of_get_option('tagline', false) ) { ?>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php } ?>
				<a href="#" class="icon menu-toggle"></a>
			</hgroup>
	
			<nav role="navigation" class="site-navigation main-navigation clearfix">
				<h3 class="assistive-text"><?php _e( 'Menu', 'light' ); ?></h3>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'light' ); ?>"><?php _e( 'Skip to content', 'light' ); ?></a></div>
	
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->
		</header><!-- #masthead .site-header -->