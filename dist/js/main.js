// ==================================================
// Lazy load

var lazyload_images = function() {
  $('.rsc-lazyload').each(function(i, obj) {
    var sourceImage = $(this).data('image');
    var elementPosition = $(this).offset().top;
    // var windowScrollPosition = window.outerHeight + window.scrollY;
    var elementTag = $(this).prop('tagName');
    var windowScrollPosition = $(window).scrollTop() + $(window).outerHeight();

    console.log(elementPosition);

    if(windowScrollPosition > elementPosition) {
      if(elementTag === 'IMG') {
        $(this).attr('src', sourceImage);
        $(this).removeClass('rsc-lazyload');
      } else if(elementTag === 'IFRAME') {
        $(this).attr('src', sourceImage);
        $(this).removeClass('rsc-lazyload');
      } else {
        $(this).css({
          'background-image': 'url(' + sourceImage + ')'
        })

        $(this).removeClass('rsc-animate-pulse');
        $(this).removeClass('rsc-lazyload');
      }
    }
  })
}

lazyload_images();

document.addEventListener('scroll', (e) => {
  lazyload_images();
})

// End: Lazy load
// ==================================================

// ==================================================
// Set height main and sidebar

var rscUpdateComponent = function() {
  var _window_height = $(window).height();
  var _adminbar_height = ($('#wpadminbar').length ? $('#wpadminbar').outerHeight() : 0);
  var _header_height = ($('#rscHeader').length ? $('#rscHeader').outerHeight() : 0);
  var _footer_height = ($('#rscFooter').length ? $('#rscFooter').outerHeight() : 0);
  var _min_height = _window_height - (_adminbar_height + _header_height + _footer_height);

  // Main
  $('#rscMain').css({
    'min-height': _min_height
  })
}

rscUpdateComponent();

$(window).on('resize', (function() {
  rscUpdateComponent();
}))

// End: Set height main and sidebar
// ==================================================

// ==================================================
// Header

// Topbar
if($('.rsc-topbar-mobile > ul > li').length) {
  $('.rsc-topbar-mobile > ul > li').on('click', (function(e) {
    e.preventDefault();

    // Close dropdown menu
    $('.rsc-mobile-nav > ul > li').find('> a > i').removeClass('fa-close fa-lg');
    $('.rsc-mobile-nav > ul > li').find('> a > i').addClass('fa-bars');
    
    $('.rsc-mobile-nav > ul > li').find('.rsc-submenu-wrap').removeClass('active');

    var _is_toggle = $(this).find('.rsc-submenu-wrap').length;
    
    if(_is_toggle) {
      var _is_active = $(this).find('.rsc-submenu-wrap').hasClass('active');

      if(_is_active) {
        $(this).find('.rsc-submenu-wrap').removeClass('active');
      } else {
        $('.rsc-topbar-mobile > ul > li').find('.rsc-submenu-wrap').removeClass('active');
        $(this).find('.rsc-submenu-wrap').addClass('active');
      }
    } else {
      var _href = $(this).find('a').attr('href');
      var _target = $(this).find('a').attr('target');

      if(_target === '_blank') {
        window.open(_href, _target);
      } else {
        document.location.href = _href;
      }
    }

    $(this).find('.rsc-submenu-wrap').click(function(e) {
      e.stopPropagation();
    })
  }))
}

// Toggle menu mobile
if($('.rsc-mobile-nav > ul > li').length) {
  $('.rsc-mobile-nav > ul > li').on('click', (function(e) {
    e.preventDefault();

    // Close dropdown topbar
    $('.rsc-topbar-mobile > ul > li').find('.rsc-submenu-wrap').removeClass('active');

    var _is_toggle = $(this).find('.rsc-submenu-wrap').length;
    
    if(_is_toggle) {
      var _is_active = $(this).find('.rsc-submenu-wrap').hasClass('active');

      if(_is_active) {
        $(this).find('> a > i').removeClass('fa-close fa-lg');
        $(this).find('> a > i').addClass('fa-bars');

        $(this).find('.rsc-submenu-wrap').removeClass('active');
      } else {
        $(this).find('> a > i').removeClass('fa-bars');
        $(this).find('> a > i').addClass('fa-close fa-lg');
        
        $('.rsc-mobile-nav > ul > li').find('.rsc-submenu-wrap').removeClass('active');
        $(this).find('.rsc-submenu-wrap').addClass('active');
      }
    } else {
      var _href = $(this).find('a').attr('href');
      var _target = $(this).find('a').attr('target');

      if(_target === '_blank') {
        window.open(_href, _target);
      } else {
        document.location.href = _href;
      }
    }

    $(this).find('.rsc-submenu-wrap').click(function(e) {
      e.stopPropagation();
    })
  }))
}

// Dropdown menu mobile
if($('.rsc-submenu-wrap > ul > li').length) {
  $('.rsc-submenu-wrap > ul > li').on('click', (function(e) {
    e.preventDefault();

    var _is_parent = $(this).find('.rsc-dropdown-wrap').length;
    var _is_active = $(this).hasClass('active');

    if(_is_parent) {
      if(_is_active) {
        $(this).removeClass('active');
      } else {
        $('.rsc-submenu-wrap > ul > li').removeClass('active');
        $(this).addClass('active');
      }
    } else {
      var _href = $(this).find('a').attr('href');
      var _target = $(this).find('a').attr('target');

      if(_target === '_blank') {
        window.open(_href, _target);
      } else {
        document.location.href = _href;
      }
    }

    $('.rsc-submenu-wrap > ul > li > .rsc-dropdown-wrap').click(function(e) {
      e.stopPropagation();
    })
  }))
}

// End: Header
// ==================================================

// ==================================================
// Scroll to

if($('.rsc-scrollto').length) {
  $('.rsc-scrollto').on('click', (function(e) {
    e.preventDefault();

    var _target = $(this).data('target');
    var _speed = ($(this).data('speed') ? $(this).data('speed') : 0);
    var _minus = ($(this).data('minus') ? $(this).data('minus') : 0);

    $([document.documentElement, document.body]).animate({
      scrollTop: $(_target).offset().top - _minus - 99.8
    }, _speed);
  }))
}

// End: Scroll to
// ==================================================