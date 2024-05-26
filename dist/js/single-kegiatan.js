// ==================================================
// Copy to clipboard

var rscCopyToClipboard = function(_text, _popup) {
  var $temp = $('<input>');
  
  $('body').append($temp);
  
  $temp.val(_text).select();
  document.execCommand('copy');
  
  $temp.remove();

  _popup.addClass('active');

  setTimeout(function() {
    _popup.removeClass('active');
  }, 1500)
}

if($('.rsc-copy-url').length) {
  $('.rsc-copy-url').on('click', (function(e) {
    e.preventDefault();

    var _url = $(this).attr('href');
    var _popup = $(this).parent().find('.rsc-popup-message');

    rscCopyToClipboard(_url, _popup);
  }))
}

// End: Copy to clipboard
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