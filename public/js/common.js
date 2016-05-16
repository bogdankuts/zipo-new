/*------------------------------------------------
| SUBCATEGORIES
------------------------------------------------*/
$subcategories = $('.subcategory_block');
$categories = $('.catalog_category');
HIDING = false;
// UNDERLINE ACTIVE
$($categories).click(function() {
	$(".main_content").find(".active_cat").removeClass("active_cat");
  	$(this).children('.catalog_category_heading').addClass('active_cat');
 });

$categories.on('click', function() {
	var clicked_category_data = $(this).data('category');
	var $clicked_subcategory = $subcategories.filter(function(index) {
		return $(this).data('category') === clicked_category_data;
	});

	// // CHANGE BACKGROUND
	// var clicked_category_data = $(this).data('category');
	// if (clicked_category_data == 'Механическое_en'|| clicked_category_data=='Механическое_ru') {
	// 	$(".main_content").css({'background-image' : 'url(../img/markup/background_mechan.png)',
	// 							'background-repeat': 'no-repeat',
	// 							'background-position' : 'bottom left'
	// 						});
	// } else if(clicked_category_data == 'Тепловое_en' || clicked_category_data == 'Тепловое_ru') {
	// 	$(".main_content").css({'background-image' : 'url(../img/markup/background_teplovoe.png)',
	// 							'background-repeat': 'no-repeat',
	// 							'background-position' : 'bottom left'
	// 						});
	// 	}else if(clicked_category_data == 'Холодильное_en' || clicked_category_data == 'Холодильное_ru') {
	// 		$(".main_content").css({'background-image' : 'url(../img/markup/background_holod.png)',
	// 							'background-repeat': 'no-repeat',
	// 							'background-position' : 'bottom left'
	// 						});
	// 		}else if(clicked_category_data == 'Посудомоечное_en' || clicked_category_data == 'Посудомоечное_ru') {
	// 			$(".main_content").css({'background-image' : 'url(../img/markup/background_posuda.png)',
	// 							'background-repeat': 'no-repeat',
	// 							'background-position' : 'bottom left'
	// 						});
	// 			}
		

	// DETECT IF IT NEEDS HIDING DELAY
	$.each($subcategories, function(index, value) {
		if ($(this).css('display') != 'none') {
			HIDING = true;
		}
	});

	// HIDE ALL ANYWAY
	$subcategories.clearQueue().slideUp();

	// SLIDE DOWN ONLY IF CLIKED WASN'T SHOWN ALREADY
	if ($clicked_subcategory.css('display') == 'none') {
		if (HIDING) {
			$clicked_subcategory.clearQueue().delay(400).slideDown();
		} else {
			$clicked_subcategory.clearQueue().slideDown();						
		}
	}

	HIDING = false;						
});

// MAGNIFIC POPUP
//if ($('.login_button').length) {
//	$('.login_button').magnificPopup({
//		items: {
//			src: '.header_login', // CSS selector of an element on page that should be used as a popup
//			type: 'inline'
//		},
//		removalDelay: 500, //delay removal by X to allow out-animation
//		callbacks: {
//			beforeOpen: function() {
//				this.st.mainClass = this.st.el.attr('data-effect');
//			}
//		},
//	});
//}
//
//// admin add subcategory
//	$('.admin_one_cat_add').magnificPopup({
//		items: {
//			src: '.admin_add_subcategory_div', // CSS selector of an element on page that should be used as a popup
//			type: 'inline'
//		},
//	});
//
//
//// admin add producer
//	$('.admin_producer_add').magnificPopup({
//		items: {
//			src: '.adm_add_pr_div', // CSS selector of an element on page that should be used as a popup
//			type: 'inline'
//		},
//	});




// VALIDATE INPUT
function validate(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode( key );
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) {
	theEvent.returnValue = false;
	if(theEvent.preventDefault) theEvent.preventDefault();
	}
}


/*------------------------------------------------
| Store and retrieve SORT param
------------------------------------------------*/
if (localStorage['sort'] != 'undefined') {
	var sort = localStorage['sort'];
	var $options = $('#items_sort option');
	$options.each(function(index) {
		if ($(this).val() == sort) {
			$(this).attr("selected", "selected");
		} 
	});
} else {
	var $option = $('#items_sort').find('option:selected');
	var sort = $option.val();
	localStorage['sort'] = sort;
}

$('#items_sort').on('change', function() {
	var $option = $(this).find('option:selected');
	var sort = $option.val();				
	localStorage['sort'] = sort;
	var link = $option.data('link');
	window.location = link;
});

/*------------------------------------------------
| SCROLL TO TOP BUTTON
------------------------------------------------*/
//$('#scrollup').mouseover(function(){
//	$(this).animate({opacity: 0.65},100);
//}).mouseout( function(){
//	$(this).animate({opacity: 1},100);
//}).click(function(){
//	window.scroll(0,0); 
//	return false;
//});


/*----------------------------------------------*/