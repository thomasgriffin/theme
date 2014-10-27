<?php
/**
 * Template Name: Pricing
 *
 */

get_header(); ?>

<div class="primary content-area">
	<div class="wrapper">
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

			endwhile;
		?>







<section class="pricing">
	<?php
	// get ID of download by slug
	$id = affwp_get_post_by_title( 'affiliatewp', 'download' );
	$download_id = $id->ID;
	$download_url = edd_get_checkout_uri() . '?edd_action=add_to_cart&amp;download_id=' . $download_id;

	?>
	<ul class="pricing-chart">

		<li class="business">
			<h2>Business</h2>

			<ul>
				<li class="price">$99</li>
				<li class="count">3 sites</li>
				<li>1 Year of Updates &amp; Support *</li>
			</ul>

			<a title="Purchase" class="button" href="<?php echo $download_url; ?>&amp;edd_options[price_id]=1">Purchase</a>
			
		</li>

		<li class="developer">
			<h2>Developer</h2>

			<ul>
				<li class="price">$199</li>
				<li class="count">Unlimited sites</li>
				<li class="highlight">Access to all official  <a href="<?php echo get_post_type_archive_link( 'download' ); ?>">add-ons</a></li>
				<li>1 Year of Updates &amp; Support *</li>
			</ul>

			<a title="Purchase" class="button" href="<?php echo $download_url; ?>&amp;edd_options[price_id]=2">Purchase</a>
		</li>

		<li class="personal">
			<h2>Personal</h2>

			<ul>
				<li class="price">$49</li>
				<li class="count">1 site</li>
				<li>1 Year of Updates &amp; Support *</li>
			</ul>
			<a title="Purchase" class="button" href="<?php echo $download_url; ?>&amp;edd_options[price_id]=0">Purchase</a>
		</li>

	</ul>

	<p class="clause">* You must renew the license after one calendar year for continued updates and support. Discounted renewal rates available. See information below for details. All purchases are subject to our terms and condition of use.</p>

</section>



	</div>
</div>

<section class="section columns columns-3 pre-sale-questions">
	<div class="wrapper">

		<div class="col">
			<article>
				<h4>Is there a live demo I can try?</h4>
				<p>There sure is. You can <a href="http://demo.affiliatewp.com" target="_blank">try out AffiliateWP</a> live in your browser before you decide to purchase.</p>
			</article>

			
			<article>
				<h4>Do I need to renew my license?</h4>
				<p>The license key is valid for one year from the purchase date. An active license key is needed for access to automatic updates and support. Your license can be renewed each year at a 40% discount of the current price.</p>
			</article>
			
			<article>
				<h4>Can I upgrade my license?</h4>
				<p>Yes, we offer a 1-click upgrade process from your <a href="<?php echo site_url( 'account' ); ?>" title="Account" >account</a> page.</p>
			</article>

		</div>

		<div class="col">

			<article>
				<h4>Do you have a refund policy?</h4>
				<p><a title="Refund Policy" href="<?php echo site_url( 'refund-policy' ); ?>">Yes we do</a>! We firmly believe in and stand behind the quality of our product and will refund 100% of your money if you are unhappy with the plugin.</p>
			</article>

			<article>
				<h4>Do I get updates for the plugin?</h4>
				<p>Yes! Automatic updates are delivered 100% free of charge to all users with a valid license key.</p>
			</article>

			<article>
				<h4>I have other pre-sale questions, can you help?</h4>
				<p>Yes! You are welcome to ask any question you wish from our <a title="Support" href="<?php echo site_url( 'support' ); ?>">support page</a>.</p>
			</article>
			
		</div>

		<div class="col">
			<article>
				<h4>Do you offer support if I need help?</h4>
				<p>Yes! We believe that top-notch support is key for a quality product and will do our very best to resolve any issues you encounter via our <a title="Support" href="<?php echo site_url( 'support' ); ?>">support page</a>.</p>
			</article>

			<article>
				<h4>Will AffiliateWP work on WordPress.com?</h4>
				<p>No, AffiliateWP will not work on WordPress.com. It only works on self-hosted WordPress installs.</p>
			</article>

			
		</div>
	</div>	
</section>

<?php
get_footer();
