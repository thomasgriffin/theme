<?php
/**
 * Template Name: Join the site
 */

get_header(); ?>

<?php affwp_page_header(); ?>


<section class="section columns columns-3 grid">
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

		<a href="<?php echo site_url( 'join-the-site/register/?level=3' ); ?>" class="col box pricing best-value">
			<h2>Code Monkey</h2>

			<p>You spend so much time coding you start thinking in IF / ELSE statements</p>

			<ul class="list">
				<li class="price"><sup>$</sup>60</li>
				<li class="length">1 Year</li>
			</ul>	

			<span class="button">Join now</span>
		</a>

		<a href="<?php echo site_url( 'join-the-site/register/?level=2' ); ?>" class="col box pricing">
			<h2>Coder by Night</h2>

			<p>You stay up late drinking coffee and playing around with WordPress</p>

			<ul class="list">
				<li class="price"><sup>$</sup>16</li>
				<li class="length">3 Months</li>
			</ul>	

			<span class="button">Join now</span>
		</a>
	</div>

	<div class="align-center">
		<svg width="209px" height="76px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-best-value'; ?>"></use>
		</svg>
	</div>
</section>


<div class="action">
		<p class="free-plan">Not sure which one? <a href="<?php echo site_url( 'join-the-site/register/?level=0' ); ?>">Try my free membership plan</a>. You can always upgrade later.</p>
		</div>


<?php /*
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
*/ ?>

<div class="primary content-area slim">
	<div class="wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
		<article class="page type-page status-publish hentry">
			
			<div class="entry-content">
			
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pp' ) ); ?>
				
			</div>

		</article>
		<?php endwhile; ?>
	</div>
</div>

<?php echo pp_testimonials(); ?>

<?php

get_footer();
