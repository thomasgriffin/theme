<?php

get_header(); ?>



<?php
/**
 * Join the site
 */
?>
<section class="section home pricing columns columns-3 grid row">

	<header class="page-header">
		<h1>Join the site</h1>
		<h2>Gain access to an ever-growing vault of information.</h2>
	</header>


	<div class="wrapper pricing-options">

		
		<a href="<?php echo site_url( 'join-the-site/register/?level=1' ); ?>" class="col box pricing">

			
			<h2>Hobby Coder</h2>

			<p>You like to code with WordPress in your spare time</p>

			<ul class="list">
				<li class="price"><sup>$</sup>6</li>
				<li class="length">1 Month</li>
			</ul>	

			<span class="button">Join now</span>
		</a>

		<a href="<?php echo site_url( 'join-the-site/register/?level=3' ); ?>" class="col box pricing">

			<h2>Code Monkey</h2>

			<p>You spend so much time coding you start thinking in IF / ELSE statements</p>

			<ul class="list">
				<li class="price"><sup>$</sup>60</li>
				<li class="length">1 Year</li>
			</ul>	

			<span class="button">Join now</span>
		</a>

		<a href="<?php echo site_url( 'join-the-site/register/?level=2' ); ?>" class="col box pricing">

			
			<h2>Coder By Night</h2>

			<p>You stay up late drinking coffee and playing around with WordPress</p>

			<ul class="list">
				<li class="price"><sup>$</sup>16</li>
				<li class="length">3 Months</li>
			</ul>	

			<span class="button">Join now</span>
		</a>


	</div>
	<div class="align-center best-value">
		<svg width="184px" height="69px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-best-value'; ?>"></use>
		</svg>
	</div>

	<div class="refund-policy">
		<svg width="100px" height="91px" class="pulse animated infinite">
			   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-heart'; ?>"></use>
			</svg>
		<h2>30 Day Money Back Guarantee</h2>
		<p>If you are unhappy with your purchase, or you have an issue that we are unable to resolve that makes the system unusable, we are more than happy to provide a complete refund within 30 days of your original purchase.</p>
		<p><a href="#refund-policy" class="popup-content" data-effect="mfp-move-from-bottom">View refund policy</a></p>

		<?php 
		$refund_policy = get_page_by_title( 'refund policy' );
		?>
		<div id="refund-policy" class="popup entry-content mfp-with-anim mfp-hide">
			<h1>
				<?php echo $refund_policy->post_title; ?>
			</h1>

			<?php echo stripslashes( wpautop( $refund_policy->post_content, true ) ); ?>
		</div>

	</div>

		
	
		
	

	
</section>


<?php
/**
 * Stats
 */
?>
<section class="section home alt3">
	<div class="wrapper">

		<ul class="site-stats">
			<li>
				
					<span class="total"><?php echo pp_get_category_post_count( 'free-members' ); ?></span> Free tutorials
				
			</li>
			<li>
				
					<span class="total"><?php echo pp_get_category_post_count( 'subscriber-only' ); ?></span> Premium tutorials
				
			</li>
			
			<li>
				
					<span class="total"><?php echo pp_get_download_count(); ?></span> Products
				
			</li>
			<li>
				
					<span class="total"><?php echo pp_get_post_count(); ?></span> Blog Posts
			
			</li>
		</ul>

		<?php /*
		<ul class="site-stats">
			<li>
				<a href="<?php echo site_url('category/member-restricted/free-members/'); ?>">
					<span class="total"><?php echo pp_get_category_post_count( 'free-members' ); ?></span> Free tutorials
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('category/member-restricted/subscriber-only/'); ?>">
					<span class="total"><?php echo pp_get_category_post_count( 'subscriber-only' ); ?></span> Premium tutorials
				</a>
			</li>
			
			<li>
				<a href="<?php echo site_url('/products'); ?>">
					<span class="total"><?php echo pp_get_download_count(); ?></span> Products
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('/blog'); ?>">
					<span class="total"><?php echo pp_get_post_count(); ?></span> Blog Posts
				</a>
			</li>
		</ul>
		*/ ?>
	</div>
</section>


<?php
/**
 * Latest premium tutorials
 */
?>
<section class="section home columns columns-3 grid row">
	
	<header class="page-header">
		<h1>Start learning today</h1>
		<h2>Get a head start with my premium tutorials on WordPress Plugin Development</h2>
	</header>

	<div class="wrapper">
		<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
				'tax_query' =>  array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( 'subscriber-only' )
					)
				)
			);

		    $tutorials = new WP_Query( $args );
		?>
		<?php if ( $tutorials->have_posts() ) : ?> 

		        <?php while ( $tutorials->have_posts() ) : $tutorials->the_post(); ?>  
		              <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
		            	
		            	<div class="flex-wrapper">
			            	<?php pp_post_thumbnail( 'pp-grid-thumbnail' ); ?>
			            	<span class="date">
							<?php echo esc_html( get_the_date( 'M d' ) ); ?>
							</span>

			                <h2 class="entry-title">
			                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			                        <?php the_title(); ?>
			                    </a>
			                </h2>
			            	
			            <?php the_excerpt(); ?>

		            	</div>
		            <a href="<?php the_permalink(); ?>">View tutorial &rarr;</a>
		        </article> 

		        <?php endwhile; wp_reset_query(); ?>
   
		<?php endif; ?>
	</div>

	
	<div class="action">
		<a href="<?php echo site_url( 'category/member-restricted/subscriber-only' ); ?>" class="button huge">Start Learning</a>
	</div>
	
</section>


<?php
/**
 * Featured product
 */
?>
<section class="section home featured-product alt3">

	<div class="wrapper">
		
		<header class="page-header">
			<span class="meta">Featured Product</span>
			<h1>AffiliateWP</h1>
			<h2>An efficient and reliable affiliate marketing plugin for WordPress</h2>
			<a href="<?php echo site_url('products/affiliatewp'); ?>" class="button">Learn more</a>
		</header>

		<div class="image">
			<img src="<?php echo get_stylesheet_directory_uri() . '/images/home-feature.png'; ?>" alt="">
			<div id="alf"></div>
		</div>	
	</div>
</section>




<?php if ( have_posts() ) : ?>

<section class="section home columns columns-3 grid row">

	<header class="page-header">
		<h1>Latest Articles</h1>
	</header>

	<div class="wrapper">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
		    <div class="flex-wrapper">
			<?php pp_post_thumbnail( 'pp-grid-thumbnail' ); ?>
				
				<span class="date">
				<?php echo esc_html( get_the_date( 'M d' ) ); ?>
				</span>

				<h2 class="entry-title">
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			    		<?php the_title(); ?>
			    	</a>
		    	</h2>	
				

			

	       	<?php the_excerpt(); ?>
		 	</div>
		 		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">
 		    		Read Now  &rarr;
 		    	</a>

		 	
		</article>

	<?php endwhile; ?>

	<div class="gap"></div>
	<div class="gap"></div>

	</div>

	<?php /*
	<div class="action">
		<a href="<?php echo site_url('blog'); ?>" class="button">View more articles</a>
	</div>
	*/ ?>



</section>
<?php endif; ?>


<?php
/**
 * Latest free tutorials
 */
?>
<section class="section home columns columns-3 grid row">

	<header class="page-header">
		<h1>Latest Free Tutorials</h1>
		<h2>Free tutorials on WordPress plugin development, who can argue with that?</h2>
	</header>
	
	<div class="wrapper">
		<?php
		    $args = array(
		      'post_type' => 'post',
		      'posts_per_page' => 3,
		      'tax_query' =>  array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( 'tutorials' )
					),
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( 'subscriber-only' ),
						'operator' => 'NOT IN'
					)
				)
		    );

		    $tutorials = new WP_Query( $args );
		?>
		<?php if ( $tutorials->have_posts() ) : ?> 
		        <?php while ( $tutorials->have_posts() ) : $tutorials->the_post(); ?>  
		              <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
		            	
		            	<div class="flex-wrapper">
		            		<?php pp_post_thumbnail( 'pp-grid-thumbnail' ); ?>
			            	<?php //pp_post_thumbnail( 'pp-grid-thumbnail' ); ?>
			            	<span class="date">
							<?php echo esc_html( get_the_date( 'M d' ) ); ?>
							</span>
			                <h2 class="entry-title">
			                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
			                        <?php the_title(); ?>
			                    </a>
			                </h2>
			            	

			            	<?php the_excerpt(); ?>
		            	</div>

		            	<a href="<?php the_permalink(); ?>">View tutorial &rarr;</a>
		        </article> 

		        <?php endwhile; wp_reset_query(); ?>
		        <div class="gap"></div>
		        <div class="gap"></div>
 
		<?php endif; ?>
	</div>

	<?php /*
	<div class="action">
		<a href="<?php echo site_url('/category/member-restricted/free-members/'); ?>" class="button">Start learning, for free</a>
	</div>
	*/ ?>

</section>


<section class="section home newsletter">
	<div class="wrapper">
		
	<header class="page-header">
		<h1>Weekly Newsletter</h1>
		<h2>Never miss out on new tutorials, products or reviews. No spam, I promise.</h2>
	</header>
		<?php 
			if ( function_exists( 'gravity_form' ) ) {
				gravity_form( 'Weekly Newsletter - Home', false, false, false, '', true );
			}
		?>
		<!-- <p>Subscribe to my weekly newsletter above and </p> -->
	</div>
</section>

<?php get_footer(); ?>