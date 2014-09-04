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

    jQuery(function () {

        var shrink = function() {
            if (jQuery(this).scrollTop() > 0 ) {
                jQuery('.home #masthead').addClass('shrink');
            }
            else {
                jQuery('.home #masthead').removeClass('shrink');
            }
        };

        jQuery(function() {
            shrink();
        });

        jQuery(window).scroll(function () {
             shrink();
        });

        jQuery('#back-top').click(function () {
            jQuery('body, html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    }); 

});