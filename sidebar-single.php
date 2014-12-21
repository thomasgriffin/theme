<?php
/**
 * The Sidebar for single blog posts
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<?php echo pp_single_post_type_info(); ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div>