<?php
/**
 * Template Name: Join the site
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<div class="primary content-area">

	<section class="pricing">
		<?php

		?>
		<ul class="pricing-chart">

			<li class="">
				<h2>Hobby Coder</h2>
				<p>Do you like to code with WordPress in your spare time?</p>
				<ul>
					<li class="price">$6</li>
					<li class="length">1 Month</li>
				</ul>

				<a title="Join" class="button" href="<?php echo site_url( 'join-the-site/register/?level=1' ); ?>">Join now</a>
			</li>

			<li class="best-value">
				<h2>Code Monkey</h2>
				<p>Do you spend so much time in code you start thinking in IF / ELSE statements?</p>
				<ul>
					<li class="price">$60</li>
					<li class="length">1 Year</li>
					<li>Best value</li>
				</ul>

				<a title="Join" class="button" href="<?php echo site_url( 'join-the-site/register/?level=3' ); ?>">Join now</a>
			</li>

			<li class="">
				<h2>Coder by Night</h2>
				<p>Do you stay up late drinking coffee and playing around with WordPress?</p>
				<ul>
					<li class="price">$16</li>
					<li class="length">3 Months</li>
				</ul>
				<a title="Join" class="button" href="<?php echo site_url( 'join-the-site/register/?level=2' ); ?>">Join now</a>
			</li>

		</ul>

		<p class="free-plan">Not sure which one? <a href="<?php echo site_url( 'join-the-site/register/?level=0' ); ?>">Try my free membership plan</a>. You can always upgrade later.</p>

	</section>


</div>



<section class="section primary">


		<div class="wrapper">
		

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
					<?php //affwp_post_thumbnail(); ?>
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'affwp' ) ); ?>
						</div>
					</article>

				<?php endwhile; ?>


	</div>
	
		
</section>

<?php echo pp_testimonials(); ?>

<?php

get_footer();
