function calculateNavigationHeight(){
	var el = $('#navigation'),
	w = $(window),
	number = 100;

	if($('.navi-functions').length == 0)
	{
		number = 45;
	}

	el.css({
		height: w.height() - number
	});
}

function hideNav(){
	var nav = $(".mainNav"),
	navContainer = $("#navigation"),
	main = $("#main"),
	functions = $(".navi-functions");

	main.toggleClass("hiddenNav");
	navContainer.toggleClass("hidden");
	nav.getNiceScroll().resize();
	functions.toggleClass("hidden");

	if(main.hasClass('hiddenNav')){
		var el = '<div class="showNav"><a href="#" rel="tooltip" title="Show navigation" data-placement="right" class="button button-basic button-icon"><i class="icon-arrow-right"></i></a></div>'
		if($(".showNav").length == 0){
			$("#content").prepend(el);
			$(".showNav").bind('click', function(){
				hideNav();
			});
		}

		$(".showNav").show();
	} else {
		$(".showNav").hide();
	}
}

function collapsedNav(){
	var nav = $(".mainNav"),
	after = $('.collapse-me');
	if($(window).width() <= 986)
	{
		if($('.col-nav').length == 0)
		{
			after.hide().after("<select class='col-nav'></select>");
			var newElement = $('.col-nav');
			nav.find(">li").each(function(){
				var current = $(this).find(">a"),
				subnav = $(this).find('.subnav'),
				options ="";
				if(subnav.length > 0)
				{
					var subElements = "";
					subnav.find(">li").each(function(){
						var currentSub = $(this).find(">a");
						if($(this).hasClass("active")){
							options = "selected='selected' ";
						} 
						subElements += "<option "+options+"value='"+currentSub.attr("href")+"'> - "+currentSub.html()+"</option>";
					});
					newElement.append("<optgroup label='"+current.find("span").html()+"'>"+subElements+"</optgroup>");
				} else {
					if($(this).hasClass("active")){
						options = "selected='selected' ";
					} 
					newElement.append("<option "+options+"value='"+current.attr("href")+"'>"+current.find("span").html()+"</option>");
				}
			});
			newElement.bind('change', function(e){
				var targ;
				if (!e) {
					e = window.event;
				}
				if (e.target) {
					targ = e.target;
				}
				else if (e.srcElement){
					targ = e.srcElement;
				}
				if (targ.nodeType === 3){
					targ = targ.parentNode; 
				}
				if(targ.value) {
					window.location.href = targ.value;
				} 
			});
		}
	} else {
		$(".col-nav").remove();
		after.show();
	}
}

function toggleFixedLayoutNav(){
	var el = $(".layout-not-fixed"),
	nav = $('#navigation');
	if(el.hasClass('button-active'))
	{
		var top;
		if($(".layout-not-fluid").hasClass("button-active")){
			top = 40;
		} else {
			top = 0;
		}
		nav.css({
			position:'absolute',
			top:top,
			height:'auto',
			left:0
		});

		nav.getNiceScroll().resize().hide();
		$('#top').css('position','relative').removeClass('navbar-fixed-top');
		$("#content").css('padding-top', top+'px');
		el.find('.icon-lock').removeClass('icon-lock').addClass('icon-unlock');
	}
	else
	{
		var o = $("#main").offset();
		nav.css({
			position:'fixed',
			top:'40px',
			left: o.left,
		});

		calculateNavigationHeight();

		nav.niceScroll({
			cursorborder: 0,
			cursorcolor: '#555',
			railoffset:{
				top:0,
				left:-2
			}
		});

		nav.getNiceScroll().resize().show();

		$('#top').css('position','fixed').addClass('navbar-fixed-top');
		$("#content").css('padding-top', '40px');
		el.find('.icon-unlock').removeClass('icon-unlock').addClass('icon-lock');
	}

	el.toggleClass('button-active');
}

function toggleFixedLayout(){
	var top = $("#top"),
	main = $("#main"),
	nav = $("#navigation"),
	content = $("#content"),
	func = $(".navi-functions"),
	button = $(".layout-not-fluid");

	main.toggleClass("fixed-layout")
	nav.toggleClass("fixed-layout");
	func.toggleClass("fixed-layout");
	top.find('.container-fluid,.container').toggleClass("container-fluid").toggleClass("container");
	button.toggleClass('button-active');

	var o = main.offset();
	var left = o.left,
	top = 40;
	if(!$(".layout-not-fixed").hasClass("button-active")){
		left = 0;
	}
	if(!$(".layout-not-fixed").hasClass("button-active") && !button.hasClass("button-active")){
		top = 0;
	}
	nav.css({
		left: left,
		top: top
	});
	content.css("padding-top", top);
}

// not needed for ios 5.1+
function setNaviToBottom(){
	// var el = $('.navi-functions'),
	// w = $(window);
	
	// if(navigator.platform == "iPad")
	// {
	// 	el.css({
	// 		position:'absolute',
	// 		top:w.height() - 56 + w.scrollTop(),
	// 		bottom:'auto'
	// 	});
	// }
}

function hideAllSubNavs(){
	$(".mainNav").find('.open > .subnav').slideUp(
		300, 
		'swing',
		function(){
			$('#navigation').getNiceScroll().resize();
		}
		).parent().removeClass('open');
}

$(document).ready(function() {
	var mobile = false,
	tooltipOnlyForDesktop = true;

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
		mobile = true;
	}

	// Navigation expandable
	$(".mainNav > li > a").click(function(e){
		var el 		= $(this),
		parent 	= $(this).parent(),
		ulparent = $(this).parents('.mainNav'),
		nav = $("#navigation");
		if(parent.find('.subnav').length > 0)
		{
			e.preventDefault();
			var subnav = parent.find('.subnav');
			if(parent.hasClass('open'))
			{
				subnav.slideUp(
					300, 
					'swing',
					function(){
						$('#navigation').getNiceScroll().resize();
					}
					);
				parent.removeClass('open');
			}
			else
			{
				if(ulparent.attr("data-open-subnavs") == "single")
				{
					hideAllSubNavs();
				}
				subnav.slideDown(
					300, 
					'swing',
					function(){
						$('#navigation').getNiceScroll().resize();
					}
					);
				parent.addClass("open");
			}
		}

	});

	// task-list
	$(".tasklist > li").click(function(e){
		var el 			= $(this),
		checkbox 	= $(this).find('input[type=checkbox]').first();
		el.toggleClass('done');

		// Bug fix
		if(e.target.nodeName == 'LABEL')
		{
			e.preventDefault();
		}
		
		if(e.target.nodeName != "INPUT")
		{
			checkbox.prop('checked', !(checkbox.prop('checked')));
		}
	});

	$(".tasklist > li > .task-actions > a").click(function(e){
		var el = $(this),
		lielement = $(this).parents('li'),
		ulelement = $(this).parents('ul');
		console.log("action of task clicked")
		e.stopPropagation(); // Prevents the 'done' event
		lielement.toggleClass('bookmarked');

		// removed or added bookmark ?
		if(lielement.hasClass('bookmarked'))
		{
			// Add to top
			lielement.fadeOut(400,function(){
				lielement.prependTo(ulelement).fadeIn();
			});
		}
		else
		{
			// Are there other bookmarks ?
			if(ulelement.find('.bookmarked').length > 0)
			{
				// There are other bookmarks -> insert after last bookmark
				lielement.fadeOut(400,function(){
					lielement.insertAfter(ulelement.find('.bookmarked').last()).fadeIn();
				});
			}
			else
			{
				// No other bookmarks -> to top
				lielement.fadeOut(400,function(){
					lielement.prependTo(ulelement).fadeIn();
				});
			}
		}

	});

	if($('.layout-not-fixed').hasClass('button-active'))
	{
		// Run calculation for navigation
		calculateNavigationHeight();

		// add scroller for navigation
		$("#navigation").niceScroll({
			cursorborder: 0,
			cursorcolor: '#555',
			railoffset:{
				top:0,
				left:-2
			},
			horizrailenabled:false
		});
	}

	// navigation functions
	$('.layout-not-fixed').click(function(e){	
		toggleFixedLayoutNav();

		e.preventDefault();
		e.stopPropagation();
	});

	$(".layout-not-fluid").click(function(e){
		toggleFixedLayout();

		e.preventDefault();
		e.stopPropagation();
	});

	$(".layout-no-nav").click(function(e){
		hideNav();

		e.preventDefault();
		e.stopPropagation();
		if(tooltipOnlyForDesktop)
		{
			if(!mobile)
			{
				$('[rel=tooltip]').tooltip();
			}
		}
	});

	$(".search .dropdown-menu > li").not('.sort-by, .heading').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var el = $(this);
		var parent = el.parents('.dropdown-menu');
		var sortText = parent.find('.sort-by .filter'),
		sortOrder = parent.find('.sort-by .order');
		if(el.hasClass('order'))
		{
			parent.find('.order.active').removeClass('active');

			if($.trim(el.text()) == "Descending")
			{
				sortOrder.html("Z-A");
			}
			else
			{
				sortOrder.html("A-Z");
			}
		}
		else
		{
			parent.find('.filter.active').removeClass('active');
			var cat = $.trim(el.html());
			sortText.html(cat);
		}

		el.toggleClass('active');
	});

	// Freetile
	if($('.gallery-dynamic').length > 0)
	{
		$('.gallery-dynamic').imagesLoaded(function(){
			var el = $(this);
			el.masonry();
		});
	}

	// ipad -> remove fixed navi functions
	setNaviToBottom();

	if($('body').attr("data-layout-width") == "fixed")
	{
		toggleFixedLayout();
	}

	// Layout
	if($('body').attr("data-layout") == "fixed")
	{
		toggleFixedLayoutNav();
	}

	// Check window width for collapsed nav
	collapsedNav();

	$(".accordion").on("hide", function(e){
		var el = $(this),
		target = $(e.target).parents(".accordion-group");
		target.find(".accordion-toggle").addClass('collapsed');
	}).on("show", function(e){
		var el = $(this),
		target = $(e.target).parents(".accordion-group");
		target.find(".accordion-toggle").removeClass('collapsed');
	});

	$("[rel=popover]").popover();

	if($(".ckeditor").length > 0){
		CKEDITOR.replace("ck");
	}
});

$(window).scroll(function(){
	// ipad -> remove fixed navi functions
	setNaviToBottom();
});

$(window).resize(function() {
	// recalculate navigation
	if($('.layout-not-fixed').hasClass('button-active'))
	{
		calculateNavigationHeight();
	}
	$('#navigation').getNiceScroll().resize();

	// recalculate layout
	if(!($('.layout-not-fluid').hasClass('button-active')) && $(window).width() <= 1200)
	{
		toggleFixedLayout();
		$(".layout-not-fluid").addClass("forced");
	}

	if($(window).width() >= 1201)
	{
		if($('.layout-not-fluid').hasClass('forced'))
		{
			toggleFixedLayout();
			$(".layout-not-fluid").removeClass("forced");
		}
	}


	// ipad -> remove fixed navi functions
	setNaviToBottom();

	collapsedNav();
});

