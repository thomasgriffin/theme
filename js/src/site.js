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

    // account tabs
    if( jQuery('#tabs').length ) {
      jQuery( "#tabs" ).tabs();
    }
    
    $(".post-video").fitVids();


  // $("#rcp_registration_form select#rcp_gateway").select2({minimumResultsForSearch: 15});


    // When discount link is clicked, hide the link, then show the discount input and set focus.
    $('body').on('click', '.edd-discount-link', function(e) {
        e.preventDefault();
        $('#edd-discount-code-wrap').toggle();
        $('#edd-discount').focus();
    });

    // software licensing
    // prevents link from being hidden
    $('#edd_sl_show_renewal_form').click(function(e) {
        $(this).show();
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

    // jQuery BBQ

    // The "tab widgets" to handle.
    var tabs = $('#tabs'),

      // This selector will be reused when selecting actual tab widget A elements.
      tab_a_selector = 'ul.ui-tabs-nav a';

    // Enable tabs on all tab widgets. The `event` property must be overridden so
    // that the tabs aren't changed on click, and any custom event name can be
    // specified. Note that if you define a callback for the 'select' event, it
    // will be executed for the selected tab whenever the hash changes.
    tabs.tabs({ event: 'change' });

    // Define our own click handler for the tabs, overriding the default.
    tabs.find( tab_a_selector ).click(function(){
      var state = {},

        // Get the id of this tab widget.
        id = $(this).closest( tabs ).attr( 'id' ),

        // Get the index of this tab.
        idx = $(this).parent().prevAll().length;

      // Set the state!
      state[ id ] = idx;
      $.bbq.pushState( state );
    });

    // Bind an event to window.onhashchange that, when the history state changes,
    // iterates over all tab widgets, changing the current tab as necessary.
    $(window).bind( 'hashchange', function(e) {

      // Iterate over all tab widgets.
      tabs.each(function(){

        // Get the index for this tab widget from the hash, based on the
        // appropriate id property. In jQuery 1.4, you should use e.getState()
        // instead of $.bbq.getState(). The second, 'true' argument coerces the
        // string value to a number.
        var idx = $.bbq.getState( this.id, true ) || 0;

        // Select the appropriate tab for this tab widget by triggering the custom
        // event specified in the .tabs() init above (you could keep track of what
        // tab each widget is on using .data, and only select a tab if it has
        // changed).
        $(this).find( tab_a_selector ).eq( idx ).triggerHandler( 'change' );
      });
    })

    // Since the event is only triggered when the hash changes, we need to trigger
    // the event now, to handle the hash the page may have loaded with.
    $(window).trigger( 'hashchange' );

});
