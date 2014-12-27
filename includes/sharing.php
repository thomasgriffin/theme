<?php

/**
 * Connect icon in the main navigation
 *
 * @since 1.0
 */
function pp_share_icon() {

?>
	<a href="#" class="menu-icon connect" title="">
		<svg width="24px" height="24px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-plus'; ?>"></use>
		</svg>
	</a>
<?php }

/**
 * Sharing icons
 *
 * @since 1.0
 */
function pp_sharing_navigation() {
	?>
	<ul class="menu-connect">	
		<li>
			<a href="http://twitter.com/pippinsplugins" target="_blank" title="Twitter">
				<svg width="30px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-twitter'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="http://vimeo.com/pippinsplugins" target="_blank" title="Vimeo">
				<svg width="29px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-vimeo'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="http://facebook.com/pippinsplugins" target="_blank" title="Facebook">
				<svg width="11px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-facebook'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="https://github.com/pippinsplugins" target="_blank" title="GitHub">
				<svg width="25px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-github'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="http://www.youtube.com/user/pippinsplugins" target="_blank" title="YouTube">
				<svg width="35px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-youtube'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="https://plus.google.com/101358949601627875484/posts" target="_blank" title="Google+">
				<svg width="35px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-googleplus'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('feed/rss'); ?>" title="RSS">
				<svg width="24px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-rss'; ?>"></use>
				</svg>
			</a>
		</li>
	</ul>

<?php	
}