<?php
/**
 * The Sidebar containing the main widget area
 *
 * @since 1.0
 */

$affiliate_area_id = affiliate_wp()->settings->get( 'affiliates_page' );
?>

<div class="primary-sidebar widget-area col right" role="complementary">
	
	<?php 
	/**
	 * Post information
	 */
	echo pp_single_post_type_info( 'right' ); 

	?>

	<?php 
	/**
	 * Show the shopping cart
	 */
	
	$cart_items    = edd_get_cart_contents();
	$cart_quantity = edd_get_cart_quantity();
	$display       = $cart_quantity > 0 ? '' : 'style="display:none;"';
	
	if ( $cart_items ) : ?>
		<aside>
		<h2>Ready to purchase?</h2>
		<ul class="edd-cart">
			<?php foreach ( $cart_items as $key => $item ) : ?>
				<?php echo edd_get_cart_item_template( $key, $item, false ); ?>
			<?php endforeach; ?>

			<?php edd_get_template_part( 'widget', 'cart-checkout' ); ?>
		</ul>
		</aside>
	<?php endif; ?>

	<?php 
	/**
	 * Show a button for non logged in users to join the site
	 */
	if ( ! is_user_logged_in() ) : ?>
	<aside class="box">
		<h2>Join the site</h2>
		<p>Gain access to exclusive member-only plugins and tutorials.</p>
		<a href="<?php echo site_url( 'join-the-site' ); ?>" class="button wide">Join today</a>
	</aside>
	<?php endif; ?>


	<?php 
	/**
	 * User is logged in
	 * Show them the account box and latest member-only content
	 */
	if ( is_user_logged_in() ) : ?>	
		<aside class="box">

		<h2>
			<?php 

			$current_user = wp_get_current_user();
			$name         = $current_user->user_firstname ? $current_user->user_firstname : $current_user->display_name;

			printf( __( 'Hi %s', 'pp' ), $name ); ?>
		</h2>

			<ul class="linked list">
				<li<?php if ( is_page( 'account' ) ) { echo ' class="active"'; } ?>><a href="<?php echo site_url( 'account' ); ?>"><?php _e( 'Your Account', 'pp' ); ?></a></li>

				<?php if ( affwp_is_affiliate() ) : ?>
				<li<?php if ( is_page( $affiliate_area_id ) ) { echo ' class="active"'; } ?>><a href="<?php echo get_permalink( $affiliate_area_id ); ?>"><?php _e( 'Affiliate Dashboard', 'pp' ); ?></a></li>
				<?php endif; ?>

				<li><a href="<?php echo wp_logout_url( site_url( 'account' ) ); ?>"><?php _e( 'Logout', 'pp' ); ?></a></li>
			</ul>
		</aside>

		<?php
		/**
		 * Latest member-only content for logged-in users
		 */
		?>
		<aside class="box">
			<h2>Latest tutorials</h2>
			
			<?php
			    $args = array(
			      'posts_per_page' => 5,
			      'category_name' => 'subscriber-only'
			    );

			    $query = new WP_Query( $args );
			?>
			<?php if ( $query->have_posts() ) : ?> 
			   <ul class="linked list small">
			        <?php while ( $query->have_posts() ) : $query->the_post(); ?>  
			            <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
			                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			                        <?php the_title(); ?>
			                    </a>
			              </li>
			        <?php endwhile; wp_reset_query(); ?>

			     </ul>  
			<?php endif; ?>

			<a href="<?php echo get_category_link( get_cat_ID( 'Subscriber Only' ) ); ?>" class="button wide">View all</a>
		</aside>

	<?php endif; ?>

	<?php if ( is_page( 'learn' ) ) : ?>
		
		<aside class="box">
			<h2>What's your skill level?</h2>

			<div class="difficulty">
				<a href="<?php echo get_category_link( get_cat_ID( 'beginner' ) ); ?>" class="label beginner" title="These tutorials require a beginner skill level">Beginner</a>
				<a href="<?php echo get_category_link( get_cat_ID( 'intermediate' ) ); ?>" class="label intermediate" title="These tutorials require an intermediate skill level">Intermediate</a>
				<a href="<?php echo get_category_link( get_cat_ID( 'advanced' ) ); ?>" class="label advanced" title="These tutorials require an advanced skill level">Advanced</a>
			</div>
		</aside>

		<aside class="box">
			<h2>Tutorial Series</h2>

			<?php
			/**
			 * Series
			 */
			    $args = array(
			      'post_type' => 'series',
			      'posts_per_page' => -1,
			    );

			    $query = new WP_Query( $args );

			?>
			<?php if ( $query->have_posts() ) : ?> 
			   <ul class="linked list small">
			        <?php while ( $query->have_posts() ) : $query->the_post(); ?>  
			            <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
			            	
			               
			              
			                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			                        <?php the_title(); ?>
			                    </a>
			              </li>
			             
			            
			        <?php endwhile; wp_reset_query(); ?>
			     </ul>  
			<?php endif; ?>
		</aside>

	<?php endif; ?>

	<?php pp_banner_affwp(); ?>

	<?php pp_banner_edd(); ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
