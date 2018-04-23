(function($) {
  
  "use strict";  

  $(window).on('load', function() {
  	// Material
	$.material.init();

	// Dropdown 
  	$('.dropdown-toggle').dropdown()

  	$('.search-icon').on('click',function() {
    $('.navbar-form').fadeIn(300);
    $('.navbar-form input').focus();
	  });
	  $('.navbar-form input').blur(function() {
	    $('.navbar-form').fadeOut(300);
	 });


	// Preloader
    $('#preloader').fadeOut();

    // Sticky Nav
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 200) {
            $('.scrolling-navbar').addClass('top-nav-collapse');
        } else {
            $('.scrolling-navbar').removeClass('top-nav-collapse');
        }
    });

    

	// Counter JS
    $('.work-counter-section').on('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $(this).find('.timer').each(function() {
                var $this = $(this);
                $({
                    Counter: 0
                }).animate({
                    Counter: $this.text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
            $(this).off('inview');
        }
    });	




	 // Back Top Link
	  var offset = 200;
	  var duration = 500;
	  $(window).scroll(function() {
	    if ($(this).scrollTop() > offset) {
	      $('.back-to-top').fadeIn(400);
	    } else {
	      $('.back-to-top').fadeOut(400);
	    }
	  });
	  
	  $('.back-to-top').click(function(event) {
	    event.preventDefault();
	    $('html, body').animate({
	      scrollTop: 0
	    }, 600);
	    return false;
	  });

  });      

}(jQuery));


