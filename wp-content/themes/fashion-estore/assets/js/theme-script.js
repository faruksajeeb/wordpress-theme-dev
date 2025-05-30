function fashion_estore_openNav() {
  jQuery(".sidenav").addClass('show');
}
function fashion_estore_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function fashion_estore_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const fashion_estore_nav = document.querySelector( '.sidenav' );

      if ( ! fashion_estore_nav || ! fashion_estore_nav.classList.contains( 'show' ) ) {
        return;
      }

      const elements = [...fashion_estore_nav.querySelectorAll( 'input, a, button' )],
        fashion_estore_lastEl = elements[ elements.length - 1 ],
        fashion_estore_firstEl = elements[0],
        fashion_estore_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && fashion_estore_lastEl === fashion_estore_activeEl ) {
        e.preventDefault();
        fashion_estore_firstEl.focus();
      }

      if ( shiftKey && tabKey && fashion_estore_firstEl === fashion_estore_activeEl ) {
        e.preventDefault();
        fashion_estore_lastEl.focus();
      }
    } );
  }

  fashion_estore_keepFocusInMenu();
} )( window, document );

jQuery(document).ready(function() {
  var slider_loop = jQuery('#skip-content').attr('slider-loop');
	var owl = jQuery('#top-slider .owl-carousel');
		owl.owlCarousel({
			margin: 25,
			nav: true,
			autoplay:true,
			autoplayTimeout:500,
			autoplayHoverPause:true,
			loop: slider_loop == 0 ? false : slider_loop,
      rtl: true,
			navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
			responsive: {
			  0: {
			    items: 1
			  },
			  600: {
			    items: 1
			  },
			  1024: {
			    items: 1
			}
		}
	});

  var owl = jQuery('#product-section .owl-carousel');
  owl.owlCarousel({
  margin: 30,
  nav:true,
  autoplay : true,
  lazyLoad: true,
  autoplayTimeout: 5000,
  loop: true,
  dots: false,
  navText : ['<i class="fas fa-caret-left aria-hidden="true""></i>','<i class="fas fa-caret-right "aria-hidden="true"></i>'],
  responsive: {
    0: {
      items: 1
    },
    576: {
      items: 1
    },
    768: {
      items: 2
    },
    1000: {
      items: 4
    },
    1200: {
      items: 4
    }
  },
  autoplayHoverPause : false,
  mouseDrag: true,
  });
})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
  jQuery(".loading2").delay(2000).fadeOut("slow");
});

jQuery(document).ready(function(){
  jQuery("button.cat_btn").click(function(){
    jQuery(".product_cat").toggle();
  });
});

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(window).scroll(function() {
  var data_sticky = jQuery('.navigation_header').attr('data-sticky');

  if (data_sticky == "true") {
    if (jQuery(this).scrollTop() > 1){
      jQuery('.navigation_header').addClass("stick_header");
    } else {
      jQuery('.navigation_header').removeClass("stick_header");
    }
  }
});
