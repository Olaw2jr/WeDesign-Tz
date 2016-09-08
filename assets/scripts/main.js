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

// jshint ignore: start

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

        //** jQuery Scroll to Top Control script- (c) Dynamic Drive DHTML code library: http://www.dynamicdrive.com.
        //** Available/ usage terms at http://www.dynamicdrive.com (March 30th, 09')
        //** v1.1 (April 7th, 09'):
        //** 1) Adds ability to scroll to an absolute position (from top of page) or specific element on the page instead.
        //** 2) Fixes scroll animation not working in Opera. 


        var scrolltotop={
          //startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
          //scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
          setting: {startline:100, scrollto: 0, scrollduration:1000, fadeduration:[500, 100]},
          controlHTML: '<i class="fa fa-angle-up"></i>', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
          controlattrs: {offsetx:5, offsety:5}, //offset of control relative to right/ bottom of window corner
          anchorkeyword: '#top', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links

          state: {isvisible:false, shouldvisible:false},

          scrollup:function(){
            if (!this.cssfixedsupport) //if control is positioned using JavaScript
              this.$control.css({opacity:0}) //hide control immediately after clicking it
            var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
            if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
              dest=jQuery('#'+dest).offset().top
            else
              dest=0
            this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
          },

          keepfixed:function(){
            var $window=jQuery(window)
            var controlx=$window.scrollLeft() + $window.width() - this.$control.width() - this.controlattrs.offsetx
            var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
            this.$control.css({left:controlx+'px', top:controly+'px'})
          },

          togglecontrol:function(){
            var scrolltop=jQuery(window).scrollTop()
            if (!this.cssfixedsupport)
              this.keepfixed()
            this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
            if (this.state.shouldvisible && !this.state.isvisible){
              this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
              this.state.isvisible=true
            }
            else if (this.state.shouldvisible==false && this.state.isvisible){
              this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
              this.state.isvisible=false
            }
          },
          
          init:function(){
            jQuery(document).ready(function($){
              var mainobj=scrolltotop
              var iebrws=document.all
              mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
              mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
              mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
                .css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety, right:mainobj.controlattrs.offsetx, opacity:0, cursor:'pointer'})
                .attr({title:'Scroll Back to Top'})
                .click(function(){mainobj.scrollup(); return false})
                .appendTo('body')
              if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='') //loose check for IE6 and below, plus whether control contains any text
                mainobj.$control.css({width:mainobj.$control.width()}) //IE6- seems to require an explicit width on a DIV containing text
              mainobj.togglecontrol()
              $('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
                mainobj.scrollup()
                return false
              })
              $(window).bind('scroll resize', function(e){
                mainobj.togglecontrol()
              })
            })
          }
        }

        scrolltotop.init()


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
                 $('.nav-logo').addClass('logo-shrink');
             }
             else {
                 $('#header').removeClass('header-shrink');
                 $('.nav-logo').removeClass('logo-shrink');
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
    },

    // Contact Us page
    'contact': {
        init: function () {
            //Javascript to be fired on the contact us page
            var map;
            jQuery(document).ready(function(){

                map = new GMaps({
                    div: '#map',
                    lat: -6.8094156,
                    lng: 39.2840912,
                    scrollwheel: false
                });
                map.addMarker({
                    lat: -6.8094156,
                    lng: 39.2840912,
                    title: 'Address',
                    infoWindow: {
                        content:
                        '<h5 class="title">WeDesign</h5>' +
                        '<p>' +
                            '<span class="region">P.O Box 78,</span>' +
                            '<br><span class="postal-code">Usa-River</span><br>' +
                            '<span class="country-name">Arusha</span>' +
                        '</p>'
                    }

                });

            });
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
