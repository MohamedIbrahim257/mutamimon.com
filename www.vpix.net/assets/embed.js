// basic show and hide
$(document).ready(function() {
  $('.ebd_closeButton').click( function() {
    $('#ebd_holder').css({'display': 'none'});
    $('#ebd_holder').css({'z-index': '-1'});
    $('.ebd_part').hide();
  });
  $('#ebd_shareButton').click( function() {
    $('.ebd_part').show();
  });
  $('.ebd_closeButton').click( function() {
    $('#ebd_holder').css({'display': 'none'});
    $('.ebd_part,.ebd_part2').hide();
    $('#ebd_holder').css({'z-index': '-1'});
  });
  $('.ebd_button').click( function() {
    $('.ebd_part2').show();
  });
  $('.ebd_button').click( function() {
    $('.ebd_part').hide();
  });
  $('.ebd_copy_paste').bind('focus', function() {
    $(this).select();
  });

  $('#ebd_holder').css({'display': 'none'});

  change_iframe();
});

function change_iframe() {
  var iframe = $("#ebd_iframe_text");
  var width = $("#ebd_width");
  var height = $("#ebd_height");
  var tour_url = $('#ebd_facebook').val();

  width.keyup(change_iframe);
  height.keyup(change_iframe);
  var iframe_text;
  iframe_text = '<iframe name="tours" marginwidth="0" marginheight="0" ' +
                'align="middle" border="0" frameborder="0" '+
                'style="height:'+height.val()+'px; width: '+width.val()+'px; z-index:1; clear:both;" allowtransparency="true" '+
                'allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" oallowfullscreen="true" msallowfullscreen="true" ' +
                'scrolling="no" src="' + tour_url + '"></iframe>';

  iframe.val(iframe_text);
}

function show_embed() {
  if ($('.ebd_part').css('display') == "none" && $('.ebd_part2').css('display') == "none") {
    $('#ebd_contentHolder').find('input.ebd_Fields').last().val(window.location.href);
    change_iframe();
    $('.ebd_part').show();
    // $('#ebd_holder').css({"visibility": 'visible'});
    $('#ebd_holder').css({'display': 'block'});
    $('#ebd_holder').css({'z-index': '100'});
  }
  else {
    $('.ebd_part').hide();
    $('.ebd_part2').hide();
    $('#ebd_holder').css({'z-index': '-1'});
    $('#ebd_holder').css({'display': 'none'});
  }
}
