<?php
/**
 * The Sidebar for the about page template
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<aside class="widget">
		<a href="http://pippinsplugins.dev/products/easy-digital-downloads/" class="post-thumbnail" title="Easy Digital Downloads">
			<img alt="edd" src="http://pippinsplugins.dev/wp-content/uploads/edd/2014/09/edd-480x240.png">
		</a>

		<h2>Founder of Easy Digital Downloads</h2>

		<p>Easy Digital Downloads is a WordPress e-commerce plugin that focuses purely on digital products.</p>
		<p>Its primary goal is to make selling digital products simple and complete.</p>

		<a href="http://easydigitaldownloads.com" target="_blank">View Easy Digital Downloads &rarr;</a>
	</aside>

	<aside class="widget">


		<img class="post-thumbnail" src="<?php echo get_stylesheet_directory_uri() . '/images/about-public-speaker.jpg'; ?>" />

		<h2>Public Speaker</h2>

		<p>I travel around the United States to give presentations at WordCamps and similar events about WordPress plugin development.</p>
		
	</aside>

	<?php dynamic_sidebar( 'sidebar-about' ); ?>

</div>