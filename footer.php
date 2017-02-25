<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AnnySuper
 */

?>

	</div><!-- #content -->

	<footer class="footer" role="content-info">
 	<?php if ( is_active_sidebar('footer-one') || is_active_sidebar('footer-two') || is_active_sidebar('footer-three') || is_active_sidebar('footer-four') ) : ?>
		<div class="info">
			<div class="container">
				<?php 
					if (is_active_sidebar( 'footer-one' )) : ?>
						<div class="footer-col col-md-3 col-sm-6">
							<?php dynamic_sidebar('footer-one'); ?>
						</div>
					<?php endif;
					 
					if (is_active_sidebar('footer-two')) : ?>
						<div class="footer-col col-md-3 col-sm-6">
							<?php dynamic_sidebar('footer-two'); ?>
						</div>
					<?php endif;

					if (is_active_sidebar('footer-three')) : ?>
						<div class="footer-col col-md-3 col-sm-6">
							<?php dynamic_sidebar('footer-three'); ?>
						</div>
					<?php endif;

					if (is_active_sidebar('footer-four')) : ?>
						<div class="footer-col col-md-3 col-sm-6">
							<?php dynamic_sidebar('footer-four'); ?>
						</div>
				<?php endif; ?>

			</div>
		</div>
	<?php endif; ?>
		<div class="footer-info">
			<div class="container">
				<div class="copy col-md-6">
					Copyright &copy; 2016 Supermercado Anny &reg;. Designed by <a href="http://www.jangovc.com" rel="designer"><img style="opacity: 1" src="<?php echo get_template_directory_uri() . "/assets/images/log_jango.png" ?>" alt="JANGOVC"></a> 
				</div>
				<div class="footer-nav col-md-6">
					<?php wp_nav_menu(array( 'theme_location' => 'footer')); ?>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
