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