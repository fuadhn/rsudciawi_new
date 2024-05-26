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