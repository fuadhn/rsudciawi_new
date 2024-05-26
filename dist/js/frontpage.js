// ==================================================
// Slideshow

if($('#rscSlideshowCarousel').length) {
  $('#rscSlideshowCarousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: true,
    items: 1,
    smartSpeed: 450,
    responsive: {
      0: {
        // Silent is gold
      },
      375: {
        // Silent is gold
      },
      640: {
        // Silent is gold
      },
      768: {
        // Silent is gold
      },
      1024: {
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
      },
      1280: {
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
      },
      1536: {
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
      }
    }
  })
}

// End: Slideshow
// ==================================================

// ==================================================
// Service

if($('#rscServiceCarousel').length) {
  $('#rscServiceCarousel').owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    dots: true,
    items: 3,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 1
      },
      375: {
        items: 1
      },
      640: {
        items: 2
      },
      768: {
        items: 2
      },
      1024: {
        items: 3
      },
      1280: {
        items: 3
      },
      1536: {
        items: 3
      }
    },
    onChanged: onChangedCallbackService
  })
}

function onChangedCallbackService(event) {
  var _total_active = $('#rscServiceCarousel').find('.owl-item.active').length;
  
  if(event.item.index === 0) {
    // Last item
    $('.rsc-prev-carousel').attr('disabled', 'disabled');
    $('.rsc-next-carousel').removeAttr('disabled');
  } else if(event.item.index === event.item.count - (_total_active - 1)) {
    // Last item
    $('.rsc-prev-carousel').removeAttr('disabled');
    $('.rsc-next-carousel').attr('disabled', 'disabled');
  } else {
    $('.rsc-prev-carousel').removeAttr('disabled');
    $('.rsc-next-carousel').removeAttr('disabled');
  }
}

if($('.rsc-prev-carousel').length) {
  $('.rsc-prev-carousel').on('click', (function(e) {
    e.preventDefault();

    var _target = $(this).data('target');

    $(_target).trigger('prev.owl.carousel');
  }))
}

if($('.rsc-next-carousel').length) {
  $('.rsc-next-carousel').on('click', (function(e) {
    e.preventDefault();

    var _target = $(this).data('target');

    $(_target).trigger('next.owl.carousel');
  }))
}

// End: Service
// ==================================================

// ==================================================
// Promo

if($('#rscPromoCarousel').length) {
  $('#rscPromoCarousel').owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    dots: true,
    items: 3,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 1
      },
      375: {
        items: 1
      },
      640: {
        items: 2
      },
      768: {
        items: 2
      },
      1024: {
        items: 3
      },
      1280: {
        items: 4
      },
      1536: {
        items: 4
      }
    }
  })
}

// End: Promo
// ==================================================

// ==================================================
// Gallery

if($('#rscGalleryCarousel').length) {
  $('#rscGalleryCarousel').owlCarousel({
    loop: false,
    center: false,
    margin: 8,
    nav: false,
    dots: true,
    items: 5,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 3
      },
      375: {
        items: 3
      },
      640: {
        items: 4
      },
      768: {
        items: 5
      },
      1024: {
        items: 5
      },
      1280: {
        items: 5
      },
      1536: {
        items: 5
      }
    }
  })
}

$(document).on('click', '.rsc-preview-item', (function(e) {
  e.preventDefault();

  var _url = $(this).attr('src');

  $('.rsc-preview-item').css({
    'border': '2px solid transparent'
  })

  $(this).css({
    'border': '2px solid #e17852'
  })

  $('#rscPreviewGallery').css({
    'background-image': 'url(' + _url + ')'
  })
}))

if($('#rscCloseGallery').length) {
  $('#rscCloseGallery').on('click', (function(e) {
    e.preventDefault();

    $('#rscGallery').hide();
  }))
}

if($('.rsc-open-gallery').length) {
  $('.rsc-open-gallery').on('click', (function(e) {
    e.preventDefault();

    var _title_gallery = $(this).data('title');
    var _list_gallery = $(this).data('gallery');
    var _arr_gallery = [];
    var _html_items = "";

    $.each(_list_gallery.split(",").slice(0,-1), function(index, item) {
      _arr_gallery.push(item);
      _html_items += '<div class="item"><img src="' + item + '" alt="" class="rsc-preview-item" /></div>';
    });

    if(_arr_gallery.length == 0) {
      _html_items += '<div class="item"><img src="' + _list_gallery + '" alt="" class="rsc-preview-item" /></div>';
    }

    $('#rscTitleGallery').html(_title_gallery);
    $('#rscPreviewGallery').css({
      'background-image': 'url(' + (_arr_gallery.length > 0 ? _arr_gallery[0] : _list_gallery) + ')'
    });

    $('#rscGalleryCarousel').trigger('replace.owl.carousel', _html_items).trigger('refresh.owl.carousel');

    $('#rscGallery').show();
  }))
}

// End: Gallery
// ==================================================

// ==================================================
// Blog

var updateBackToFirst = function() {
  if($('.rsc-backto-first').length) {
    $('.rsc-backto-first').each(function() {
      var _target = $(this).find('a').data('target');
      var _stage_outer = $(_target).find('.owl-stage-outer').outerWidth();
      var _stage = $(_target).find('.owl-stage-outer > .owl-stage').outerWidth();
      
      if(_stage < _stage_outer) {
        $('.rsc-backto-first').remove();
      }
    })
  }
}

setTimeout(function() {
  updateBackToFirst();
}, 300)

$(window).on('resize', (function() {
  updateBackToFirst();
}))

if($('#rscCategoryCarousel').length) {
  $('#rscCategoryCarousel').owlCarousel({
    loop: false,
    margin: 8,
    nav: false,
    dots: false,
    autoWidth: true,
    items: 1,
    smartSpeed: 450,
    onChanged: onChangedCallbackCategory
  })
}

function onChangedCallbackCategory(event) {
  var _last_active = $('#rscCategoryCarousel').find('.owl-item.active').find('.last').length;
  
  if(_last_active) {
    $('#rscCategoryCarousel').trigger('to.owl.carousel', 0);
  }
}

$('.rsc-backto-first').on('touchstart mousedown', function(e) {
  e.stopPropagation();
})

$('.rsc-backto-first > a').on('click', function(e) {
  e.preventDefault();

  var _target = $(this).data('target');

  $(_target).trigger('to.owl.carousel', 0);
})

if($('.rsc-category-item').length) {
  var _total = 0;

  $('.rsc-category-item').each(function() {
    var _width = $(this).find('span').outerWidth() + (4*12);
    _total += _width + 8;

    $(this).css({
      'width': _width
    })

    $(this).addClass('show');
  })

  $('#rscCategoryCarousel .owl-stage-outer .owl-stage').css({
    'width': _total
  })
}

if($('#rscBlogCarousel').length) {
  $('#rscBlogCarousel').owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    dots: true,
    items: 3,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 1
      },
      375: {
        items: 1
      },
      640: {
        items: 2
      },
      768: {
        items: 2
      },
      1024: {
        items: 3
      },
      1280: {
        items: 4
      },
      1536: {
        items: 4
      }
    }
  })
}

// End: Blog
// ==================================================

// ==================================================
// PKRS

if($('#rscPKRSCarousel').length) {
  $('#rscPKRSCarousel').owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    dots: true,
    items: 3,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 1
      },
      375: {
        items: 1
      },
      640: {
        items: 2
      },
      768: {
        items: 2
      },
      1024: {
        items: 3
      },
      1280: {
        items: 4
      },
      1536: {
        items: 4
      }
    }
  })
}

// End: PKRS
// ==================================================