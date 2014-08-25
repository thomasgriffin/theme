<?php
/**
 * Template Name: About
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<div class="primary content-area">
	<div class="wrapper">

		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

			endwhile;
		?>


		<section class="section columns columns-2 about">
		<div class="wrapper">
			
			<div class="col">

				<h1>Pippin Williamson</h1>
				<img class="profile" alt="Pippin Williamson" src="<?php echo get_stylesheet_directory_uri() . '/images/about-pippin.png'; ?>">
				<p>Pippin Williamson is an avid WordPress plugin developer from Hutchinson, Kansas and the lead developer for AffiliateWP. Along with AffiliateWP, Pippin is the founder of Easy Digital Downloads, a complete e-commerce plugin for selling digital products through WordPress, and Restrict Content Pro, a plugin for managing and selling memberships to premium content.</p>

				<p>Beyond the world of WordPress, Pippin is a devoted father and husband. He thoroughly enjoys brewing coffee varieties from around the world, indulging in craft beers, and riding his bicycle from point A to point B whenever possible.</p>
				
				<p>
					<a href="http://twitter.com/pippinsplugins" title="Pippin's Plugins" target="_blank">@pippinsplugins</a><br/>
					<a href="http://pippinsplugins.com" title="Pippin's Plugins" target="_blank">http://pippinsplugins.com</a>
				</p>
			</div>

		
			<div class="col">

				<h1>Andrew Munro</h1>
				<img class="profile" alt="Andrew Munro" src="<?php echo get_stylesheet_directory_uri() . '/images/about-andrew.png'; ?>">
				<p>Andrew Munro lives on the other side of the world in New Zealand, which is typically associated with Hobbits and occasionally left off world maps because of its size and location.

<p>With a self-professed love for eCommerce, Andrew happily spends his days building plugins for EDD (Easy Digital Downloads), contributing code to EDD, or helping customers in the EDD support forums.</p>

<p>Andrew doesn't own a bicycle like Pippin, and although his car can get from A to B, he is often wondering whether it can get from point B to A again.</p>

				<p>
					<a href="http://twitter.com/sumobi_" title="Sumobi" target="_blank">@sumobi_</a><br/>
					<a href="http://sumobi.com" title="Sumobi" target="_blank">http://sumobi.com</a>
				</p>
			</div>
			
		</div>
		</section>
	</div>
</div>
<?php
get_footer();
