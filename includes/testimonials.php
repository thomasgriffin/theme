<?php

function pp_testimonials() {
	?>
	<section class="section columns-3 columns testimonials">
		<div class="wrapper">
			
			

			<div class="col">
				<blockquote>
					<?php echo get_avatar( 'andrew@sumobi.com', '64', '', 'Andrew Munro, sumobi.com' ); ?>		
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>
						
						<footer>
							<h5>Andrew Munro</h5>
							<h6>WordPress plugin developer and designer at sumobi.com</h6>
						</footer>
					</blockquote>
			</div>

			<div class="col">
				<blockquote>
				<?php echo get_avatar( 'someguy@email.com', '64', '', 'Some Guy, website.com' ); ?>		
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>
					
					<footer>
						<h5>Some Guy</h5>
						<h6>Some guy, we don't really know who</h6>
					</footer>
				</blockquote>
			</div>
					
			<div class="col">
				<blockquote>
				<?php echo get_avatar( 'someguy@email.com', '64', '', 'Some Guy, website.com' ); ?>		
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>
					
					<footer>
						<h5>Some Guy</h5>
						<h6>Some guy, we don't really know who</h6>
					</footer>
				</blockquote>
			</div>

		</div>

		<div class="action">
			<a href="/join-the-site" class="button large">Join the site</a>
		</div>
	</section>

	<?php
}
//add_action( 'affwp_page_header_after', 'pp_testimonials' );