/*------------------------------------------------
| Store and retrieve PAGES_BY param
------------------------------------------------*/
if (localStorage['pages_by'] != 'undefined') {
	var pages_by = localStorage['pages_by'];
	var $options = $('#pages_by option');
	$options.each(function(index) {
		if ($(this).val() == pages_by) {
			$(this).attr("selected", "selected");
		} 
	});
} else {
	var $option = $('#pages_by').find('option:selected');
	var pages_by = $option.val();
	localStorage['pages_by'] = pages_by;
}

$('#pages_by').on('change', function() {
	var $option = $(this).find('option:selected');
	var pages_by = $option.val();				
	localStorage['pages_by'] = pages_by;
	var link = $option.data('link');
	window.location = link;
});


// FIXED SIDEBARS
$(window).load(function() {
	var $window = $(window);
	var $left_sidebar = $('.left_sidebar');
	var $right_sidebar = $('.right_sidebar');

	var offset_top = $left_sidebar.offset().top;
	var $body = $('body');
	var page_height = $body.height();
	var sidebar_height = $left_sidebar.height();

	var max = page_height - sidebar_height - 111;
	$window.on('scroll', function() { 
		var scroll = $window.scrollTop();
		// was max-342 +30
		if (scroll > offset_top && scroll < max-42) {
			$left_sidebar.clearQueue().animate({
				'margin-top' : scroll-offset_top + 10
			});
			$right_sidebar.clearQueue().animate({
				'margin-top' : scroll-offset_top + 10
			});
		} else if (scroll < offset_top) {
			$left_sidebar.clearQueue().animate({
				'margin-top' : '0px'
			});
			$right_sidebar.clearQueue().animate({
				'margin-top' : '0px'
			});
		} else if (scroll > max-342) {
			$left_sidebar.clearQueue().animate({
				'margin-top' : max-342+'px'
			});
			$right_sidebar.clearQueue().animate({
				'margin-top' : max-342+'px'
			});
		}
	});	
});	

$('.close_message').click(function() {
	$('.message').css('display','none')
});
$subcategories = $('.subcategory_block');
$categories = $('.catalog_category');
$categories.on('click', function() {
	var clicked_category_data = $(this).data('category');
	var $clicked_subcategory = $subcategories.filter(function(index) {
		return $(this).data('category') === clicked_category_data;
	});

	// CHANGE BACKGROUND
	var clicked_category_data = $(this).data('category');
	if (clicked_category_data == 'Механическое_en'|| clicked_category_data=='Механическое_ru') {
		$(".main_content").css({'background-image' : 'url(../img/markup/background_mechan.png)',
								'background-repeat': 'no-repeat',
								'background-position' : 'bottom left'
							});
	} else if(clicked_category_data == 'Тепловое_en' || clicked_category_data == 'Тепловое_ru') {
		$(".main_content").css({'background-image' : 'url(../img/markup/background_teplovoe.png)',
								'background-repeat': 'no-repeat',
								'background-position' : 'bottom left'
							});
		}else if(clicked_category_data == 'Холодильное_en' || clicked_category_data == 'Холодильное_ru') {
			$(".main_content").css({'background-image' : 'url(../img/markup/background_holod.png)',
								'background-repeat': 'no-repeat',
								'background-position' : 'bottom left'
							});
			}else if(clicked_category_data == 'Моечное_en' || clicked_category_data == 'Моечное_ru') {
				$(".main_content").css({'background-image' : 'url(../img/markup/background_posuda.png)',
								'background-repeat': 'no-repeat',
								'background-position' : 'bottom left'
							});
				}
});				

/*------------------------------------------------
| SCROLL TO TOP BUTTON
------------------------------------------------*/
$('#scrollup').mouseover(function(){
	$(this).animate({opacity: 0.65},100);
}).mouseout( function(){
	$(this).animate({opacity: 1},100);
}).click(function(){
	window.scroll(0,0); 
	return false;
});

$(window).load(function() {
	var $window = $(window);
	var $left_sidebar = $('.left_sidebar');
	var $right_sidebar = $('.right_sidebar');

	var offset_top = $left_sidebar.offset().top;
	var $body = $('body');
	var page_height = $body.height();
	var sidebar_height = $left_sidebar.height();
	var max = page_height - sidebar_height - 111;

	$(window).scroll(function(){
		var scroll = $window.scrollTop();

		if (scroll > max) {
			$('#scrollup').css('bottom', '140px');
		} else {
			$('#scrollup').css('bottom', '10px');
		}

		if ($(document).scrollTop() > 0) {
			$('#scrollup').fadeIn('fast');
		} else {
			$('#scrollup').fadeOut('fast');
		}
	});
});

//ADD TO CART
$('.js_item_add').on('click', function(e) {
	e.preventDefault();
});
$('.js_item_remove').on('click', function(e) {
	e.preventDefault();
});

//ODER FORM
$('.pay_radio').click(function() {
	if($('#physic').is(':checked')) {
		$('.requisites').slideUp();
		if ($('#delivery').val() !== 'seld') {
			$('.address').slideDown();
		}
	} else {
		$('.address').slideUp();
		$('.requisites').slideDown();
	}
});
$('#delivery').on('change', function() {
	$value = $(this).val();
	console.log($value);
	if ($value !== 'self' && $('#physic').is(':checked')) {
		$('.address').slideDown();
	} else {
		$('.address').slideUp();
	}
	if ($value === 'Other') {
		$('.delivery_other').slideDown();
	} else {
		$('.delivery_other').slideUp();
	}
})