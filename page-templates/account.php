<?php
/**
 * Template Name: Account
 */

get_header(); ?>

<?php pp_page_header(); ?>



<div class="primary content-area">
	<div class="wrapper">

        <div id="tabs">
          <ul>
            <li><a href="#tab-subscription">Subscription</a></li>
            <li><a href="#tab-2">License Keys</a></li>
            <li><a href="#tab-3">Purchases</a></li>
            <li><a href="#tab-4">Profile</a></li>
            <?php /* <li><a href="#tab-5">Extras</a></li> */ ?>
          </ul>

        <div id="tab-subscription" class="box">
            <h2>Subscription Information</h2>
            <?php echo do_shortcode( '[subscription_details]'); ?>
        </div>

        <div id="tab-2" class="box">
            <h2>License Keys</h2>
            <?php echo do_shortcode( '[edd_license_keys]'); ?>
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

	</div>
</div>

<?php
get_footer();
