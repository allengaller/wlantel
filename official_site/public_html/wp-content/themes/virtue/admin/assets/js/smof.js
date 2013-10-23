/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function($){
	
	//(un)fold options in a checkbox-group
  	jQuery('.fld').click(function() {
    	var $fold='.f_'+this.id;
    	$($fold).slideToggle('normal', "swing");
  	});

  	//Color picker
  	$('.of-color').wpColorPicker();
	
	//hides warning if js is enabled			
	$('#js-warning').hide();
	
	//Tabify Options			
	$('.group').hide();
	
	// Display last current tab	
	if ($.cookie("of_current_opt") === null) {
		$('.group:first').fadeIn('fast');	
		$('#of-nav li:first').addClass('current');
	} else {
	
		var hooks = $('#hooks').html();
		hooks = jQuery.parseJSON(hooks);
		
		$.each(hooks, function(key, value) { 
		
			if ($.cookie("of_current_opt") == '#of-option-'+ value) {
				$('.group#of-option-' + value).fadeIn();
				$('#of-nav li.' + value).addClass('current');
			}
			
		});
	
	}
				
	//Current Menu Class
	$('#of-nav li a').click(function(evt){
	// event.preventDefault();
				
		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');
							
		var clicked_group = $(this).attr('href');
		
		$.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });
			
		$('.group').hide();
							
		$(clicked_group).fadeIn('fast');
		return false;
						
	});

	//Expand Options 
	var flip = 0;
				
	$('#expand_options').click(function(){
		if(flip == 0){
			flip = 1;
			$('#of_container #of-nav').hide();
			$('#of_container #content').width(755);
			$('#of_container .group').add('#of_container .group h2').show();
	
			$(this).removeClass('expand');
			$(this).addClass('close');
			$(this).text('Close');
					
		} else {
			flip = 0;
			$('#of_container #of-nav').show();
			$('#of_container #content').width(595);
			$('#of_container .group').add('#of_container .group h2').hide();
			$('#of_container .group:first').show();
			$('#of_container #of-nav li').removeClass('current');
			$('#of_container #of-nav li:first').addClass('current');
					
			$(this).removeClass('close');
			$(this).addClass('expand');
			$(this).text('Expand');
				
		}
			
	});
	
	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		this.css("left", 250 );
		return this;
	}
		
			
	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();
			
	$(window).scroll(function() { 
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
	});
			

	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();

	// Style Select
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$('.select').live('change', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		}); 
		}
	};
	$(document).ready(function () {
		styleSelect.init()
	})
	})(jQuery);
	
	
	/** Aquagraphite Slider MOD */
	
	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide(); 

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".slide_edit_button").live( 'click', function(){		
		/*
		//display as an accordion
		$(".slide_header").removeClass("active");	
		$(".slide_body").slideUp("fast");
		*/
		//toggle for each
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});	
	
	// Update slide title upon typing		
	function update_slider_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parent().prev().find('strong').text( element.value );
		}, 100);
		return true;
	}
	
	$('.of-slider-title').live('keyup', function(){
		update_slider_title(this);
	});
		
	
	//Remove individual slide
	$('.slide_delete_button').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li');
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0,
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});
	
	//Add new slide
	$(".slide_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="upload slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '">Upload</span><span class="button remove-image hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		
		slidesContainer.append(newSlide);
		var nSlide = slidesContainer.find('.temphide');
		nSlide.fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});
				
		optionsframework_file_bindings(); // re-initialise upload image..
		
		return false; //prevent jumps, as always..
	});	
	//Add new Sidebar
	$(".sidebar_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Sidebar ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Sidebar Name</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		
		slidesContainer.append(newSlide);
		$('.temphide').fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});
		
		return false; //prevent jumps, as always..
	});
	//Add new icon
		$(".icon_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Icon ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Choose a preset icon</label><select class="select of-input kad_icomoon" name="'+ sliderId +'['+ newNum +'][icon_o] id="'+ sliderId +'_'+ newNum +'_slide_icon" value=""><option value="">Select</option><option value="icon-glass">icon-glass</option><option value="icon-music">icon-music</option><option value="icon-search">icon-search</option><option value="icon-envelope-alt">icon-envelope-alt</option><option value="icon-heart">icon-heart</option><option value="icon-star">icon-star</option><option value="icon-star-empty">icon-star-empty</option><option value="icon-user">icon-user</option><option value="icon-film">icon-film</option><option value="icon-th-large">icon-th-large</option><option value="icon-th">icon-th</option><option value="icon-th-list">icon-th-list</option><option value="icon-ok">icon-ok</option><option value="icon-remove">icon-remove</option><option value="icon-zoom-in">icon-zoom-in</option><option value="icon-zoom-out">icon-zoom-out</option><option value="icon-power-off">icon-power-off</option><option value="icon-off">icon-off</option><option value="icon-signal">icon-signal</option><option value="icon-gear">icon-gear</option><option value="icon-cog">icon-cog</option><option value="icon-trash">icon-trash</option><option value="icon-home">icon-home</option><option value="icon-file-alt">icon-file-alt</option><option value="icon-time">icon-time</option><option value="icon-road">icon-road</option><option value="icon-download-alt">icon-download-alt</option><option value="icon-download">icon-download</option><option value="icon-upload">icon-upload</option><option value="icon-inbox">icon-inbox</option><option value="icon-play-circle">icon-play-circle</option><option value="icon-rotate-right">icon-rotate-right</option><option value="icon-repeat">icon-repeat</option><option value="icon-refresh">icon-refresh</option><option value="icon-list-alt">icon-list-alt</option><option value="icon-lock">icon-lock</option><option value="icon-flag">icon-flag</option><option value="icon-headphones">icon-headphones</option><option value="icon-volume-off">icon-volume-off</option><option value="icon-volume-down">icon-volume-down</option><option value="icon-volume-up">icon-volume-up</option><option value="icon-qrcode">icon-qrcode</option><option value="icon-barcode">icon-barcode</option><option value="icon-tag">icon-tag</option><option value="icon-tags">icon-tags</option><option value="icon-book">icon-book</option><option value="icon-bookmark">icon-bookmark</option><option value="icon-print">icon-print</option><option value="icon-camera">icon-camera</option><option value="icon-font">icon-font</option><option value="icon-bold">icon-bold</option><option value="icon-italic">icon-italic</option><option value="icon-text-height">icon-text-height</option><option value="icon-text-width">icon-text-width</option><option value="icon-align-left">icon-align-left</option><option value="icon-align-center">icon-align-center</option><option value="icon-align-right">icon-align-right</option><option value="icon-align-justify">icon-align-justify</option><option value="icon-list">icon-list</option><option value="icon-indent-left">icon-indent-left</option><option value="icon-indent-right">icon-indent-right</option><option value="icon-facetime-video">icon-facetime-video</option><option value="icon-picture">icon-picture</option><option value="icon-pencil">icon-pencil</option><option value="icon-map-marker">icon-map-marker</option><option value="icon-adjust">icon-adjust</option><option value="icon-tint">icon-tint</option><option value="icon-edit">icon-edit</option><option value="icon-share">icon-share</option><option value="icon-check">icon-check</option><option value="icon-move">icon-move</option><option value="icon-step-backward">icon-step-backward</option><option value="icon-fast-backward">icon-fast-backward</option><option value="icon-backward">icon-backward</option><option value="icon-play">icon-play</option><option value="icon-pause">icon-pause</option><option value="icon-stop">icon-stop</option><option value="icon-forward">icon-forward</option><option value="icon-fast-forward">icon-fast-forward</option><option value="icon-step-forward">icon-step-forward</option><option value="icon-eject">icon-eject</option><option value="icon-chevron-left">icon-chevron-left</option><option value="icon-chevron-right">icon-chevron-right</option><option value="icon-plus-sign">icon-plus-sign</option><option value="icon-minus-sign">icon-minus-sign</option><option value="icon-remove-sign">icon-remove-sign</option><option value="icon-ok-sign">icon-ok-sign</option><option value="icon-question-sign">icon-question-sign</option><option value="icon-info-sign">icon-info-sign</option><option value="icon-screenshot">icon-screenshot</option><option value="icon-remove-circle">icon-remove-circle</option><option value="icon-ok-circle">icon-ok-circle</option><option value="icon-ban-circle">icon-ban-circle</option><option value="icon-arrow-left">icon-arrow-left</option><option value="icon-arrow-right">icon-arrow-right</option><option value="icon-arrow-up">icon-arrow-up</option><option value="icon-arrow-down">icon-arrow-down</option><option value="icon-mail-forward">icon-mail-forward</option><option value="icon-share-alt">icon-share-alt</option><option value="icon-resize-full">icon-resize-full</option><option value="icon-resize-small">icon-resize-small</option><option value="icon-plus">icon-plus</option><option value="icon-minus">icon-minus</option><option value="icon-asterisk">icon-asterisk</option><option value="icon-exclamation-sign">icon-exclamation-sign</option><option value="icon-gift">icon-gift</option><option value="icon-leaf">icon-leaf</option><option value="icon-fire">icon-fire</option><option value="icon-eye-open">icon-eye-open</option><option value="icon-eye-close">icon-eye-close</option><option value="icon-warning-sign">icon-warning-sign</option><option value="icon-plane">icon-plane</option><option value="icon-calendar">icon-calendar</option><option value="icon-random">icon-random</option><option value="icon-comment">icon-comment</option><option value="icon-magnet">icon-magnet</option><option value="icon-chevron-up">icon-chevron-up</option><option value="icon-chevron-down">icon-chevron-down</option><option value="icon-retweet">icon-retweet</option><option value="icon-shopping-cart">icon-shopping-cart</option><option value="icon-folder-close">icon-folder-close</option><option value="icon-folder-open">icon-folder-open</option><option value="icon-resize-vertical">icon-resize-vertical</option><option value="icon-resize-horizontal">icon-resize-horizontal</option><option value="icon-bar-chart">icon-bar-chart</option><option value="icon-twitter-sign">icon-twitter-sign</option><option value="icon-facebook-sign">icon-facebook-sign</option><option value="icon-camera-retro">icon-camera-retro</option><option value="icon-key">icon-key</option><option value="icon-gears">icon-gears</option><option value="icon-cogs">icon-cogs</option><option value="icon-comments">icon-comments</option><option value="icon-thumbs-up-alt">icon-thumbs-up-alt</option><option value="icon-thumbs-down-alt">icon-thumbs-down-alt</option><option value="icon-star-half">icon-star-half</option><option value="icon-heart-empty">icon-heart-empty</option><option value="icon-signout">icon-signout</option><option value="icon-linkedin-sign">icon-linkedin-sign</option><option value="icon-pushpin">icon-pushpin</option><option value="icon-external-link">icon-external-link</option><option value="icon-signin">icon-signin</option><option value="icon-trophy">icon-trophy</option><option value="icon-github-sign">icon-github-sign</option><option value="icon-upload-alt">icon-upload-alt</option><option value="icon-lemon">icon-lemon</option><option value="icon-phone">icon-phone</option><option value="icon-unchecked">icon-unchecked</option><option value="icon-check-empty">icon-check-empty</option><option value="icon-bookmark-empty">icon-bookmark-empty</option><option value="icon-phone-sign">icon-phone-sign</option><option value="icon-twitter">icon-twitter</option><option value="icon-facebook">icon-facebook</option><option value="icon-github">icon-github</option><option value="icon-unlock">icon-unlock</option><option value="icon-credit-card">icon-credit-card</option><option value="icon-rss">icon-rss</option><option value="icon-hdd">icon-hdd</option><option value="icon-bullhorn">icon-bullhorn</option><option value="icon-bell">icon-bell</option><option value="icon-certificate">icon-certificate</option><option value="icon-hand-right">icon-hand-right</option><option value="icon-hand-left">icon-hand-left</option><option value="icon-hand-up">icon-hand-up</option><option value="icon-hand-down">icon-hand-down</option><option value="icon-circle-arrow-left">icon-circle-arrow-left</option><option value="icon-circle-arrow-right">icon-circle-arrow-right</option><option value="icon-circle-arrow-up">icon-circle-arrow-up</option><option value="icon-circle-arrow-down">icon-circle-arrow-down</option><option value="icon-globe">icon-globe</option><option value="icon-wrench">icon-wrench</option><option value="icon-tasks">icon-tasks</option><option value="icon-filter">icon-filter</option><option value="icon-briefcase">icon-briefcase</option><option value="icon-fullscreen">icon-fullscreen</option><option value="icon-group">icon-group</option><option value="icon-link">icon-link</option><option value="icon-cloud">icon-cloud</option><option value="icon-beaker">icon-beaker</option><option value="icon-cut">icon-cut</option><option value="icon-copy">icon-copy</option><option value="icon-paperclip">icon-paperclip</option><option value="icon-paper-clip">icon-paper-clip</option><option value="icon-save">icon-save</option><option value="icon-sign-blank">icon-sign-blank</option><option value="icon-reorder">icon-reorder</option><option value="icon-list-ul">icon-list-ul</option><option value="icon-list-ol">icon-list-ol</option><option value="icon-strikethrough">icon-strikethrough</option><option value="icon-underline">icon-underline</option><option value="icon-table">icon-table</option><option value="icon-magic">icon-magic</option><option value="icon-truck">icon-truck</option><option value="icon-pinterest">icon-pinterest</option><option value="icon-pinterest-sign">icon-pinterest-sign</option><option value="icon-google-plus-sign">icon-google-plus-sign</option><option value="icon-google-plus">icon-google-plus</option><option value="icon-money">icon-money</option><option value="icon-caret-down">icon-caret-down</option><option value="icon-caret-up">icon-caret-up</option><option value="icon-caret-left">icon-caret-left</option><option value="icon-caret-right">icon-caret-right</option><option value="icon-columns">icon-columns</option><option value="icon-sort">icon-sort</option><option value="icon-sort-down">icon-sort-down</option><option value="icon-sort-up">icon-sort-up</option><option value="icon-envelope">icon-envelope</option><option value="icon-linkedin">icon-linkedin</option><option value="icon-rotate-left">icon-rotate-left</option><option value="icon-undo">icon-undo</option><option value="icon-legal">icon-legal</option><option value="icon-dashboard">icon-dashboard</option><option value="icon-comment-alt">icon-comment-alt</option><option value="icon-comments-alt">icon-comments-alt</option><option value="icon-bolt">icon-bolt</option><option value="icon-sitemap">icon-sitemap</option><option value="icon-umbrella">icon-umbrella</option><option value="icon-paste">icon-paste</option><option value="icon-lightbulb">icon-lightbulb</option><option value="icon-exchange">icon-exchange</option><option value="icon-cloud-download">icon-cloud-download</option><option value="icon-cloud-upload">icon-cloud-upload</option><option value="icon-user-md">icon-user-md</option><option value="icon-stethoscope">icon-stethoscope</option><option value="icon-suitcase">icon-suitcase</option><option value="icon-bell-alt">icon-bell-alt</option><option value="icon-coffee">icon-coffee</option><option value="icon-food">icon-food</option><option value="icon-file-text-alt">icon-file-text-alt</option><option value="icon-building">icon-building</option><option value="icon-hospital">icon-hospital</option><option value="icon-ambulance">icon-ambulance</option><option value="icon-medkit">icon-medkit</option><option value="icon-fighter-jet">icon-fighter-jet</option><option value="icon-beer">icon-beer</option><option value="icon-h-sign">icon-h-sign</option><option value="icon-plus-sign-alt">icon-plus-sign-alt</option><option value="icon-double-angle-left">icon-double-angle-left</option><option value="icon-double-angle-right">icon-double-angle-right</option><option value="icon-double-angle-up">icon-double-angle-up</option><option value="icon-double-angle-down">icon-double-angle-down</option><option value="icon-angle-left">icon-angle-left</option><option value="icon-angle-right">icon-angle-right</option><option value="icon-angle-up">icon-angle-up</option><option value="icon-angle-down">icon-angle-down</option><option value="icon-desktop">icon-desktop</option><option value="icon-laptop">icon-laptop</option><option value="icon-tablet">icon-tablet</option><option value="icon-mobile-phone">icon-mobile-phone</option><option value="icon-circle-blank">icon-circle-blank</option><option value="icon-quote-left">icon-quote-left</option><option value="icon-quote-right">icon-quote-right</option><option value="icon-spinner">icon-spinner</option><option value="icon-circle">icon-circle</option><option value="icon-mail-reply">icon-mail-reply</option><option value="icon-reply">icon-reply</option><option value="icon-github-alt">icon-github-alt</option><option value="icon-folder-close-alt">icon-folder-close-alt</option><option value="icon-folder-open-alt">icon-folder-open-alt</option><option value="icon-expand-alt">icon-expand-alt</option><option value="icon-collapse-alt">icon-collapse-alt</option><option value="icon-smile">icon-smile</option><option value="icon-frown">icon-frown</option><option value="icon-meh">icon-meh</option><option value="icon-gamepad">icon-gamepad</option><option value="icon-keyboard">icon-keyboard</option><option value="icon-flag-alt">icon-flag-alt</option><option value="icon-flag-checkered">icon-flag-checkered</option><option value="icon-terminal">icon-terminal</option><option value="icon-code">icon-code</option><option value="icon-reply-all">icon-reply-all</option><option value="icon-mail-reply-all">icon-mail-reply-all</option><option value="icon-star-half-full">icon-star-half-full</option><option value="icon-star-half-empty">icon-star-half-empty</option><option value="icon-location-arrow">icon-location-arrow</option><option value="icon-crop">icon-crop</option><option value="icon-code-fork">icon-code-fork</option><option value="icon-unlink">icon-unlink</option><option value="icon-question">icon-question</option><option value="icon-info">icon-info</option><option value="icon-exclamation">icon-exclamation</option><option value="icon-superscript">icon-superscript</option><option value="icon-subscript">icon-subscript</option><option value="icon-eraser">icon-eraser</option><option value="icon-puzzle-piece">icon-puzzle-piece</option><option value="icon-microphone">icon-microphone</option><option value="icon-microphone-off">icon-microphone-off</option><option value="icon-shield">icon-shield</option><option value="icon-calendar-empty">icon-calendar-empty</option><option value="icon-fire-extinguisher">icon-fire-extinguisher</option><option value="icon-rocket">icon-rocket</option><option value="icon-maxcdn">icon-maxcdn</option><option value="icon-chevron-sign-left">icon-chevron-sign-left</option><option value="icon-chevron-sign-right">icon-chevron-sign-right</option><option value="icon-chevron-sign-up">icon-chevron-sign-up</option><option value="icon-chevron-sign-down">icon-chevron-sign-down</option><option value="icon-html5">icon-html5</option><option value="icon-css3">icon-css3</option><option value="icon-anchor">icon-anchor</option><option value="icon-unlock-alt">icon-unlock-alt</option><option value="icon-bullseye">icon-bullseye</option><option value="icon-ellipsis-horizontal">icon-ellipsis-horizontal</option><option value="icon-ellipsis-vertical">icon-ellipsis-vertical</option><option value="icon-rss-sign">icon-rss-sign</option><option value="icon-play-sign">icon-play-sign</option><option value="icon-ticket">icon-ticket</option><option value="icon-minus-sign-alt">icon-minus-sign-alt</option><option value="icon-check-minus">icon-check-minus</option><option value="icon-level-up">icon-level-up</option><option value="icon-level-down">icon-level-down</option><option value="icon-check-sign">icon-check-sign</option><option value="icon-edit-sign">icon-edit-sign</option><option value="icon-external-link-sign">icon-external-link-sign</option><option value="icon-share-sign">icon-share-sign</option><option value="icon-compass">icon-compass</option><option value="icon-collapse">icon-collapse</option><option value="icon-collapse-top">icon-collapse-top</option><option value="icon-expand">icon-expand</option><option value="icon-euro">icon-euro</option><option value="icon-eur">icon-eur</option><option value="icon-gbp">icon-gbp</option><option value="icon-dollar">icon-dollar</option><option value="icon-usd">icon-usd</option><option value="icon-rupee">icon-rupee</option><option value="icon-inr">icon-inr</option><option value="icon-yen">icon-yen</option><option value="icon-jpy">icon-jpy</option><option value="icon-renminbi">icon-renminbi</option><option value="icon-cny">icon-cny</option><option value="icon-won">icon-won</option><option value="icon-krw">icon-krw</option><option value="icon-bitcoin">icon-bitcoin</option><option value="icon-btc">icon-btc</option><option value="icon-file">icon-file</option><option value="icon-file-text">icon-file-text</option><option value="icon-sort-by-alphabet">icon-sort-by-alphabet</option><option value="icon-sort-by-alphabet-alt">icon-sort-by-alphabet-alt</option><option value="icon-sort-by-attributes">icon-sort-by-attributes</option><option value="icon-sort-by-attributes-alt">icon-sort-by-attributes-alt</option><option value="icon-sort-by-order">icon-sort-by-order</option><option value="icon-sort-by-order-alt">icon-sort-by-order-alt</option><option value="icon-thumbs-up">icon-thumbs-up</option><option value="icon-thumbs-down">icon-thumbs-down</option><option value="icon-youtube-sign">icon-youtube-sign</option><option value="icon-youtube">icon-youtube</option><option value="icon-xing">icon-xing</option><option value="icon-xing-sign">icon-xing-sign</option><option value="icon-youtube-play">icon-youtube-play</option><option value="icon-dropbox">icon-dropbox</option><option value="icon-stackexchange">icon-stackexchange</option><option value="icon-instagram">icon-instagram</option><option value="icon-flickr">icon-flickr</option><option value="icon-adn">icon-adn</option><option value="icon-bitbucket">icon-bitbucket</option><option value="icon-bitbucket-sign">icon-bitbucket-sign</option><option value="icon-tumblr">icon-tumblr</option><option value="icon-tumblr-sign">icon-tumblr-sign</option><option value="icon-long-arrow-down">icon-long-arrow-down</option><option value="icon-long-arrow-up">icon-long-arrow-up</option><option value="icon-long-arrow-left">icon-long-arrow-left</option><option value="icon-long-arrow-right">icon-long-arrow-right</option><option value="icon-apple">icon-apple</option><option value="icon-windows">icon-windows</option><option value="icon-android">icon-android</option><option value="icon-linux">icon-linux</option><option value="icon-dribbble">icon-dribbble</option><option value="icon-skype">icon-skype</option><option value="icon-foursquare">icon-foursquare</option><option value="icon-trello">icon-trello</option><option value="icon-female">icon-female</option><option value="icon-male">icon-male</option><option value="icon-gittip">icon-gittip</option><option value="icon-sun">icon-sun</option><option value="icon-moon">icon-moon</option><option value="icon-archive">icon-archive</option><option value="icon-bug">icon-bug</option><option value="icon-vk">icon-vk</option><option value="icon-weibo">icon-weibo</option><option value="icon-renren">icon-renren</option></select><label><br />Or upload your own icon.</label><input class="upload slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '">Upload</span><span class="button remove-image hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

		slidesContainer.append(newSlide);
		$('.temphide').fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});
				
		optionsframework_file_bindings(); // re-initialise upload image..
		  function format(icon) {
			return '<span class="kad_icomoon"><i class="' + icon.id + '"></i>' + icon.text + '</span>';
		  }
		  $('select.kad_icomoon').select2({
			formatResult: format,
			formatSelection: format
		  });

		
		return false; //prevent jumps, as always..
	});
	
	//Sort slides
	jQuery('.slider').find('ul').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).sortable({
			placeholder: "placeholder",
			opacity: 0.6,
			handle: ".slide_header",
			cancel: "a"
		});	
	});
	
	
	/**	Sorter (Layout Manager) */
	jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {

					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');

				});
			}
		});	
	});
	
	
	/**	Ajax Backup & Restore MOD */
	//backup button
	$('#of_backup_button').live('click', function(){
	
		var answer = confirm("Click OK to backup your current saved options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
							
				//check nonce
				if(response==-1){ //failed
								
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
							
				else {
							
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
							
			});
			
		}
		
	return false;
					
	}); 
	
	//restore button
	$('#of_restore_button').live('click', function(){
	
		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
			
				//check nonce
				if(response==-1){ //failed
								
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
							
				else {
							
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}	
						
			});
	
		}
	
	return false;
					
	});
	
	/**	Ajax Transfer (Import/Export) Option */
	$('#of_import_button').live('click', function(){
	
		var answer = confirm("Click OK to import options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
			
			var import_data = $('#export_data').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};
						
			$.post(ajaxurl, data, function(response) {
				var fail_popup = $('#of-popup-fail');
				var success_popup = $('#of-popup-save');
				
				//check nonce
				if(response==-1){ //failed
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}		
				else 
				{
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
							
			});
			
		}
		
	return false;
					
	});
	
	/** AJAX Save Options */
	$('#of_save').live('click',function() {

		var nonce = $('#security').val();

		$('.ajax-loading-img').fadeIn();

		//get serialized data from all our option fields			
		var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();

		$('#of_form :input[type=checkbox]').each(function() {     
		    if (!this.checked) {
		        serializedReturn += '&'+this.name+'=0';
		    }
		});

		var data = {
			type: 'save',
			action: 'of_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};

		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  

			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}

			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});

	return false; 

	});   

	
	
	/* AJAX Options Reset */	
	$('#of_reset').click(function() {
		
		//confirm reset
		var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");
		
		//ajax reset
		if (answer){
			
			var nonce = $('#security').val();
						
			$('.ajax-reset-loading-img').fadeIn();
							
			var data = {
			
				type: 'reset',
				action: 'of_ajax_post_action',
				security: nonce,
			};
						
			$.post(ajaxurl, data, function(response) {
				var success = $('#of-popup-reset');
				var fail = $('#of-popup-fail');
				var loading = $('.ajax-reset-loading-img');
				loading.fadeOut();  
							
				if (response==1)
				{
					success.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				} 
				else 
				{ 
					fail.fadeIn();
					window.setTimeout(function(){
						fail.fadeOut();				
					}, 2000);
				}
							

			});
			
		}
			
	return false;
		
	});


	/**	Tipsy @since v1.3 */
	if (jQuery().tipsy) {
		$('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.7,
		});
	}
	
	
	/**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery('.smof_sliderui').each(function() {
		
		var obj   = jQuery(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));
		
		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			range: "min",
			slide: function( event, ui ) {
				jQuery(sId).val( ui.value );
			}
		});
		
	});


	/**
	  * Switch
	  * Dependencies 	 : jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery(".cb-enable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-disable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', true);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideDown('normal', "swing");
	});
	jQuery(".cb-disable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-enable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', false);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideUp('normal', "swing");
	});
	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if (($.browser.msie && $.browser.version < 10) || $.browser.opera) { 
		$('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
	}
	
	
	/**
	  * Google Fonts
	  * Dependencies 	 : google.com, jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	function GoogleFontSelect( slctr, mainID ){
		
		var _selected = $(slctr).val(); 						//get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';
		
		if( _selected ){ //if var exists and isset

			$('.'+ _previewer ).fadeIn();
			
			//Check if selected is not equal with "Select a font" and execute the script.
			if ( _selected !== 'none' && _selected !== 'Select a font' && _selected !== 'Verdana' ) {
				
				//remove other elements crested in <head>
				$( '.'+ _linkclass ).remove();
				
				//replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');
				
				//add reference to google font family
				$('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
				
				//show in the preview box the font
				$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );
				
			}else{
				
				//if selected is not a font remove style "font-family" at preview box
				$('.'+ _previewer ).css('font-family', '' );
				$('.'+ _previewer ).fadeOut();
				
			}
		
		}
	
	}
	
	//init for each element
	jQuery( '.google_font_select' ).each(function(){ 
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});
	
	//init when value is changed
	jQuery( '.google_font_select' ).change(function(){ 
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});


	/**
	  * Media Uploader
	  * Dependencies 	 : jquery, wp media uploader
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 05.28.2013
	  */
	function optionsframework_add_file(event, selector) {
	
		var upload = $(".uploaded-file"), frame;
		var $el = $(this);

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),

			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: $el.data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: false
			}
		});

		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			frame.close();
			selector.find('.upload').val(attachment.attributes.url);
			if ( attachment.attributes.type == 'image' ) {
				selector.find('.screenshot').empty().hide().append('<img class="of-option-image" src="' + attachment.attributes.url + '">').slideDown('fast');
			}
			selector.find('.media_upload_button').unbind();
			selector.find('.remove-image').show().removeClass('hide');//show "Remove" button
			selector.find('.of-background-properties').slideDown();
			optionsframework_file_bindings();
		});

		// Finally, open the modal.
		frame.open();
	}
    
	function optionsframework_remove_file(selector) {
		selector.find('.remove-image').hide().addClass('hide');//hide "Remove" button
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind();
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.media_upload_button').remove();
		}
		optionsframework_file_bindings();
	}
	
	function optionsframework_file_bindings() {
		$('.remove-image, .remove-file').on('click', function() {
			optionsframework_remove_file( $(this).parents('.section-upload, .section-media, .slide_body') );
        });
        
        $('.media_upload_button').unbind('click').click( function( event ) {
        	optionsframework_add_file(event, $(this).parents('.section-upload, .section-media, .slide_body'));
        });
    }
    
    optionsframework_file_bindings();

	
	

}); //end doc ready