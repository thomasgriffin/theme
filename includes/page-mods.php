<?php
/**
 * Page modifications
 */

function pp_page_modifications() {
	if ( is_page( 'about' ) ) { ?>
		
		<section class="section columns columns-2">
			<div class="wrapper row box">
				
				<div class="wrapper row">
				<h2>Founder of Easy Digital Downloads</h2>
				<div class="col">
					<a href="http://pippinsplugins.dev/products/easy-digital-downloads/" title="Easy Digital Downloads">
						<img alt="edd" src="http://pippinsplugins.dev/wp-content/uploads/edd/2014/09/edd-480x240.png">
					</a>
				</div>

				<div class="col">

					
					

					<p>Easy Digital Downloads is a WordPress e-commerce plugin that focuses purely on digital products.</p>
					<p>Its primary goal is to make selling digital products simple and complete.</p>

					<a href="http://easydigitaldownloads.com" target="_blank">View Easy Digital Downloads &rarr;</a>
				</div>
				</div>
			
				
				
			</div>	
				
			<div class="wrapper row box">	

				<div class="col">
					<h2>Public Speaker</h2>
					<p>I travel around the United States to give presentations at WordCamps and similar events about WordPress plugin development.</p>
				</div>

				<div class="col">
					<img width="569" height="367" src="<?php echo get_stylesheet_directory_uri() . '/images/about-public-speaker.jpg'; ?>" />
				</div>

			</div>
		</section>

	<?php }
}
//add_action( 'pp_about_primary_after', 'pp_page_modifications' );
//add_action( 'pp_about_wrapper_end', 'pp_page_modifications' );


function pp_page_about() {
	if ( is_page( 'about' ) ) { ?>
		
	<a href="http://pippinsplugins.dev/wp-content/uploads/2014/08/about.jpg"><img class="alignright size-medium wp-image-200" src="http://pippinsplugins.dev/wp-content/uploads/2014/08/about-300x300.jpg" alt="about" width="300" height="300" /></a>	

	<?php }
}
//add_action( 'pp_about_primary_after', 'pp_page_about' );


