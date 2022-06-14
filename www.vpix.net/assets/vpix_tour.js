var VpixTour = (function() {
  var thisClass = {};

  var _krpano, _krpano_ready;
  var _is_mouse_down, _curr_mouse_y;

  function krpano_on_ready() {
    _krpano_ready = true;
    preload_audios();
    if (document.getElementById('vpix-app-menu')) {
      vpix_app_menu();
    }
  }

  function preload_audios() {
    var count, i, base_url, audio_name, url, audio;

    count = _krpano.get('vpix_audio_tag.count');
    if (count > 0) {
      base_url = _krpano.get('plugin[pi_soundinterface].rootpath');
      base_url = base_url.replace('%CURRENTXML%', '');
      for (i=0; i<count; ++i) {
        audio_name = _krpano.get('vpix_audio_tag[' + i + '].audio_name');
        url = base_url + audio_name;
        audio = document.createElement('audio');
        audio.style.display = 'none';
        audio.autoplay = false;
        audio.preload = 'auto';
        audio.src = url;
        audio.setAttribute('data_name', _krpano.get('vpix_audio_tag[' + i + '].name'));
        document.body.append(audio);
        audio.addEventListener('canplaythrough', audio_can_play);
        audio.load();
      }
    }
  }

  function audio_can_play(e) {
    var name = e.target.getAttribute('data_name');
    _krpano.call('vpix_audio_loaded(' + name + ');');
  }

  function vpix_app_menu() {
    var count, i, name, id, title, a, height, scroll_height;

    $('#vpix-app-menu-icon').bind('click', show_hide_app_menu);
    $('#vpix-app-menu').on('click', 'a', load_pano);
    count = _krpano.get('scene.count');
    for (i=0; i<count; ++i) {
      name = _krpano.get('scene[' + i + '].name');
      title = _krpano.get('scene[' + i + '].title');
      id = name.split('_')[1];
      a = $('<a>').attr('href', '#' + id).text(title);
      $('#vpix-app-menu').append(a);
    }
  }

  function load_pano(e) {
    e.preventDefault();
    e.stopPropagation();

    var action = 'act_change_scene_' + $(this).attr('href').substring(1) + '()';
    _krpano.call(action);
    hide_app_menu();
  }

  function show_hide_app_menu() {
    if ($('#vpix-app-menu').css('display') === 'none') {
      show_app_menu();
    }
    else {
      hide_app_menu();
    }
  }

  function show_app_menu() {
    var url, height, scroll_height;

    url = $('#vpix-app-menu-icon').attr('src').replace('double_arrow_down_white.png', 'double_arrow_up_white.png');
    $('#vpix-app-menu-icon').attr('src', url);
    $('#vpix-app-menu').slideDown(500, function() {;
      height = $('#vpix-app-menu').height();
      scroll_height = document.getElementById('vpix-app-menu').scrollHeight;
      if (scroll_height > height) {
        $('#vpix-app-arrows').css('display', 'block');
      }
      else {
        $('#vpix-app-arrows').css('display', 'none');
      }
    });
  }

  function hide_app_menu() {
    var url = $('#vpix-app-menu-icon').attr('src').replace('double_arrow_up_white.png', 'double_arrow_down_white.png');
    $('#vpix-app-menu-icon').attr('src', url);
    $('#vpix-app-menu').slideUp(500);
    $('#vpix-app-arrows').css('display', 'none');
  }

  function check_gyro() {
    if (_krpano_ready) {
      if (window.DeviceMotionEvent !== undefined &&
          typeof(window.DeviceMotionEvent.requestPermission) === 'function') {
        window.DeviceMotionEvent.requestPermission()
          .then(response => {
            if (response == 'granted') {
              _krpano.set('plugin[gyro].enabled', true);
            }
          })
          .catch(err => {
            console.log('check-gyro: error = ' + err);
          });
      }
    }
  }

  function set_krpano() {
    _krpano = document.getElementById('krpanoSWFObject');
    if (!_krpano) {
      setTimeout(set_krpano, 500);
    }
    else {
      // give some time for the xml to be parsed
      setTimeout(krpano_on_ready, 3000);
    }
  }

  thisClass.init = function() {
    _krpano_ready = false;
    set_krpano();
  };

  thisClass.playerClicked = function() {
    // onclick event set through javascript/jquery is not firing on mobile devices.
    if (document.getElementById('vpix-app-menu')) {
      hide_app_menu();
    }
  };

  thisClass.checkGyro = function() {
    check_gyro();
  };

  thisClass.sceneChanged = function() {
    var scene_id = _krpano.get('xml.scene').split('_')[1];
    if (window.MinimalTheme1 && MinimalTheme1.sceneChanged) {
      MinimalTheme1.sceneChanged(scene_id);
    }
    if (window.VpixTracker && VpixTracker.panoLoaded) {
      VpixTracker.panoLoaded(scene_id);
    }
  };

  return thisClass;
})();

