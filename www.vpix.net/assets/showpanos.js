function show_slides() {
  if (document.getElementById('slideshow_container')) {
    VpixSlideShow.init();
  }
  else if (document.getElementById('slide-plus-container')) {
    $('#slide-plus-container').css('display', 'block');
  }
}

$(document).ready(function(){
	var height = window.innerHeight ? window.innerHeight : $(window).height();
    var th = 0;
    var change_height = true;
    if ($('.vt-tabs-menu').length > 0) {
      th += 50;
    }
    else if ($('#top-bar').length > 0) {
      change_height = false;
    }
    else if (document.getElementById('mt1-container')) {
      change_height = false;
    }
    height -= th;

    if (change_height) {
	  $("#krpanoDIV").css('height', height + 'px');
    }
	$(window).bind('resize', function(e){
		var height = window.innerHeight ? window.innerHeight : $(window).height();
        var th = 0;
        var change_height = true;
		var width = $(window).width(); 
        if ($('.vt-tabs-menu').length > 0) {
          th += 50;
        }
        else if ($('#top-bar').length > 0) {
          change_height = false;
        }
        else if (document.getElementById('mt1-container')) {
          change_height = false;
        }
        height -= th;
        if (change_height) {
		  $("#krpanoDIV").css('height', height + 'px');
        }
		$("#krpanoDIV").css('width', width);
        $('#slideshow_body_bg').css('height', height);
		$('#slideshow_body_bg').css('width', width);
	}); 

    if (document.getElementById('slide-plus-container')) {
      $('#slide-plus-container').on('click', '.spc-close', function() {
        $('#slide-plus-container').css('display', 'none');
      });
      $('#slide-plus-container').on('click', 'img.spc-slide-img', function() {
        var src = $(this).attr('src');
        var name = $.trim($(this).next('p').html());
        $('#slide-plus-full-image').children('img').first().attr('src', src);
        $('#slide-plus-full-image').children('p').first().html(name);
        $('#slide-plus-full-image').css('display', 'flex');
      });
      $('#slide-plus-full-image').bind('click', function() {
        $('#slide-plus-full-image').css('display', 'none');
      });
      $('#slide-plus-container').on('click', 'img.arrow-left', function() {
        var div = $('#slide-plus-container').children('div.spc-body').first();
        var scroll_width = parseInt($(div)[0].scrollWidth);
        var visible_width = parseInt($(div).width());
        if (scroll_width <= visible_width) {
          return;
        }
        var left = $(div).scrollLeft();
        if (left <= 0) {
          return;
        }
        var inc = Math.round(visible_width * 2 / 3);
        left -= inc;
        if (left < 0) {
          left = 0;
        }
        sl_slide_left(div, left);
      });
      $('#slide-plus-container').on('click', 'img.arrow-right', function() {
        var div = $('#slide-plus-container').children('div.spc-body').first();
        var scroll_width = parseInt($(div)[0].scrollWidth);
        var visible_width = parseInt($(div).width());
        if (scroll_width <= visible_width) {
          return;
        }
        var left = parseInt($(div).scrollLeft());
        if (scroll_width <= (left + visible_width)) {
          return;
        }
        var inc = Math.round(visible_width * 2 / 3);
        left += inc;
        if (left > scroll_width) {
          left = scroll_width;
        }
        sl_slide_right(div, left);
      });
    }

    if (document.getElementById('tour-languages-holder')) {
      $('#tour-languages-holder').on('click', 'div', function() {
        var krpano = document.getElementById('krpanoSWFObject');
        krpano.call('act_change_language("' + $(this).attr('data-code') + '");');
        $('#tour-languages-holder').remove();
      });
    }
}); 

function sl_slide_right(div, left) {
  var div_left = parseInt($(div).scrollLeft());
  var div_width = parseInt($(div).width());
  var div_scroll_width = parseInt($(div)[0].scrollWidth);
  if ((div_left + div_width + 50) > div_scroll_width) {
    left = div_scroll_width - div_width;
    $(div).scrollLeft(left);
    return;
  }
  if ((div_left + 50) < left) {
    $(div).scrollLeft(div_left + 50);
    setTimeout(sl_slide_right, 25, div, left);
  }
}

function sl_slide_left(div, left) {
  var div_left = parseInt($(div).scrollLeft());
  if ((div_left - 50) <= 0) {
    $(div).scrollLeft(0);
    return;
  }
  if ((div_left - 50) > left) {
    $(div).scrollLeft(div_left - 50);
    setTimeout(sl_slide_left, 25, div, left);
  }
}

function loadImages(imgs){
	var pre_image = new Array();
	for(var i=0;i<imgs.length;i++){
		pre_image[i] = new Image();
		pre_image[i].src = imgs[i];
	}
}

var SlideLightbox = (function() {
  // with inline images, vpix2go exports will be easier.
  var left_arrow = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAoCAQAAABOBPLeAAAAAmJLR0QA/4ePzL8AAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfiBQENEB8oFnTLAAAAh0lEQVQ4y7WVSQ6AMAzEpvz/z+WGumS1RM+2Qksykf47c0rSaOJjdPByhQWvVFjxQoUdT4UTT4QbDwULDwQbdwUPdwQfN4UIN4QYv4QMP4Qc34QKvgg1/BOquPR0B5V+Erg0eFbw40BrgOYD7Q0GCIwoCAEQMyDIQFSCMAZxDxbKurLaS7F9XpO3Sh5+KqVMAAAAAElFTkSuQmCC';

  var right_arrow = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAoCAQAAABOBPLeAAAAAmJLR0QA/4ePzL8AAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfiBQENEQpc0KFhAAAAmUlEQVQ4y62Vyw6AIAwEHf//n/VgDII8doycGULb3e22fTnHkd/lvg4hUF7PEJ4fShDqGtYIbdkrhHen5gi95s4Q+vMYI4xGOEIYT72PMBNKD2GurTfCSo4twlrBNUIi+idC5pOCkFrrRsjdeCG7tfO/X5JFy7bKwUlpSPFJeUsDSYvKEJAxI4NMRqUMYxn3nxdKurL0UtTnBJ44SiLzg9noAAAAAElFTkSuQmCC';

  var close = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4gUBDR0TlA5GrQAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdpdGggR0lNUFeBDhcAAAEFSURBVGje5VrbDoUwCFv5/3+eTyc5ifEyoLDGvZnM0k4HHTqG+MD/xZxzniYA6CT4xAl3E7tFvOGEp4ldIt5yskzASvK/YSzgCvLLAtgiPNhWFYiFiQhA1saOxEYWUAf5k4BqERmxwAKuIH8pgC0iExtVgViYqFwtxoKUPXLWK4mKTcfcT/TM4aquCxltOX+zRaym47ICxCqIbhuQLcJbzct9TLafCrvJqIioGWyzw1l23Ib4+PYrJL2JpdOodCGTthLSZk7aTksfaKSPlNKHeum2inRjS7q1KN3clW6vd5KPinAdaBhfLL2YtgP5CLbtQt4bw3YiH3Kj0r8a3N2w+88e8uMAU3gUR4C78M8AAAAASUVORK5CYII=';

  // Slide Lightbox Default
  var Default = function(images) {
    this.images = images;
  };
  Default.prototype.init = function() {
    var row_div, cell_div, img, thumbs_div, i, c;
  
    this.main_div = $('<div>').addClass('sl-container-2').attr('id', 'sl-container');
    row_div = $('<div>').addClass('slc-top-row');
    cell_div = $('<div>').addClass('slc-top-row-col1');
    img = $('<img>').attr('src', left_arrow).attr('alt', 'left arrow').addClass('arrow main-left-arrow');
    $(img).bind('click', this.show_prev_image.bind(this));
    $(cell_div).append(img);
    $(row_div).append(cell_div);
  
    cell_div = $('<div>').addClass('slc-top-row-col2');
    img = $('<img>').attr('src', this.images[0]['url']).attr('alt', 'image');
    $(cell_div).append(img);
    $(row_div).append(cell_div);
  
    cell_div = $('<div>').addClass('slc-top-row-col3');
    img = $('<img>').attr('src', close).attr('alt', 'close').addClass('close main-close');
    $(img).bind('click', this.close_modal.bind(this));
    $(cell_div).append(img);
    img = $('<img>').attr('src', right_arrow).attr('alt', 'right arrow').addClass('arrow main-right-arrow');
    $(img).bind('click', this.show_next_image.bind(this));
    $(cell_div).append(img);
    $(row_div).append(cell_div);
    $(this.main_div).append(row_div);
  
    row_div = $('<div>').addClass('slc-bottom-row');
    cell_div = $('<div>').addClass('slc-bottom-row-col1');
    img = $('<img>').attr('src', left_arrow).attr('alt', 'left arrow').addClass('arrow left-arrow disp-none');
    $(img).bind('click', this.scroll_thumbs_left.bind(this));
    $(cell_div).append(img);
    $(row_div).append(cell_div);
  
    cell_div = $('<div>').addClass('slc-bottom-row-col2');
    thumbs_div = $('<div>').addClass('thumbnail-scroller');
  
    c = this.images.length - 1;
    for (i=0; i<=c; i++) {
      img = $('<img>').attr('src', this.images[i]['url']);
      if (i == 0) {
        $(img).addClass('first active');
      }
      if (i == c) {
        $(img).addClass('last');
      }
      $(img).bind('click', this.thumbnail_clicked.bind(this));
      $(thumbs_div).append(img);
    }
    $(cell_div).append(thumbs_div);
    $(row_div).append(cell_div);
  
    cell_div = $('<div>').addClass('slc-bottom-row-col3');
    img = $('<img>').attr('src', right_arrow).attr('alt', 'right arrow').addClass('arrow right-arrow disp-none');
    $(img).bind('click', this.scroll_thumbs_right.bind(this));
    $(cell_div).append(img);
    $(row_div).append(cell_div);
    $(this.main_div).append(row_div);
  
    if (this.images.length > 1) {
      $(this.main_div).find('.main-right-arrow').removeClass('disp-none');
    }
    $(this.main_div).find('.main-left-arrow').addClass('disp-none');
    $(document.body).append($(this.main_div));
    this.scroller_arrows();
    FSKrpano.exitFullscreenIff();
  };
  Default.prototype.scroll_thumbs_left = function() {
    var thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    if ($(thumbs_div).scrollLeft() > 0) {
      $(thumbs_div).animate({
        scrollLeft: '-=200'
      }, 500);
    }
  };
  Default.prototype.scroll_thumbs_right = function() {
    var thumbs_div, div_width, scroller_width, tmp;
  
    thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    div_width = $(thumbs_div).width();
    scroller_width = $(thumbs_div)[0].scrollWidth;
    tmp = scroller_width - div_width;
    tmp += 20;
    if ($(thumbs_div).scrollLeft() < tmp) {
      $(thumbs_div).animate({
        scrollLeft: '+=200'
      }, 500);
    }
  };
  Default.prototype.show_prev_image = function() {
    var thumbs_div, img, prev_img;
  
    thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    img = $(thumbs_div).find('img.active');
    if (!$(img).hasClass('first')) {
      prev_img = $(img).prev('img');
      $(thumbs_div).children('img').removeClass('active');
      $(prev_img).addClass('active');
      if ($(prev_img).hasClass('first')) {
        $(this.main_div).find('.main-left-arrow').addClass('disp-none');
      }
      this.change_main_image($(prev_img).attr('src'));
      this.scroll_iff(prev_img);
    }
    $(this.main_div).find('.main-right-arrow').removeClass('disp-none');
  };
  Default.prototype.show_next_image = function() {
    var thumbs_div, img, next_img;
  
    thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    img = $(thumbs_div).find('img.active').first();
    if (!$(img).hasClass('last')) {
      next_img = $(img).next('img');
      $(thumbs_div).children('img').removeClass('active');
      $(next_img).addClass('active');
      if ($(next_img).hasClass('last')) {
        $(this.main_div).find('.main-right-arrow').addClass('disp-none');
      }
      this.change_main_image($(next_img).attr('src'));
      this.scroll_iff(next_img);
    }
    $(this.main_div).find('.main-left-arrow').removeClass('disp-none');
  };
  Default.prototype.scroll_iff = function(img) {
    var thumbs_div, div_width, scroll_x, img_width, img_left;
  
    thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    div_width = $(thumbs_div).width();
    img_width = $(img).width();
    img_left = $(img).position().left;
    if (img_left < 0) {
      img_left -= img_width;
    }
    else {
      img_left += img_width;
    }
    if (img_left < 0) {
      scroll_x = 0 - img_left;
      $(thumbs_div).animate({
        scrollLeft: '-=' + scroll_x
      }, 500);
    }
    else if (img_left > div_width) {
      scroll_x = img_left - div_width;
      $(thumbs_div).animate({
        scrollLeft: '+=' + scroll_x
      }, 500);
    }
  };
  Default.prototype.thumbnail_clicked = function(e) {
    var thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    $(thumbs_div).children('img').removeClass('active');
    var img = e.target;
    $(img).addClass('active');
    this.change_main_image($(img).attr('src'));
    if ($(img).hasClass('first')) {
      $('.main-left-arrow').addClass('disp-none');
    }
    else {
      $('.main-left-arrow').removeClass('disp-none');
    }
    if ($(img).hasClass('last')) {
      $('.main-right-arrow').addClass('disp-none');
    }
    else {
      $('.main-right-arrow').removeClass('disp-none');
    }
  };
  Default.prototype.change_main_image = function(src) {
    $(this.main_div).find('.slc-top-row-col2').first().children('img').first().attr('src', src);
  };
  Default.prototype.close_modal = function() {
    $(this.main_div).remove();
    FSKrpano.enterFullscreenIff();
    slide_lightbox_closed();
  };
  Default.prototype.scroller_arrows = function() {
    var thumbs_div = $(this.main_div).find('.thumbnail-scroller').first();
    if ($(thumbs_div)[0].scrollWidth > $(thumbs_div).width()) {
      $(this.main_div).find('.slc-bottom-row').find('img.left-arrow').removeClass('disp-none');
      $(this.main_div).find('.slc-bottom-row').find('img.right-arrow').removeClass('disp-none');
    }
    else {
      $(this.main_div).find('.slc-bottom-row').find('img.left-arrow').addClass('disp-none');
      $(this.main_div).find('.slc-bottom-row').find('img.right-arrow').addClass('disp-none');
    }
    $(this.main_div).find('.main-left-arrow').addClass('disp-none');
  };
  
  // Slide Lightbox Plus
  var Plus = function(images) {
    this.images = images;
  };
  Plus.prototype.init = function(name) {
    var div, span, img, p, i, slide_div, slide_img, slide_p;
  
    this.bg_div = $('<div>').css({
      'position': 'fixed',
      'top': '0px',
      'left': '0px',
      'width': '100%',
      'height': '100%',
      'z-index': '10000',
      'background-color': 'rgba(0, 0, 0, 0.5)'
    });
    this.thumbs_div = $('<div>').addClass('slide-plus-container').attr('id', 'slb-plus-container');
    div = $('<div>').addClass('spc-header');
    span = $('<span>').html(name);
    $(div).append(span);
    img = $('<img>').attr({'src': close, 'alt': 'close'}).css({'width': '20px', 'height': '20px'}).addClass('spc-close');
    $(img).bind('click', this.hide_container.bind(this));
    $(div).append(img);
    $(this.thumbs_div).append(div);
  
    this.spc_body = $('<div>').addClass('spc-body');
    img = $('<img>').attr({'src': left_arrow, 'alt': 'left'}).addClass('arrow arrow-left');
    $(img).bind('click', this.move_left.bind(this));
    $(this.spc_body).append(img);
    img = $('<img>').attr({'src': right_arrow, 'alt': 'right'}).addClass('arrow arrow-right');
    $(img).bind('click', this.move_right.bind(this));
    $(this.spc_body).append(img);
    for (i=0; i<this.images.length; ++i) {
      slide_div = $('<div>').addClass('spc-slide');
      slide_img = $('<img>').attr('src', this.images[i]['url']).addClass('spc-slide-img');
      $(slide_img).bind('click', this.show_large_image.bind(this));
      slide_p = $('<p>').html(this.images[i]['name']);
      $(slide_div).append(slide_img);
      $(slide_div).append(slide_p);
      $(this.spc_body).append(slide_div);
    }
    $(this.thumbs_div).append(this.spc_body);
    $(document.body).append(this.bg_div);
    $(document.body).append(this.thumbs_div);
    $(this.spc_body).scrollLeft(0);
    this.scroll_width = parseInt($(this.spc_body)[0].scrollWidth);
    this.visible_width = parseInt($(this.spc_body).width());
  
    $(window).bind('resize', this.window_resized.bind(this));
  };
  Plus.prototype.window_resized = function() {
    this.scroll_width = parseInt($(this.spc_body)[0].scrollWidth);
    this.visible_width = parseInt($(this.spc_body).width());
  };
  Plus.prototype.show_large_image = function(e) {
    var src = $(e.target).attr('src');
    var name = $.trim($(e.target).next('p').html());
    var full_image_div = $('<div>').attr('id', 'slb-plus-full-image').addClass('slide-plus-full-image').css('background-color', 'rgba(0,0,0,0.90').css('display', 'flex');
    $(full_image_div).bind('click', function() {
      $(full_image_div).remove();
    });
    img = $('<img>').attr('src', src).attr('alt', 'slide');
    $(full_image_div).append(img);
    p = $('<p>').css('color', '#fff').html(name);
    $(full_image_div).append(p);
    $(document.body).append(full_image_div);
  };
  Plus.prototype.hide_container = function() {
    $(this.thumbs_div).remove();
    $(this.bg_div).remove();
    slide_lightbox_closed();
  };
  Plus.prototype.move_left = function() {
    if (this.scroll_width <= this.visible_width) {
      return;
    }
    var left = $(this.spc_body).scrollLeft();
    if (left <= 0) {
      return;
    }
    var inc = Math.round(this.visible_width * 0.67);
    left -= inc;
    if (left < 0) {
      left = 0;
    }
    this.scroll_left(left);
  };
  Plus.prototype.move_right = function() {
    if (this.scroll_width <= this.visible_width) {
      return;
    }
    var left = $(this.spc_body).scrollLeft();
    if (this.scroll_width <= (left + this.visible_width)) {
      return;
    }
    var inc = Math.round(this.visible_width * 0.67);
    left += inc;
    if (left > this.scroll_width) {
      left = this.scroll_width;
    }
    this.scroll_right(left);
  };
  Plus.prototype.scroll_left = function(left) {
    var div_left = parseInt($(this.spc_body).scrollLeft());
    if ((div_left - 50) <= 0) {
      $(this.spc_body).scrollLeft(0);
      return;
    }
    if ((div_left - 50) > left) {
      $(this.spc_body).scrollLeft(div_left - 50);
      setTimeout(this.scroll_left.bind(this), 25, left);
    }
  };
  Plus.prototype.scroll_right = function(left) {
    var div_left = parseInt($(this.spc_body).scrollLeft());
    if ((div_left + this.visible_width + 50) > this.scroll_width) {
      left = this.scroll_width - this.visible_width;
      $(this.spc_body).scrollLeft(left);
      return;
    }
    if ((div_left + 50) < left) {
      $(this.spc_body).scrollLeft(div_left + 50);
      setTimeout(this.scroll_right.bind(this), 25, left);
    }
  };

  // slide lightbox - common for text-above-image and text-below-image
  var TextImage = function(images, desc, above_below, box) {
    this.images = images;
    this.desc = desc;
    this.box_type = above_below;
    this.box = box;
    this.class_container = 'slt-' + above_below + '-container';
    this.class_arrow = 'slt-' + above_below + '-arrow';
    this.class_text = 'slt-' + above_below + '-text';
    this.class_images_holder = 'slt-' + above_below + '-images-holder';
  };
  TextImage.prototype.init = function() {
    var div1, div2, div3, span, img, i, c;

    $(window).bind('resize', this.set_dimensions.bind(this));

    this.main_div = $('<div>').addClass('slt-holder').attr('id', 'slt-holder');
    img = $('<img>').attr('src', close).attr('alt', 'close').addClass('close');
    $(img).bind('click', this.hide_container.bind(this));
    $(this.main_div).bind('click', this.hide_container.bind(this));
    $(this.main_div).append(img);
    var that = this;
    div1 = $('<div>').addClass('slt-container');
    // capture and do not pass on to click listener of the main-div which will close the box
    $(div1).bind('click', function() {return false;});
    // allow hyperlinks to  be treated normally
    $(div1).on('click', 'a', function(e) {
      e.stopPropagation();
      return true;
    });

    div2 = $('<div>').addClass(this.class_container).css({
        'background-color': that.box['bg_color'],
        'color': that.box['color'],
        'border-color': that.box['border_color']
    });
    if (this.images.length > 1) {
      img = $('<img>')
            .attr({'src': left_arrow, 'alt': 'left'})
            .addClass(this.class_arrow + ' left')
            .css('display', 'none');
      $(img).bind('click', this.show_prev.bind(this));
      $(div2).append(img);
      img = $('<img>')
            .attr({'src': right_arrow, 'alt': 'right'})
            .addClass(this.class_arrow + ' right');
      $(img).bind('click', this.show_next.bind(this));
      $(div2).append(img);
    }
    if (this.box_type != 'images') {
      div3 = $('<div>').addClass(this.class_text).html(this.desc);
      $(div2).append(div3);
    }

    div3 = $('<div>').addClass(this.class_images_holder);
    c = this.images.length - 1;
    for (i=0; i<=c; i++) {
      img = $('<img>').attr('src', this.images[i]['url']).attr('alt', 'image');
      if (i == 0) {
        $(img).addClass('first active');
      }
      else if (i == c) {
        $(img).addClass('last');
      }
      $(img).addClass('slide');
      $(div3).append(img);
    }
    $(div2).append(div3);
    $(div1).append(div2);
    $(this.main_div).append(div1);
    $(document.body).append(this.main_div);
    this.set_dimensions();
  };
  TextImage.prototype.set_dimensions = function() {
    var width, height, xh, xw, div;

    div = $(this.main_div).children('div.slt-container').first();
    width = parseInt($(window).width());
    height = parseInt($(window).height());
    if (width < 660 || height < 500) {
      if (width < height) { // portrait
        xw = Math.round(width * 0.92);
        xh = Math.round((xw / 4) * 4.5);
      }
      else {
        xh = Math.round(height * 0.92);
        xw = Math.round((xh /3 ) * 4);
      }
      $(div).css({
        'width': xw + 'px',
        'height': xh + 'px'
      });
    }
    else {
      $(div).css({
        'width': '640px',
        'height': '480px'
      });
    }
  };
  TextImage.prototype.show_prev = function() {
    var curr, prev;

    curr = $(this.main_div).find('img.slide.active').first();
    prev = $(curr).prev('img.slide');
    $(curr).removeClass('active');
    $(prev).addClass('active');
    if ($(prev).hasClass('first')) {
      $(this.main_div).find('img.' + this.class_arrow + '.left').css('display', 'none');
    }
    else {
      $(this.main_div).find('img.' + this.class_arrow + '.left').css('display', 'block');
    }
    $(this.main_div).find('img.' + this.class_arrow + '.right').css('display', 'block');
  };
  TextImage.prototype.show_next = function() {
    var curr, next;

    curr = $(this.main_div).find('img.slide.active').first();
    next = $(curr).next('img.slide');
    $(curr).removeClass('active');
    $(next).addClass('active');
    if ($(next).hasClass('last')) {
      $(this.main_div).find('img.' + this.class_arrow + '.right').css('display', 'none');
    }
    else {
      $(this.main_div).find('img.' + this.class_arrow + '.right').css('display', 'block');
    }
    $(this.main_div).find('img.' + this.class_arrow + '.left').css('display', 'block');
  };
  TextImage.prototype.hide_container = function() {
    $(this.main_div).remove();
    slide_lightbox_closed();
  };

  // slide light box - text above image
  var TextAbove = function(images, desc, box) {
    TextImage.call(this, images, desc, 'above', box);
  };
  TextAbove.prototype = Object.create(TextImage.prototype);

  // slide light box - text below image
  var TextBelow = function(images, desc, box) {
    TextImage.call(this, images, desc, 'below', box);
  };
  TextBelow.prototype = Object.create(TextImage.prototype);

  // slide light box - images only
  var ImagesOnly = function(images, desc, box) {
    TextImage.call(this, images, desc, 'images', box);
  };
  ImagesOnly.prototype = Object.create(TextImage.prototype);

  // slide light box - text and images side by side
  var TextSide = function(images, desc, box) {
    this.images = images;
    this.desc = desc;
    this.box = box;
  };
  TextSide.prototype.init = function() {
    var div1, div2, div3, img, i, c;

    $(window).bind('resize', this.set_dimensions.bind(this));

    this.main_div = $('<div>').addClass('slt-holder').attr('id', 'slt-holder');
    img = $('<img>').attr('src', close).attr('alt', 'close').addClass('close');
    $(img).bind('click', this.hide_container.bind(this));
    $(this.main_div).append(img);
    $(this.main_div).bind('click', this.hide_container.bind(this));

    div1 = $('<div>').addClass('slt-container-large').css({
      'background-color': this.box['bg_color'],
      'color': this.box['color'],
      'border-color': this.box['border_color']
    });
    $(div1).bind('click', function() { return false; });
    // allow hyperlinks to  be treated normally
    $(div1).on('click', 'a', function(e) {
      e.stopPropagation();
      return true;
    });
    div2 = $('<div>').addClass('slt-side-text-holder');
    div3 = $('<div>').addClass('slt-side-text').html(this.desc);
    $(div2).append(div3);
    $(div1).append(div2);

    div2 = $('<div>').addClass('slt-side-images-holder');
    if (this.images.length > 1) {
      img = $('<img>')
            .attr({'src': left_arrow, 'alt': 'left'})
            .addClass('slt-side-arrow left')
            .css('display', 'none');
      $(img).bind('click', this.show_prev.bind(this));
      $(div2).append(img);
      img = $('<img>')
            .attr({'src': right_arrow, 'alt': 'right'})
            .addClass('slt-side-arrow right');
      $(img).bind('click', this.show_next.bind(this));
      $(div2).append(img);
    }
    div3 = $('<div>').addClass('slt-side-images');
    c = this.images.length - 1;
    for (i=0; i<=c; ++i) {
      img = $('<img>').attr({'src': this.images[i]['url'], 'alt': 'slide'}).addClass('slide');
      if (i == 0) {
        $(img).addClass('first active');
      }
      else if (i == c) {
        $(img).addClass('last');
      }
      $(div3).append(img);
    }
    $(div2).append(div3);
    $(div1).append(div2);
    $(this.main_div).append(div1);
    $(document.body).append($(this.main_div));
    this.set_dimensions();
  };
  TextSide.prototype.set_dimensions = function() {
    var width, height, xh, xw, div, fd;

    div = $(this.main_div).children('div.slt-container-large').first();
    width = parseInt($(window).width());
    height = parseInt($(window).height());
    if (width < 980 || height < 500) {
      if (width < height) { // portrait
        xw = Math.round(width * 0.92);
        xh = Math.round(xw  * 1.5);
        fd = 'column';
      }
      else {
        xw = Math.round(width * 0.92);
        xh = Math.round(height * 0.75);
        fd = 'row';
      }
      $(div).css({
        'width': xw + 'px',
        'height': xh + 'px',
        'flex-direction': fd
      });
    }
    else {
      $(div).css({
        'width': '960px',
        'height': '480px',
        'flex-direction': 'row'
      });
    }
  };
  TextSide.prototype.hide_container = function() {
    $(this.main_div).remove();
    slide_lightbox_closed();
  };
  TextSide.prototype.show_prev = function() {
    var curr, prev;

    curr = $(this.main_div).find('img.slide.active').first();
    prev = $(curr).prev('img.slide');
    $(curr).removeClass('active');
    $(prev).addClass('active');
    if ($(prev).hasClass('first')) {
      $(this.main_div).find('img.slt-side-arrow.left').css('display', 'none');
    }
    else {
      $(this.main_div).find('img.slt-side-arrow.left').css('display', 'block');
    }
    $(this.main_div).find('img.slt-side-arrow.right').css('display', 'block');
  };
  TextSide.prototype.show_next = function() {
    var curr, next;

    curr = $(this.main_div).find('img.slide.active').first();
    next = $(curr).next('img.slide');
    $(curr).removeClass('active');
    $(next).addClass('active');
    if ($(next).hasClass('last')) {
      $(this.main_div).find('img.slt-side-arrow.right').css('display', 'none');
    }
    else {
      $(this.main_div).find('img.slt-side-arrow.right').css('display', 'block');
    }
    $(this.main_div).find('img.slt-side-arrow.left').css('display', 'block');
  };

  function slide_lightbox_opened(id) {
    if (window.VpixTracker) {
      _slide_lightbox_id = id;
      VpixTracker.slideLightboxHotspotClicked(_slide_lightbox_id);
    }
  }

  function slide_lightbox_closed() {
    if (window.VpixTracker) {
      VpixTracker.slideLightboxClosed(_slide_lightbox_id);
    }
  }

  var thisClass = {};

  var _images, _boxes, _description;
  var _slide_lightbox_id;

  thisClass.init = function(boxes, images, descriptions) {
    _boxes = boxes;
    _images = images;
    _descriptions = descriptions;
  };

  thisClass.show = function(id) {
    var krpano = document.getElementById('krpanoSWFObject');
    var lang = krpano.get('vpix_gs_lang');
    switch (_boxes[id]['theme']) {
      case '1':
        if (_images[id] && !document.getElementById('sl-container')) {
          new Default(_images[id]).init();
          slide_lightbox_opened(id);
        }
      break;
      case '2':
        if (_images[id] && !document.getElementById('slb-plus-container')) {
          if (lang && lang.length > 0) {
            new Plus(_images[id]).init(_boxes[lang][id]);
          }
          else {
            new Plus(_images[id]).init(_boxes[id]['name']);
          }
          slide_lightbox_opened(id);
        }
      break;
      case '3':
        if (_images[id] && !document.getElementById('slt-holder')) {
          var ta;
          if (lang && lang.length > 0) {
            ta = new TextAbove(_images[id], _descriptions[lang][id], _boxes[id]);
          }
          else {
            ta = new TextAbove(_images[id], _descriptions[id], _boxes[id]);
          }
          ta.init();
          slide_lightbox_opened(id);
        }
      break;
      case '4':
        if (_images[id] && !document.getElementById('slt-holder')) {
          var tb;
          if (lang && lang.length > 0) {
            tb = new TextBelow(_images[id], _descriptions[lang][id], _boxes[id]);
          }
          else {
            tb = new TextBelow(_images[id], _descriptions[id], _boxes[id]);
          }
          tb.init();
          slide_lightbox_opened(id);
        }
      break;
      case '5':
        if (_images[id] && !document.getElementById('slt-holder')) {
          var ts;
          if (lang && lang.length > 0) {
            ts = new TextSide(_images[id], _descriptions[lang][id], _boxes[id]);
          }
          else {
            ts = new TextSide(_images[id], _descriptions[id], _boxes[id]);
          }
          ts.init();
          slide_lightbox_opened(id);
        }
      break;
      case '6':
        if (_images[id] && !document.getElementById('slt-holder')) {
          var io = new ImagesOnly(_images[id], '', _boxes[id]);
          io.init();
          slide_lightbox_opened(id);
        }
      break;
    }
  };

  return thisClass;
})();

function show_slide_lightbox(id) {
  SlideLightbox.show(id);
}

function location_combo_font_size(font_size) {
  $('#krpanoSWFObject').find('select').each(function() {
    if ($(this).children('option').first().attr('name').search('cbo_') == 0) {
      $(this).css('font-size', font_size + 'px');
    }
  });
}

var FSKrpano = (function() {
  var thisClass = {};
  var _krpano, _was_fullscreen;

  function set_krpano() {
    _krpano = document.getElementById('krpanoSWFObject');
    if (!_krpano) {
      setTimeout(set_krpano, 1000);
    }
  }

  function init() {
    _was_fullscreen = false;
    set_krpano();
  }

  thisClass.exitFullscreenIff = function() {
    _was_fullscreen = _krpano.get('fullscreen');
    if (_was_fullscreen) {
      _krpano.set('fullscreen', false);
    }
  };

  thisClass.enterFullscreenIff = function() {
    if (_was_fullscreen) {
      _krpano.set('fullscreen', true);
    }
  };

  init();

  return thisClass;
})();

var VpixSlideShow = (function() {
  var thisClass = {};

  var _initiated = false, _running = false, _interval;

  function set_event_listeners() {
    $('#btn_ss').bind('click', toggle_slide_show);
    $('#btn_close').bind('click', stop_slide_show);
    $('#btn_prev').bind('click', show_previous);
    $('#btn_next').bind('click', show_next);
    $(window).bind('resize', set_dimensions);
  }

  function toggle_slide_show() {
    if (_running) {
      _running = false;
      clearInterval(_interval);
    }
    else {
      start_slide_show();
    }
  }

  function stop_slide_show() {
    $('#slideshow_bg').css('display', 'none');
    $('#slideshow_holder').css('display', 'none');
    clearInterval(_interval);
    var krpano = document.getElementById('krpanoSWFObject');
    krpano.call('act_slide_show_stop();');
  }

  function show_previous() {
    var tmp, div;

    tmp = $('#slideshow_container').find('div.slide.active').first();
    if ($(tmp).prev('div.slide').length == 0) {
      div = $('#slideshow_container').find('div.slide').last();
    }
    else {
      div = $(tmp).prev('div.slide');
    }
    $('#slideshow_container').find('div.slide').removeClass('active');
    $(div).addClass('active');
  }

  function show_next() {
    var tmp, div;

    tmp = $('#slideshow_container').find('div.slide.active').first();
    if ($(tmp).next('div.slide').length == 0) {
      div = $('#slideshow_container').find('div.slide').first();
    }
    else {
      div = $(tmp).next('div.slide');
    }
    $('#slideshow_container').find('div.slide').removeClass('active');
    $(div).addClass('active');
  }

  function start_slide_show() {
    $('#slideshow_bg').css('display', 'block');
    $('#slideshow_holder').css('display', 'flex');
    _interval = setInterval(show_next, 5000);
    _running = true;
  }

  function set_dimensions() {
    var width, height, xh, xw;

    width = parseInt($(window).width());
    height = parseInt($(window).height());
    if (width < 727 || height < 662) {
      if (width < height) { // portrait
        xw = Math.round(width * 0.92);
        xh = Math.round((xw / 4) * 3);
      }
      else {
        xh = Math.round(height * 0.92);
        xw = Math.round((xh / 3) * 4);
      }
      $('#slideshow_container').css({
        'width': xw + 'px',
        'height': xh + 'px'
      });
    }
    else {
      $('#slideshow_container').css({
        'width': '88%',
        'height': '80%'
      });
    }
  }

  thisClass.init = function() {
    if (_initiated) {
      start_slide_show();
      return;
    }

    _initiated = true;
    set_event_listeners();
    var div = $('#slideshow_container').find('div.slide').first();
    $(div).addClass('active');
    start_slide_show();
    set_dimensions();
  };

  return thisClass;
})();

