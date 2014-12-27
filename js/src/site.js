

// add loaded class
jQuery(window).load(function() {
   jQuery('body').addClass('loaded');
});

(function($){
   $.fn.lazybind = function(event, fn, timeout, abort){
        var timer = null;
        $(this).bind(event, function(){
            timer = setTimeout(fn, timeout);
        });
        if(abort == undefined){
            return;
        }
        $(this).bind(abort, function(){
            if(timer != null){
                clearTimeout(timer);
            }
        });
    };
})(jQuery);



jQuery(document).ready(function($) {


    $(".post-video").fitVids();
 


   $("#rcp_registration_form select").select2({minimumResultsForSearch: 15});


    // When discount link is clicked, hide the link, then show the discount input and set focus.
    $('body').on('click', '.edd-discount-link', function(e) {
        e.preventDefault();
        $('#edd-discount-code-wrap').toggle();
        $('#edd-discount').focus();
    });

    // software licensing
    $('#edd_sl_show_renewal_form').click(function(e) {
        e.preventDefault();
        $('#edd-license-key-container-wrap').toggle();
        $('#edd-license-key').focus();
    });

    $('.single-post #series-meta').append('<a href="JavaScript:void(0);" class="show-all">Show All</a>');
    
    $('a.show-all').click(function() {
        $('#series-list').toggle();
    });

    // adds a "selected" CSS class to the label when pricing or membership options are selected
    $('input:checked').closest("label").addClass("selected");

    $('input').click(function () {
      $('input:not(:checked)').parent().removeClass("selected");
      $('input:checked').parent().addClass("selected");
    });    

    $('body').on('edd_cart_item_added', function( response ) {
      $('#masthead .cart').removeClass('hidden');
      $(this).addClass('edd-items-in-cart');
    });	

    $(".menu-icon.connect").click( function() {

        $('#main').fadeOut( 250, function() {
            $(this).hide();
        });

        $('.menu-connect').addClass('show');
        $(this).addClass('hidethis');

    });


    $('#masthead').lazybind(
        'mouseout',
        function(){
 
            $('#main').fadeIn( 250, function() {
                 $(this).show();
            });

           
           $('.menu-icon.connect').removeClass('hidethis');
           $('.menu-connect').removeClass('show');
        },
        250,
        'mouseover');


    $('#show-gallery-images').click(function(e) {
    	e.preventDefault();
    	$(".image-gallery li.hidden").removeClass('hidden');

    	$(this).hide();	
    });

    $('.scroll').click(function(event){
      event.preventDefault();
      var offset = $($(this).attr('href')).offset().top;
      $('html, body').animate({scrollTop:offset}, 800);
    });
    
    jQuery(function () {

        jQuery('#back-top').click(function () {
            jQuery('body, html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });


});