/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
      // JavaScript to be fired on all pages

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired

        /* ======= Twitter Bootstrap hover dropdown ======= */   
        /* Ref: https://github.com/CWSpear/bootstrap-hover-dropdown */ 
        /* apply dropdownHover to all elements with the data-hover="dropdown" attribute */
        
        $('[data-hover="dropdown"]').dropdownHover();
        
        /* ======= jQuery Responsive equal heights plugin ======= */
        /* Ref: https://github.com/liabru/jquery-match-height */
        
         $('#who .item-inner').matchHeight();    
         $('#testimonials .item-inner .quote').matchHeight(); 
         $('#latest-blog .item-inner').matchHeight(); 
         $('#services .item-inner').matchHeight();
         $('#team .item-inner').matchHeight();
         
        /* ======= jQuery Placeholder ======= */
        /* Ref: https://github.com/mathiasbynens/jquery-placeholder */
        
        $('input, textarea').placeholder();         
        
        /* ======= jQuery FitVids - Responsive Video ======= */
        /* Ref: https://github.com/davatron5000/FitVids.js/blob/master/README.md */    
        $(".video-container").fitVids();   
        
      
        /* ======= Fixed Header animation ======= */ 
            
        $(window).on('scroll', function() {
             
             if ($(window).scrollTop() > 80 ) {
                 $('#header').addClass('header-shrink');
             }
             else {
                 $('#header').removeClass('header-shrink');             
             }
        });

        /* ======= Owl Carousel ======= */    
        /* Ref: http://owlgraphic.com/owlcarousel/index.html */

        $("#work-carousel").owlCarousel({
                    
            autoPlay : 6000,
            stopOnHover : true,
            paginationSpeed : 1000,
            goToFirstSpeed : 40,
            singleItem : true,
            autoHeight : true 
            
        }); 

        /* ======= Header Background Slideshow - Flexslider ======= */    
        /* Ref: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties */
        
        $('#bg-slider').flexslider({
            animation: "fade",
            directionNav: false, //remove the default direction-nav - https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties
            controlNav: false, //remove the default control-nav
            slideshowSpeed: 6000
        });
        
        /* ======= Case Study Slideshow - Flexslider ======= */ 
        //Ref: http://flexslider.woothemes.com/thumbnail-slider.html
        // The slider being synced must be initialized first
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 180,
            itemMargin: 5,
            asNavFor: '#slider'
        });
        
        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
        
        
        $('#work-carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false
        });

        /* ======= Isotope plugin ======= */
        /* Ref: http://isotope.metafizzy.co/ */
        // init Isotope    
        var $container = $('.isotope');
        
        $container.imagesLoaded(function () {
          $('.isotope').isotope({
              itemSelector: '.item'
          });
        });
        
        // filter items on button click
        $('#filters').on( 'click', 'button', function() {
          var filterValue = $(this).attr('data-filter');
          $container.isotope({ filter: filterValue });
        });
        
        // change is-checked class on buttons
        $('.button-group').each( function( i, buttonGroup ) {
          var $buttonGroup = $( buttonGroup );
          $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
          });
        });

        
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
