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

	<footer id="footer"<?php if ( ! is_front_page() ) { echo ' class="inner"'; } ?>>
		<div class="wrapper">

		<?php if ( ! ( is_front_page() || function_exists( 'edd_is_checkout' ) && edd_is_checkout() ) ) : ?>

		<section class="section columns columns-4">
			<div class="wrapper clear">
				
				<div class="col">
				<h3>Site Links</h3>
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
					<h3>Other Useful Links</h3>
					<nav class="site-navigation primary-navigation" role="navigation">
										
						<?php
							wp_nav_menu(
							  array(
							    'menu' 				=> 'main_nav',
							    'menu_class' 		=> 'menu',
							    'theme_location' 	=> 'useful_links',
							    'container' 		=> '',
							    'container_id' 		=> '',
							    'depth' 			=> '1',
							  )
							);
						?>
						</nav>
					
				</div>
				
				<div class="col">
					<h3>Recommended Products</h3>
					<ul>
						<li><a href="<?php echo site_url( 'products/affiliatewp' ); ?>">AffiliateWP</a></li>
						<li><a href="<?php echo site_url( 'products/easy-digital-downloads' ); ?>">Easy Digital Downloads</a></li>
						<li><a href="<?php echo site_url( 'products/restrict-content-pro' ); ?>">Restrict Content Pro</a></li>
					</ul>

					
				</div>
				
				
				
				
				


				<div class="col last">
					<div class="wrap">
					
						<h3>Weekly Newsletter</h3>
						
						<?php 
							if ( function_exists( 'gravity_form' ) ) {
								gravity_form( 'Weekly Newsletter', false, false, false, '', true );
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