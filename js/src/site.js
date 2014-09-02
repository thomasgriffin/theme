// add loaded class
jQuery(window).load(function() {
   jQuery('body').addClass('loaded');
});

jQuery(document).ready(function($) {

    // adds a "selected" CSS class to the label when pricing or membership options are selected
    $('input:checked').closest("label").addClass("selected");

    $('input').click(function () {
      $('input:not(:checked)').parent().removeClass("selected");
      $('input:checked').parent().addClass("selected");
    });    


    $('body').on('edd_cart_item_added', function( response ) {
      $('#masthead .cart').removeClass('hidden');
    });	

    $('#show-gallery-images').click(function(e) {
    	e.preventDefault();
    	$(".image-gallery li.hidden").removeClass('hidden');

    	$(this).hide();	
    });

    // $('.rcp_subscription_level input:checked').closest('.rcp_subscription_level').addClass("selected");

    // $('.rcp_subscription_level input').click(function () {
    //   $('input:not(:checked)').closest('.rcp_subscription_level').removeClass("selected");
    //   $('input:checked').closest('.rcp_subscription_level').addClass("selected");
    // });



});