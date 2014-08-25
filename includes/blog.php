<?php



/**
 * Blog posts
 */
function affwp_blog() {


	// is_page_template( 'page-templates/blog.php' ) )
	// if ( 
	// 	edd_is_checkout() 									|| 
	// 	is_page_template( 'page-templates/pricing.php' ) 	||
	// 	is_page_template( 'page-templates/docs.php' )		||
	// 	is_tax( 'doc_category' )							||
	// 	is_singular( 'docs' )
	// )
	// 	return;

	

	global $post;
	
	// First, initialize how many posts to render per page
	$display_count = 4;

	// Next, get the current page
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	// After that, calculate the offset
	//$offset = ( $page - 1 ) * $display_count + 1;

	// Finally, we'll set the query arguments and instantiate WP_Query
	$args = array(
	  'post_type'  		=>  'post',
	  'orderby'    		=>  'date',
	  'order'      		=>  'desc',
	  'posts_per_page'	=>  $display_count,
	  'post__not_in' => array( get_the_ID() ), // hide the currently viewed post
	  'page'       		=>  $page,
	//  'offset'     		=>  $offset
	);

	$blog_query = new WP_Query( $args );

	// if ( $blog_query->found_posts <= 4 )
	// 	return;


?>

<?php if ( have_posts() ) : ?>

	

	<section class="section columns columns-4 related-posts">
	<header class="sub-header">
		<h2>We also recommend</h2>
	</header>

		<div class="wrapper">
		<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
			 <div class="col box">
			<?php
				global $more;
				$more = 0;
			?>
				<?php affwp_posted_on(); ?>
				<h2><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	        	
	        	<?php //affwp_post_thumbnail(); ?>
	        	
	        	<a title="<?php the_title_attribute(); ?>" class="post-thumbnail" href="<?php the_permalink(); ?>">
	        	<?php
	        		the_post_thumbnail();
	        	?>
	        	</a>

	        	<?php //if ( is_page_template( 'page-templates/blog.php' ) ) : ?>
	        	<?php  
			 		$excerpt = $post->post_excerpt ? the_excerpt() : '';
			 		echo $excerpt;
				?>	
				<?php //endif; ?>
			</div>

		<?php endwhile; ?>

			<div class="gap"></div>
		    <div class="gap"></div>

		</div>
	</section>

	
	
	<?php endif; 

	wp_reset_postdata();

}
//add_action( 'affwp_single_content_after', 'affwp_blog' );


/**
 * [affwp_blog_singular description]
 * @return [type] [description]
 */
function affwp_blog_singular() {

	if ( ! is_singular( 'post' ) )
		return;



	global $post, $wp_query;
	
	// First, initialize how many posts to render per page
	$display_count = 4;

	// Next, get the current page
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	// After that, calculate the offset
	$offset = ( $page - 1 ) * $display_count + 1;

	// Finally, we'll set the query arguments and instantiate WP_Query
	$args = array(
	  'post_type'  		=>  'post',
	  'orderby'    		=>  'date',
	  'order'      		=>  'desc',
	  'posts_per_page'	=>  $display_count,
	 	'post__not_in' => array( get_the_ID() ), // hide the currently viewed post
	  'page'       		=>  $page,
	//  'offset'     		=>  $offset
	);

	$temp = $wp_query; // assign orginal query to temp variable for later use  
	$wp_query = null;
	$wp_query = new WP_Query($args); 


?>

<?php if ( have_posts() ) : ?>

		<section class="section" id="docs">

		<div id="docs-container">
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			 <div class="col" data-myorder="">
			<?php
				global $more;
				$more = 0;
			?>
			
			<?php //get_template_part( 'content', get_post_format() ); ?>

				 <h2>
	            	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	        	</h2>

	        	 <?php 
			 		$excerpt = $post->post_excerpt ? the_excerpt() : '';
			 		echo $excerpt;
				?>	

			</div>

		<?php endwhile; ?>

			<div class="gap"></div>
		        <div class="gap"></div>

		       <!--  <p>
			 <a href="/blog">All posts</a>
			 </p> -->

	</div>
	</section>
	<?php endif; $wp_query = $temp; //reset back to original query ?>

	<?php
}
//add_action( 'affwp_single_content_after', 'affwp_blog_singular' );