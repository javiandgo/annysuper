<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AnnySuper
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php bloginfo('title'); ?> </title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'annysuper' ); ?></a>

<div class="top-bar">
	<div class="container">
		<div class="social-icons">
			<?php get_template_part( 'social', 'fa' ); ?> <small>servicioalcliente@supermercadoanny.com</small>
		</div>
		<div class="top-menu">
			<?php wp_nav_menu(array( 'theme_location' => 'top')); ?>
		</div>
	</div>
</div>

<header class="site-header" role="content-info">
	<div id="mainhead" class="container mainhead-container">
		<div class="branding">
			<?php if (get_theme_mod('annysuper_logo') != "") : ?>
			<div id="site-logo">
				<a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo esc_url(get_theme_mod('annysuper_logo'));?>" alt=""></a>
			</div>
			<?php endif; ?>
			<div id="text-title-desc">
				<h1 class="site-title title-font">
					<a href="<?php echo esc_url(home_url( '/' )); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<h2 class="site-description"><?php bloginfo('description') ?></h2>
			</div>
		</div>
		<?php if (class_exists('woocommerce')) : ?>
			<div class="top-cart">
				<div class="top-cart-icon">
					<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('Ver su carrito de compras', 'annysuper'); ?>">
						<div class="count"><?php echo sprintf(_n('%d Producto', '%d Productos', WC()->cart->cart_contents_count, 'annysuper'), WC()->cart->cart_contents_count); ?> </div>
						<div class="total"><?php echo WC()->cart->get_cart_total(); ?> 
						</div>
					</a>
					<i class="fa fa-shopping-cart"></i>
				</div>
			</div>
		<?php endif; ?>
		<div class="top-search">
			<?php get_template_part('searchform', 'top'); ?>
		</div>
	</div>			
	<div class="main-navigation">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-collapse">
						<span class="sr-only"><?php _e('Toggle navigation', 'bootstrap-basic'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				
				<div class="collapse navbar-collapse navbar-primary-collapse">
				<?php $walker = new BootstrapBasicMyWalkerNavMenu; ?>
					<?php wp_nav_menu(array('theme_location' => 'header', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new $walker)); ?> 

					<?php dynamic_sidebar('navbar-right'); ?> 
				</div><!--.navbar-collapse-->
			</nav>
		</div>
		</div><!--.main-navigation-->
</header>

	<?php get_template_part('template-parts/slider', 'swiper'); ?>

	<div class="top-div">
		<div class="container">
			<h1>Contenidos</h1>
		</div>
		<?php dynamic_sidebar('top-bar') ?>
	</div>

	<div id="content" class="site-content container">

