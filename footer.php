<?php
/**
 * The template for displaying the footer
 */
?>

</div> <!-- .wrapper -->
<?php do_action( 'affwp_content_end' ); ?>
</div> <!-- #content -->
<?php do_action( 'affwp_content_after' ); ?>

	<footer id="footer">
		<div class="wrapper">

		<?php if ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) : ?>

		<section class="section columns columns-4">

			<div class="col">
				<nav class="site-navigation primary-navigation" role="navigation">
				
				<?php
					wp_nav_menu(
					  array(
					    'menu' 				=> 'main_nav',
					    'menu_class' 		=> 'menu',
					    'theme_location' 	=> 'footer',
					    'container' 		=> '',
					    'container_id' 		=> '',
					    'depth' 			=> '1',
					  )
					);
				?>
				</nav>
			</div>

			
			<?php /*
			<div class="col">
				<h3>Follow Me</h3>
				<p>There will be some social links here as per old site</p>

				
			</div>
			
			<div class="col">
				
			</div>
				
			
			<div class="col">
				

				
			</div>
			
			


			<div class="col last">
				<div class="wrap">
				<?php if ( ! is_home() ) : ?>
					<h3>Stay up to date</h3>
					<p>There will be an email newsletter signup here as per old site</p>
					<?php 
						if ( function_exists( 'gravity_form' ) ) {
							gravity_form( 1, false, false, false, '', true );
						}
					?>
				<?php endif; ?>

				</div>

			</div>
			*/ ?>


		</section>

		<?php endif; ?>
		
		<section class="section copyright">
			<div class="wrapper">
				Copyright &copy; <?php echo date('Y') . ', ' . get_bloginfo('name'); ?>
			</div>
		</section>

		</div>
	</footer>
</div> <!-- #site -->	

<?php wp_footer(); ?>

</body>
</html>