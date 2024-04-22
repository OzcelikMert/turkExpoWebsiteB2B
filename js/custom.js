$(document).ready(function()
{
	"use strict";
	/*
	Preloader 
	*
	/* Preloader */
	$(document).ready(function() {
		var preloaderFadeOutTime = 500;
		function hidePreloader() {
			var preloader = $('.pre_circle');
			setTimeout(function() {
				preloader.fadeOut(preloaderFadeOutTime);
			}, 500);
		}
		hidePreloader();
	});
	/* 
	1. Vars and Inits
	*/
	$( ".menu-btn").click(function() {
		$( ".mobile_menu" ).toggle();
		$("mobile_menu").css("overflow", "hidden");
	});
	
	var header = $('.header');
	var hamburgerBar = $('.hamburger_bar');
	var hamburger = $('.hamburger');
	setHeader();
	$(window).on('resize', function()
	{
		setHeader();
		setTimeout(function()
		{
			$(window).trigger('resize.px.parallax');
		}, 375);
	});
	$(document).on('scroll', function()
	{
		setHeader();
	});
	initMenu();
	/* 
	2. Set Header
	*/
	function setHeader()
	{
		if($(window).scrollTop() > 91)
		{
			header.addClass('scrolled');
			hamburgerBar.addClass('scrolled');
		}
		else
		{
			header.removeClass('scrolled');
			hamburgerBar.removeClass('scrolled');
		}
	}
	/* 
	3. Init Menu
	*/
	function initMenu()
	{
		if($('.menu').length)
		{
			var menu = $('.menu');
			hamburger.on('click', function()
			{
				hamburger.toggleClass('active');
				menu.toggleClass('active');
			});
		}
	}
	$(".search_input").on("keyup", function(){
	var myLength = $(".search_input").val().length;
	
	if(myLength>0){
		$(".search_button").addClass("search_button_allow");
		$(".search_icon").removeClass("search_icon_turn");
	}else{
		$(".search_button").removeClass("search_button_allow");
		$(".search_icon").addClass("search_icon_turn");
	}
	});
});