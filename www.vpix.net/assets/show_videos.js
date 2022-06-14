$(document).ready(function() {
    // ordering is important
    // set the height and width before calling the dialog() function
    $("#videos_div").find("object").each(function(){
        $(this).attr('width', 640)
               .attr('height', 385);
    });
    $("#videos_div").find("embed").each(function(){
        $(this).attr('width', 640)
               .attr('height', 385);
    });

    $("#videos_div_iframe").find("object").each(function(){
        $(this).attr('width', 640)
               .attr('height', 385);
    });
    $("#videos_div_iframe").find("embed").each(function(){
        $(this).attr('width', 640)
               .attr('height', 385);
    });
    $('#vpix-iframe-div').on('click', 'span.close', hide_yt_iframe_div);
    $('#iframe-overlay').bind('click', hide_yt_iframe_div);

    $('#vpix-video-div').on('click', 'span.close', function() {
      $('#vpix-video-div').addClass('disp-none');
      $('#video-overlay').addClass('disp-none');
      $('#vpix-video-div').find('iframe').remove();
      $('#vpix-video-div').children('div').first().html('');
      $('#vpix-video-div').find('select').css('display', 'none');
      $('#vpix-video-div').find('select').children('option').remove();
      FSKrpano.enterFullscreenIff();
      send_video_close_event();
    });
    $('#vpix-video-div').on('change', 'select', function() {
      send_video_close_event();
      show_yt($(this).val());
    });

    if ($('.video').length > 0) {
      // calling the dialog function
      $(".video").dialog({
        autoOpen: false,
        modal: true,
        height: 475,
        width: 675,
        close: FSKrpano.enterFullscreenIff
      });
    }

    var height = window.innerHeight ? window.innerHeight : $(window).height();
    var width = $(window).width();

    // set the background color of the parent div of '.video' div
    // dialog() functions adds its own markup
    /*
    $(".video").each(function() {
      var bg_color = $(this).css('background-color');
      var par = $(this).parent('div.ui-dialog');

      $(par).css('background', bg_color);

      $(this).css('background', 'none');

      // this is for maintaining the uniform look and feel for tours on site
      // and also for vpix2go
      $("div.ui-dialog-titlebar").css({height: '26px', fontSize: '15px', fontWeight: 'bold'});
    });
    */
});

function show_yt(video_id) {
  var parts, iframe, div, wistia_div, i, id, option, has_multiple, name, select, ids, span, h4;

  select = $('#vpix-video-div').find('select').first();
  ids = video_id.split('|');
  if (ids.length > 1) {
    has_multiple = true;
    for (i=0; i<ids.length; ++i) {
      id = ids[i];
      name = document.getElementById('yt_' + id).value.split('|').shift();
      option = $('<option>').attr('value', id).text(name);
      $(select).append(option);
      $(select).css('display', 'block');
    }
  }
  else {
    has_multiple = ($(select).css('display') == 'block');
  }
  parts = document.getElementById('yt_' + ids[0]).value.split('|');
  if (parts[5] == 1) {
    $('#vpix-video-div').css({
      'width': parseInt(parts[2]) + 8 + 'px',
      'background-color': '#' + parts[4],
      'border-color': '#fff',
      'padding': '0px'
    });
  }
  else {
    $('#vpix-video-div').css({
      'width': parseInt(parts[2]) + 'px',
      'height': parseInt(parts[3]) + 'px',
      'background-color': '#' + parts[4],
      'border-color': '#' + parts[4],
      'border-width': '0px',
      'padding': '0px'
    });
  }
  $('#vpix-video-div').attr('data-video-id', video_id);
  $('#vpix-video-div').attr('data-video-title', parts[0]);

  span = $('#vpix-video-div').find('h4').first().children('span').first();
  if (has_multiple) {
    $(select).css('display', 'block');
    $(span).css('display', 'none');
  }
  else {
    $(span).html(parts[0]);
    $(span).css('display', 'block');
    $(select).css('display', 'none');
  }
  div = $('#vpix-video-div').children('div').first();
  $(div).html('');
  var krpano = document.getElementById('krpanoSWFObject');
  var gs_lang = krpano.get('vpix_gs_lang');
  if (gs_lang === null) {
    $(div).append(parts[1]);
  }
  else {
    var tmp = krpano.get('data[vhs_' + ids[0] + '_' + gs_lang + '].content');
    $(div).append(tmp);
    if (!has_multiple) {
      tmp = krpano.get('vpix_i18n_' + gs_lang + '[vhs_' + ids[0] + '].value');
      $(span).html(tmp);
    }
  }

  if ($(div).find('iframe').length > 0) {
    iframe = $(div).find('iframe').first();
    $(iframe).css('height', parts[3] + 'px');
    $('#video-overlay').removeClass('disp-none');
    $(iframe).bind('load', function() {
      show_yt_div(video_id, parts[0]);
    });
  }
  else {
    wistia_div = $(div).find('div.wistia_embed').first();
    $(wistia_div).css('height', parts[3] + 'px');
    $('#video-overlay').removeClass('disp-none');
    $('#vpix-video-div').removeClass('disp-none');
    send_video_open_event(video_id, parts[0]);
  }
  h4 = $('#vpix-video-div').find('h4').first();
  if (has_multiple) {
    $(h4).css('display', 'block');
    $(h4).css('background-color', '#' + parts[4]);
  }
  else {
    if (parts[5] == 1) {
      $(h4).css('display', 'block');
      $(h4).css('background-color', '#000');
    }
    else {
      $(h4).css('display', 'none');
    }
  }
  FSKrpano.exitFullscreenIff();

  return false;
}

function show_yt_div(video_id, video_title) {
  $('#vpix-video-div').removeClass('disp-none');
  send_video_open_event(video_id, video_title);
}

function send_video_open_event(video_id, video_title) {
  if (window.VpixTracker) {
    VpixTracker.videoHotspotClicked(video_id, video_title);
  }
}

function send_video_close_event() {
  if (window.VpixTracker) {
    var video_id = $('#vpix-video-div').attr('data-video-id');
    var video_title = $('#vpix-video-div').attr('data-video-title');
    VpixTracker.videoClosed(video_id, video_title);
    $('#vpix-video-div').attr('data-video-id', '');
    $('#vpix-video-div').attr('data-video-title', '');
  }
}

function show_yt_iframe(id,title) {
  var parts, iframe, krpano, gs_lang, tmp;

  parts = document.getElementById('iframe_' + id + '_hidden').value.split('|');
  $('#vpix-iframe-div').css({
    'width': parts[1] + 'px'
  });
  $('#vpix-iframe-div').attr('data-iframe-id', id);
  $('#vpix-iframe-div').attr('data-iframe-title', title);
  $('#vpix-iframe-div').find('h4').first().html(title);
  iframe = $('#vpix-iframe-div').find('iframe').first();
  krpano = document.getElementById('krpanoSWFObject');
  gs_lang = krpano.get('vpix_gs_lang');
  if (gs_lang === null) {
    $(iframe).attr('src', parts[0]);
  }
  else {
    tmp = krpano.get('data[eihs_' + id + '_' + gs_lang + '].content');
    $(iframe).attr('src', tmp);
    title = krpano.get('vpix_i18n_' + gs_lang + '[eihs_' + id + '].value');
    $('#vpix-iframe-div').find('h4').first().html(title);
  }
  $(iframe).css('height', parts[2]+'px');
  $('#iframe-overlay').removeClass('disp-none');
  $(iframe).bind('load', show_yt_iframe_div);
  FSKrpano.exitFullscreenIff();

  return false;
}

function show_yt_iframe_div() {
  if (window.VpixTracker) {
    var id = $('#vpix-iframe-div').attr('data-iframe-id');
    var title = $('#vpix-iframe-div').attr('data-iframe-title');
    VpixTracker.iframeHotspotClicked(id, title);
  }
  $('#vpix-iframe-div').removeClass('disp-none');
}

function hide_yt_iframe_div() {
  if (window.VpixTracker) {
    var id = $('#vpix-iframe-div').attr('data-iframe-id');
    var title = $('#vpix-iframe-div').attr('data-iframe-title');
    VpixTracker.iframeClosed(id, title);
  }
  $('#vpix-iframe-div').addClass('disp-none');
  $('#iframe-overlay').addClass('disp-none');
  // reset the src attribute to turn off the audio/video if any
  var iframe = $('#vpix-iframe-div').find('iframe').first();
  $(iframe).unbind('load', show_yt_iframe_div);
  $(iframe).attr('src', '');
  FSKrpano.enterFullscreenIff();
  $('#vpix-iframe-div').attr('data-iframe-id', '');
  $('#vpix-iframe-div').attr('data-iframe-title', '');
}

function show_mp4_video(video_src) {
  var img, video, max_height, max_width, height, width, diff_x, diff_y;
  if (document.getElementById('vpix_mp4_video')) {
    // one mp4 video is already open, do not open another.
    return;
  }

  if (window.VpixTracker) {
    VpixTracker.mp4VideoHotspotClicked();
  }

  $('#vpix-overlay').removeClass('disp-none');
  video = $('<video>')
           .prop('autoplay', true)
           .prop('loop', false)
           .prop('controls', true)
           .attr('preload', 'auto')
           .attr('src', video_src)
           .attr('id', 'vpix_mp4_video')
           .attr('poster', '/assets/fetching_video.png')
           .css({
             'position': 'absolute',
             'top': '50%',
             'left': '50%',
             'z-index': '10001',
             'background-color': 'rgba(8, 8, 8, 0.90);'
           });
  $(document.body).append(video);

  img = $('<img>').attr({
          'src': '/assets/close-X.png',
          'alt': 'close video'
        }).css({
          'position': 'absolute',
          'width': '24px',
          'height': '24px',
          'top': '20px',
          'right': '20px',
          'cursor': 'pointer',
          'z-index': '10001'
        }).
        attr('id', 'close_vpix_mp4_video');

  $(img).on('click', function() {
    $(video).remove();
    $(img).remove();
    $('#vpix-overlay').addClass('disp-none');
    FSKrpano.enterFullscreenIff();
    if (window.VpixTracker) {
      VpixTracker.mp4VideoClosed();
    }
  });
  FSKrpano.exitFullscreenIff();
  $(document.body).append(img);

  $(video).on('loadedmetadata', function() {
    max_height = window.innerHeight ? window.innerHeight : $(window).height();
    max_height -= 20;
    max_width = $(window).width();
    max_width -= 20;

    width = this.videoWidth;
    height = this.videoHeight;
    if (width > max_width) {
      width = max_width;
    }
    if (height > max_height) {
      height = max_height;
    }
    $(video).attr({
      'width': width + 'px',
      'height': height + 'px'
    });

    diff_x = parseInt((max_width - width) / 2);
    diff_y = parseInt((max_height - height) / 2);
    $(img).css({
      'top': diff_y + 'px',
      'right': diff_x + 'px'
    });
    diff_x = parseInt(width/2);
    diff_y = parseInt(height/2);
    $(video).css({
      'margin-top': '-' + diff_y + 'px',
      'margin-left': '-' + diff_x + 'px'
    });
  });
}

function show_iframe(url) {
  var div, span, iframe;

  div = $('<div>').css({
    'width': '100%',
    'height': '100%',
    'position': 'fixed',
    'top': '0px',
    'left': '0px',
    'padding': '0px',
    'margin': '0px',
    'border-width': '0px',
    'background-color': 'rgba(0, 0, 0, 0.6)',
    'z-index': '10000'
  });
  span = $('<span>').css({
    'float': 'right',
    'margin': '10px 10px 0px 0px',
    'font-weight': 'bold',
    'font-size': '2.5em',
    'color': '#fff',
    'cursor': 'pointer'
  }).html('X');
  $(span).bind('click', function() { $(div).remove(); });
  iframe = $('<iframe>').attr({
    'marginwidth': '0px',
    'marginheight': '0px',
    'frameborder': '0',
    'scaling': 'auto',
    'src': url
  }).css({
    'overflow': 'auto',
    'max-width': '80%',
    'width': '80%',
    'margin-left': '10%',
    'margin-top': '2%',
    'height': '90%',
    'border': '2px #fff solid'
  });
  $(div).append(span);
  $(div).append(iframe);
  $(document.body).append(div);
}

function play_audio(audio_url) {
  var div, span, audio, max_height, max_width, height, width, diff_x, diff_y;
  if (document.getElementById('vpix_mp3_audio')) {
    // one audio is already open, do not open another.
    return;
  }

  div = $('<div>')
          .attr('id', 'vpix_mp3_audio_div')
          .css({
             'position': 'absolute',
             'top': '45%',
             'left': '50%',
             'width': '300px',
             'margin-left': '-150px',
             'background-color': 'rgba(255, 255, 255, 0.75)',
             'border': '2px #ccc solid',
             'display': 'block',
             'padding': '3px 0px 0px 0px',
             'z-index': '10001'
          });
  span = $('<span>').css({
          'float': 'right',
          'font-size': '24px',
          'margin-top': '-28px',
          'cursor': 'pointer',
          'color': '#fff',
          'font-family': 'Helvetica,Sans-serif',
          'line-height': '25px',
          'font-weight': 'bold',
          'z-index': '10001'
        }).html('X')
        .attr('id', 'close_vpix_mp3_audio');
  $(span).on('click', stop_audio);
  $(div).append(span);

  audio = $('<audio>')
           .prop('autoplay', true)
           .prop('loop', false)
           .prop('controls', true)
           .attr('preload', 'auto')
           .attr('src', audio_url)
           .attr('id', 'vpix_mp3_audio')
           .css({
             'width': '100%',
             'margin': '0px',
             'border': '0px'
           });
  $(div).append(audio);

  FSKrpano.exitFullscreenIff();

  if (window.VpixTracker) {
    VpixTracker.audioHotspotClicked();
  }
  $('#vpix-overlay').removeClass('disp-none');
  $(document.body).append(div);
}

function stop_audio() {
  if (window.VpixTracker) {
    VpixTracker.audioClosed();
  }
  $('#vpix_mp3_audio_div').remove();
  FSKrpano.enterFullscreenIff();
  $('#vpix-overlay').addClass('disp-none');
}

var HDPhoto = function(dzi_url, orig_width, orig_height, style) {
  this.dzi_url = dzi_url;
  this.orig_width = orig_width;
  this.orig_height = orig_height;
  if (style) {
    this.style = style;
  }
  else {
    this.style = 1;
  }
};

HDPhoto.prototype.init = function() {
  var dims = this.get_dimensions();
  var styles = this.get_styles();

  var div = $('<div>')
              .attr('id', 'vpix_hd_photo')
              .css({
                'width': dims['width'] + 'px',
                'height': dims['height'] + 'px',
                'top': dims['m_top'] + 'px',
                'left': dims['m_left'] + 'px',
                'padding': styles['div_padding'],
                'box-sizing': 'border-box',
                'border': styles['div_border_width'] + ' #fff solid',
                'position': 'absolute',
                'background-color': styles['div_background_color'],
                'z-index': '10001'
              });
  var span = $('<span>')
               .attr('id', 'close_vpix_hd_photo')
               .css({
                 'position': 'absolute',
                 'top': '10px',
                 'right': '10px',
                 'font-size': styles['span_font_size'],
                 'font-family': 'Verdana, Sans-serif',
                 'line-height': styles['span_line_height'],
                 'font-weight': 'bold',
                 'color': '#fff',
                 'text-shadow': '2px 2px #000',
                 'z-index': '10002',
                 'cursor': 'pointer'
               }).html('X');
  $(span).bind('click', this.close_hd_photo.bind(this));

  FSKrpano.exitFullscreenIff();
  $(document.body).append(div);
  $(document.body).append(span);
  $('#vpix-overlay').removeClass('disp-none');

  var viewer = OpenSeadragon({
      id: 'vpix_hd_photo',
      prefixUrl: '/assets/openseadragon-bin-2.4.2/images/',
      visibilityRatio: 1.0,
      constrainDuringPan: true,
      tileSources: this.dzi_url
  });
  if (window.VpixTracker) {
    VpixTracker.hdPhotoHotspotClicked();
  }
  $(window).on('resize', this.on_resize.bind(this));
};

HDPhoto.prototype.on_resize = function() {
  var dims = this.get_dimensions();
  var div = document.getElementById('vpix_hd_photo');
  $(div).css({
    'width': dims['width'] + 'px',
    'height': dims['height'] + 'px',
    'top': dims['m_top'] + 'px',
    'left': dims['m_left'] + 'px'
  });
};

HDPhoto.prototype.close_hd_photo = function() {
  $(window).off('resize', this.on_resize);
  $('#close_vpix_hd_photo').remove();
  $('#vpix_hd_photo').remove();
  $('#vpix-overlay').addClass('disp-none');
  if (window.VpixTracker) {
    VpixTracker.hdPhotoClosed();
  }
}

HDPhoto.prototype.get_dimensions = function() {
  var height, width, display_width, display_height;

  var w_width = $(window).width();
  var w_height = $(window).height();

  display_width = Math.round(w_width * 0.92);
  display_height = Math.round(w_height * 0.92);

  var i_scale = this.orig_width / this.orig_height;
  var s_scale = display_width / display_height;

  if (s_scale > i_scale) {
    height = display_height;
    width = Math.floor(this.orig_width * display_height / this.orig_height);
  }
  else {
    width = display_width;
    height = Math.floor(this.orig_height * display_width / this.orig_width);
  }

  var m_left = Math.round((w_width - width)/2);
  var m_top = Math.round((w_height - height)/2);

  return {
    'width': width,
    'height': height,
    'm_left': m_left,
    'm_top': m_top
  };
};

HDPhoto.prototype.get_styles = function() {
  var styles = {};
  if (this.style == 1) {
    styles = {
      'div_padding': '0px',
      'div_border_width': '4px',
      'div_background_color': '#000',
      'span_font_size': '48px',
      'span_line_height': '50px'
    };
  }
  else {
    styles = {
      'div_padding': '4px',
      'div_border_width': '0px',
      'div_background_color': 'rgba(0,0,0,0)',
      'span_font_size': '24px',
      'span_line_height': '26px'
    };
  }

  return styles;
};

function show_hd_photo(dzi_url, orig_width, orig_height, style) {
  if (document.getElementById('vpix_hd_photo')) {
    console.log('only one hd-photo can be shown at a time');
    return;
  }
  var hdp = new HDPhoto(dzi_url, orig_width, orig_height, style);
  hdp.init();
}

/**
 * @author       Rob W <gwnRob@gmail.com>
 * @version      20120724
 * @description  Executes function on a framed YouTube video (see website link)
 *               For a full list of possible functions, see:
 * @param String frame_id The id of (the div containing) the frame
 * @param String func     Desired function to call, eg. "playVideo"
 *        (Function)      Function to call when the player is ready.
 * @param Array  args     (optional) List of arguments to pass to function func*/
function callPlayer(frame_id, func, args) {
    if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
    var iframe = document.getElementById(frame_id);
    if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
        iframe = iframe.getElementsByTagName('iframe')[0];
    }

    // When the player is not ready yet, add the event to a queue
    // Each frame_id is associated with an own queue.
    // Each queue has three possible states:
    //  undefined = uninitialised / array = queue / 0 = ready
    if (!callPlayer.queue) callPlayer.queue = {};
    var queue = callPlayer.queue[frame_id],
        domReady = document.readyState == 'complete';

    if (domReady && !iframe) {
        // DOM is ready and iframe does not exist. Log a message
        window.console && console.log('callPlayer: Frame not found; id=' + frame_id);
        if (queue) clearInterval(queue.poller);
    } else if (func === 'listening') {
        // Sending the "listener" message to the frame, to request status updates
        if (iframe && iframe.contentWindow) {
            func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
            iframe.contentWindow.postMessage(func, '*');
        }
    } else if (!domReady || iframe && (!iframe.contentWindow || queue && !queue.ready)) {
        if (!queue) queue = callPlayer.queue[frame_id] = [];
        queue.push([func, args]);
        if (!('poller' in queue)) {
            // keep polling until the document and frame is ready
            queue.poller = setInterval(function() {
                callPlayer(frame_id, 'listening');
            }, 250);
            // Add a global "message" event listener, to catch status updates:
            messageEvent(1, function runOnceReady(e) {
                var tmp = JSON.parse(e.data);
                if (tmp && tmp.id == frame_id && tmp.event == 'onReady') {
                    // YT Player says that they're ready, so mark the player as ready
                    clearInterval(queue.poller);
                    queue.ready = true;
                    messageEvent(0, runOnceReady);
                    // .. and release the queue:
                    while (tmp = queue.shift()) {
                        callPlayer(frame_id, tmp[0], tmp[1]);
                    }
                }
            }, false);
        }
    } else if (iframe && iframe.contentWindow) {
        // When a function is supplied, just call it (like "onYouTubePlayerReady")
        if (func.call) return func();
        // Frame exists, send message
        iframe.contentWindow.postMessage(JSON.stringify({
            "event": "command",
            "func": func,
            "args": args || [],
            "id": frame_id
        }), "*");
    }
    /* IE8 does not support addEventListener... */
    function messageEvent(add, listener) {
        var w3 = add ? window.addEventListener : window.removeEventListener;
        w3 ?
            w3('message', listener, !1)
        :
            (add ? window.attachEvent : window.detachEvent)('onmessage', listener);
    }
}
