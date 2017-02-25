<?php 
/**
	*		Template para mostrar las secciones corporativas.
	* 
	* Template Name: Corporative
	* @package WordPress
	* @subpackage annysuper
	* 
	*/
 ?>


<?php get_header(); ?>

<div class="corporative row">
	<div id="corporative-sidebar" class="col-md-3">
		<?php get_sidebar('left'); ?>
	</div>
	<div class="content-corp col-md-9">
	<div class="top-title">
		<h4 class="title-corp">
			Acerca de Supermercado Anny
		</h4>
	</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->	
	</div>
</div>



<?php get_footer(); ?>