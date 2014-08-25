// add loaded class
jQuery(window).load(function() {
   jQuery('body').addClass('loaded');
});

jQuery(document).ready(function($) {

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

});