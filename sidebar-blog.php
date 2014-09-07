<?php
/**
 * The Sidebar for single blog posts
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<?php echo pp_blog_post_info(); ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div>