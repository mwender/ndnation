(function($){
	$.urlParam = function(name){
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		if(results != null){
			return results[1];
		} else {
			return 0;
		}
	}
	var tab = $.urlParam('tab');
	$('#js-nl-archive-tabs').tabs(
		{
			active: tab
		}
	);

	$('.nl .nl-title .toggle').on('click', function(){ 
		var nlWrap = $(this).parent().parent();
		var nlList = nlWrap.find('.nl-list.collapsible');
		$(this).toggleClass('active');
		$(this).parent().parent().siblings().find('.toggle').removeClass('active');
		nlList.slideToggle(250);
		nlList.parent().siblings().children().next('.nl-list.collapsible').slideUp(250);
	});

	// Sticky Header Script
	var stickyHeader = $('.main-navigation').offset().top;
	
	$(window).scroll(function(){
	  if($(window).scrollTop() > stickyHeader){
	    $('.main-navigation').addClass('fixed');
	    $('.main-content').addClass('scrolled-to');
	  } else {
	    $('.main-navigation').removeClass('fixed');
	    $('.main-content').removeClass('scrolled-to');
	  }
	});
	// Schedules Script
	$('.game-more-info-trigger').on('click', function(){
		$(this).toggleClass('active');
		$(this).parent().siblings().children().next().removeClass('active');
		$(this).next('.game-more-info').slideToggle(250);
		$(this).next('.game-more-info').toggleClass('active');
		$(this).parent().siblings().children().next('.game-more-info').slideUp(250);
	});
	
	$('.comments-header').on('click', function(){
		$('.comments-toggle').toggleClass('active');
		$('.comments-area').slideToggle(800);
	});

	$(window).ready(windowResize);
	$(window).resize(windowResize);
	function windowResize(){
		var winWidth = $(window).width();
		var winHeight = window.innerHeight;
		var tnHeight = $('.top-navigation').outerHeight();
		var mnHeight = $('.main-navigation').outerHeight();
		if(winWidth <= 991 && winWidth >= 769){
			var shHeight = (mnHeight + tnHeight) - 37;
			var menuWidth = winWidth * 0.75;
			var menuHeight = (winHeight - shHeight) - 15;
			console.log(shHeight);
			$('#mega-menu-wrap-primary .mega-menu-toggle + #mega-menu-primary').css({'width': menuWidth + 'px', 'height': menuHeight + 'px', 'right': '-30px', 'top': shHeight + 'px'});
		} else if(winWidth <= 768){
			var shHeight = (mnHeight + tnHeight) - 9;
			var menuWidth = winWidth * 0.75;
			var menuHeight = (winHeight - shHeight) - 15;
			console.log(shHeight);
			$('#mega-menu-wrap-primary .mega-menu-toggle + #mega-menu-primary').css({'width': menuWidth + 'px', 'height': menuHeight + 'px', 'right': '-30px', 'top': shHeight + 'px'});
		} else {
			$('#mega-menu-wrap-primary .mega-menu-toggle + #mega-menu-primary').removeAttr('style');
		}
	}

	$('.top-nav-login-link').on('click', function(e){
		socmedWidth = $('.socmed-items').width();
		liPosOffset = socmedWidth + 20;
		navBarHeight = $('.navbar-right').height();
		e.stopPropagation();
		$(this).toggleClass('active');
		$('.top-nav-login-container').slideToggle(100);
		$('.top-nav-login-container').css({
			'right': liPosOffset + 'px',
			'top': navBarHeight + 'px',
		});
		$('#mega-menu-wrap-primary #mega-menu-primary li.mega-menu-megamenu>ul.mega-sub-menu').slideUp(100);
		$('.mega-menu-item').removeClass('mega-toggle-on');
		$('.search-icon').removeClass('active');
		$('.search-dropdown').slideUp(100);
	});
	$('.top-nav-login-container').on('click', function(e){
		e.stopPropagation();
	});

	$('.search-icon').on('click', function(event){
		event.stopPropagation();
		$(this).toggleClass('active');
		$('.search-dropdown').slideToggle(100);
		$('#mega-menu-wrap-primary #mega-menu-primary li.mega-menu-megamenu>ul.mega-sub-menu').slideUp(100);
		$('.mega-menu-item').removeClass('mega-toggle-on');
		$('.top-nav-login-link').removeClass('active');
		$('.top-nav-login-container').slideUp(100);
	});
	$('.search-dropdown').on('click', function (event) {
    event.stopPropagation();
	});
	$(document).on('click', function(){
		$('.search-icon').removeClass('active');
		$('.search-dropdown').slideUp(100);
		$('.top-nav-login-link').removeClass('active');
		$('.top-nav-login-container').slideUp(100);
	});

	// Disable cut copy and paste from textareas on Cladera Forms
	$('.caldera_forms_form .row .form-group textarea').on("cut copy paste",function(e) {
      e.preventDefault();
   });
	$('.caldera_forms_form .row .form-group textarea').bind("contextmenu",function(e){ 
		e.preventDefault(); 
	});

	url = encodeURIComponent(location.href);
  $('#st-facebook').click(function(){
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'fbshare', 'width=640,height=320');
  });
  $('#st-twitter').click(function(){
    window.open('http://twitter.com/share?url=' + url, 'twitterwindow', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
  });
  $('#st-email').click(function(){
    window.open('mailto:?&body=' + url);
  });
})(jQuery);