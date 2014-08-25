<?php
/**
 * Template Name: Testimonials
 *
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

		<section class="section columns-2 columns testimonials">
				<div class="wrapper">
					
					<div class="col">
						 <blockquote>
				          <p>AffiliateWP is an exceptional plugin. It's easy to use, well-written, and just plain works.</p>
				          <footer>Matt Gibbs, FacetWP</footer>
				        </blockquote>
					</div>	

						
					<div class="col">
						 <blockquote>
				          <p>AffiliateWP has allowed us to stop worrying about our affiliate program management every month and get on with building our business.</p>
				          <footer>Adam W. Warner, FooPlugins</footer>
				        </blockquote>
					</div>

					<div class="col">
						<blockquote>
				          <p>Affiliates can have a huge impact on sales, but the solutions out there are clunky. I wanted something self hosted, well written, and built on WordPress’ foundation. Coming from something dated, slow, and unstable: AffiliateWP is a breath of fresh air.</p>
				          <footer>Jonathan Christopher, SearchWP</footer>
				        </blockquote>
					</div>

					<div class="col">
						 <blockquote>
				          <p>AffiliateWP allowed me to have a feature rich affiliate system for WP-Push in less than 10 minutes. Super simple to setup, easy to maintain, and perfect for my needs.</p>
				          <footer>Chris Klosowski, WP-Push</footer>
				        </blockquote>
					</div>
					
					
					<div class="col">
						 <blockquote>
				          <p>AffiliateWP is hands-down the easiest affiliate system I have ever seen or worked with. With just a few clicks I had it installed and configured to my specific needs. The only thing easier than actually using this plugin was the decision to buy it. How can you say 'no' to something that was built by two of the most respected developers in the community and has a 100% refund policy?</p>
				          <footer>Brian, WPSessions</footer>
				        </blockquote>
					</div>

					<div class="col">
						 <blockquote>
				          <p>I spend all day in my WordPress dashboard so I wanted, nay, needed an affiliate solution that integrated flawlessly with WordPress. AffiliateWP was set up in minutes, is completely accurate, and helps me grow my business. It doesn't hurt that it's built by people you can trust either.</p>
				          <footer>James Laws, Ninja Forms</footer>
				        </blockquote>
					</div>
					
						<div class="col">
							<blockquote>
					          <p>Honestly, I'm super picky about what plugins I'll run on my sites. I've wanted to set up an affiliate program for a while, but all of the plugins I tried were buggy, overloaded with options, and difficult to use. When I heard Pippin was going to build one, I couldn't wait to try it. </p><p>Now that I've used it, I can honestly say that he's completely outdone himself. AffiliateWP is by far the most well-coded and easiest-to-use affiliate management plugin ever made for WordPress. There's no crazy setup or clunky dashboard to deal with.</p> <p>Everything works exactly like it should; just like core WordPress features. You literally install AffiliateWP, pick an option or two, and within a few minutes you've got a fully-functioning affiliate program. It doesn't get much better than that.</p>
					          <footer>Audit WP</footer>
					        </blockquote>
						</div>
					
						<div class="col">
							 <blockquote>
					          <p>Wow! You guys have done it again! I never cease to be impressed by the quality and ingenuity that comes from this team. AffiliateWP is feature packed right out the door and ridiculously easy to set up and use. So easy in fact, that after about a 5 minute install and configuration I had to scratch my head and say 'wait, what? That can't be it can it?'. Amazing. Simply Amazing.</p>

					          <p>What this plugin does for WordPress far surpasses any affiliate solution that I have found. Everything that I've used up to this point has been over polluted and unnecessarily complicated, but AffiliateWP is simple, clean, easy to use and here's the best part, it just works. No bull, no smoke and mirrors, out of the box it works, beautifully.</p>

					          <p>On top of all that, it is supported by an industry changing team that is beyond comparison. Never will you find a group of developers more committed to excellence and future development than these guys. Truly a great plugin and an amazing resource. Thank you!</p>
					          <footer>Janna Gilleland</footer>
					        </blockquote>
						</div>

						

					<div class="col">
						 <blockquote>
				          <p>I needed a simple, user friendly referral system to help promote my digital products on my site. AffiliateWP provides this for me along with an easy integration with my store. No other affiliate system available is better.</p>
				          <footer>Sebs Studio</footer>
				        </blockquote>
					</div>

					<div class="gap"></div>
					<div class="gap"></div>
			</div>
			<a class="button huge" href="<?php echo site_url( 'pricing'); ?>" title="Join These Happy Customers">Join These Happy Customers</a>
			</section>

			

	</div>
</div>



<?php
get_footer();