(function($) {
	$(".mobile-menu").click(function(){
    $(".mobile-panel").slideToggle("slow");
  });
})(jQuery);



(function($){
  if ($(window).width() > 767) {
  }
  else {
	$('.mobile-panel .sub-menu').hide();
    $('.menu-item-has-children .dropdownmenu').click(
		function() {
      $('.menu-item-has-children a').css("display", "block");	
       $(this).next().toggle();
    }
	
	);
  }
	
	
	$('h3.togg-head').on( 'click', function(){
		$(this).parent().find('div.togg-content').slideToggle();
		$(this).parent().toggleClass('togg-open togg-close');
	});
	
})(jQuery); 


(function($){
$(window).scroll(function(){
    if ($(window).scrollTop() >= 200) {
        $('header').addClass('fixed-header');
		$('#home-content').addClass('homescroll');
		$('.page_title').addClass('homescroll');
    }
    else {
        $('header').removeClass('fixed-header');
		$('#home-content').removeClass('homescroll');
		$('.page_title').removeClass('homescroll');
    }
});
})(jQuery); 

(function($){
	
	//BEGIN
	$(".accordion__title").on("click", function(e) {

		e.preventDefault();
		var $this = $(this);

		if (!$this.hasClass("accordion-active")) {
			$(".accordion__content").slideUp(400);
			$(".accordion__title").removeClass("accordion-active");
			$('.accordion__arrow').removeClass('accordion__rotate');
		}

		$this.toggleClass("accordion-active");
		$this.next().slideToggle();
		$('.accordion__arrow',this).toggleClass('accordion__rotate');
	});
	//END
	
})(jQuery); 