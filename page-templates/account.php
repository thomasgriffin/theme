<?php
/**
 * Template Name: Account
 */



get_header(); ?>

<?php pp_page_header(); ?>



<div class="primary content-area">
	<div class="wrapper">
		<?php if ( is_user_logged_in() ) : ?>

	<?php if ( edd_has_user_purchased( get_current_user_id(), pp_get_rcp_download_id() ) ) : ?>
		<p class="notice">Purchase records and license keys for Restrict Content Pro have been moved to <a href="https://restrictcontentpro.com/account">restrictcontentpro.com</a>. Please log into your account there.</p>
	<?php endif; ?>

	<p class="notice">Memberrships to Pippin's Plugins have been discontinued. See my <a href="https://wp.me/p77rfW-pLi">blog post</a>.</p>

        <div id="tabs">

          <ul>
            <li><a href="#tab-1">Subscriptions</a></li>
            <li><a href="#tab-2">License Keys</a></li>
            <li><a href="#tab-3">Purchases</a></li>
            <li><a href="#tab-4">Profile</a></li>
            <?php /* <li><a href="#tab-5">Extras</a></li> */ ?>
          </ul>

        <div id="tab-1" class="box">
            <h2>Subscription Information</h2>
            <?php echo do_shortcode( '[subscription_details]'); ?>
        </div>

        <div id="tab-2" class="box">

			<?php
			// EDD SL only filters the_content, not page templates like this
			if ( ! ( empty( $_GET['action'] ) || empty( $_GET['payment_id'] ) ) && 'manage_licenses' == $_GET['action'] ) {

				echo '<h2>License Keys</h2>';
				echo '<h4>Manage sites</h4>';
				if ( isset( $_GET['license_id'] ) && isset( $_GET['view'] ) && 'upgrades' == $_GET['view'] ) {

					edd_get_template_part( 'licenses', 'upgrades' );

				} else {

					$view = isset( $_GET['license_id'] ) ? 'single' : 'overview';

					edd_get_template_part( 'licenses', 'manage-' . $view );

				}

			} else {
				echo '<h2>License Keys</h2>';
				echo do_shortcode( '[edd_license_keys]');
			}

			?>

        </div>

        <div id="tab-3" class="box">
            <h2>Purchase History</h2>
            <?php echo do_shortcode( '[purchase_history]'); ?>
        </div>

        <div id="tab-4" class="box">
            <h2>Profile Details</h2>
            <?php echo do_shortcode( '[rcp_profile_editor]'); ?>
        </div>

				<?php /*
        <div id="tab-5" class="box">
            <h2>Extras</h2>
            <p>Pro Add-ons for RCP</p>
        </div>
				*/ ?>

        </div>

			<?php else : ?>
				<div class="box">
					<?php echo do_shortcode( '[subscription_details]'); ?>
				</div>
			<?php endif; ?>

	</div>
</div>

<?php
get_footer();
