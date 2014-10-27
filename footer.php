<?php
/**
 * The template for displaying the footer
 */
?>

<?php /*
</div> <!-- .wrapper -->
*/ ?>

<?php do_action( 'affwp_content_end' ); ?>
</div> <!-- #content -->
<?php do_action( 'affwp_content_after' ); ?>

	<footer id="footer">
		<div class="wrapper">

		<?php if ( ! ( is_front_page() || function_exists( 'edd_is_checkout' ) && edd_is_checkout() ) ) : ?>

		<section class="section columns columns-4">
			<div class="wrapper">
				
				<div class="col">
				<h3>Links</h3>
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

				
				
				<div class="col">
					<h3>Products</h3>
					<ul>
						<li><a href="#">AffiliateWP</a></li>
					</ul>

					
				</div>
				
				
				<div class="col">
					<h3>Useful Links</h3>
					<ul>
						<li><a href="#">Pippin's Wood Shop</a></li>
					</ul>
					
				</div>
				
				


				<div class="col last">
					<div class="wrap">
					
						<h3>Weekly Newsletter</h3>
						
						<?php 
							if ( function_exists( 'gravity_form' ) ) {
								gravity_form( 6, false, false, false, '', true );
							}
						?>
					

					</div>

				</div>
				

			</div>
		</section>

		<?php endif; ?>
		
		<section class="section copyright">
			<div class="wrapper">
				Copyright &copy; <?php echo date('Y') . ', ' . get_bloginfo('name'); ?>
			</div>
		</section>

		</div>
	</footer>
</div>	

<?php wp_footer(); ?>

</body>
</html>