//CKEDITOR EMBED
if ($('#ckeditor').length) {
	CKEDITOR.replace('ckeditor', {
		filebrowserBrowseUrl 	   : '../kcfinder/browse.php?opener=ckeditor&type=files',
		filebrowserImageBrowseUrl  : '../kcfinder/browse.php?opener=ckeditor&type=images',
		filebrowserFlashBrowseUrl  : '../kcfinder/browse.php?opener=ckeditor&type=flash',
		filebrowserUploadUrl  	   : '../kcfinder/upload.php?opener=ckeditor&type=files',
		filebrowserImageUploadUrl  : '../kcfinder/upload.php?opener=ckeditor&type=images',
		filebrowserFlashUploadUrl  : '../kcfinder/upload.php?opener=ckeditor&type=flash',
		// uiColor: '#702329'
		// toolbar : [
		// ['ajaxsave'],
		// ['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
		// ['Cut','Copy','Paste','PasteText'],
		// ['Undo','Redo','-','RemoveFormat'],
		// ['TextColor','BGColor'],
		// ['Maximize', 'Image']
		// ],
	});
}


////RUN SUBCATEGORIES FROM SELECT
//// INITIAL SET SUBCATS
//if ($('#category').length) {
//	if (true != $('.subcat_input').data('old-input')) {
//		send_category($('#category').val());
//	}
//
//	$('#category').on('change', function() {
//		send_category($('#category').val());
//	});
//}
//// INITIAL SET SUBCATS
//var $selects = $('.category_input');
//if ($('.category_input').length) {
//	for (var i=0; i<$selects.length; i++){
//		send_category($selects.eq(i).val(), i);
//	}
//
//	$('.category_input').on('change', function() {
//		send_category($('.category_input').val());
//	});
//}
//
//function send_category(category, number) {
//	$.ajax({
//		url: location.origin+'/admin/ajax-get-subcategories',
//		type: 'POST',
//		dataType: "json",
//		data: {
//			'category' : category
//		},
//		success: function(data) {
//			$select = $('#subcat_id');
//			// CLEAR OLD SUBCATS
//			$select.html('');
//
//			for (var i=0; i<data.length; i++) {
//				var subcat = data[i]['subcat'];
//				var subcat_id = data[i]['subcat_id'];
//
//				var $option = $("<option value='"+subcat_id+"'>"+subcat+"</option>");
//				$select.append($option);
//			}
//
//			/*------------------------------------------------
//			| Select needed option
//			------------------------------------------------*/
//			var subcat_id = $('#subcat_id').data('id');
//			$('#subcat_id').val(subcat_id);
//
//			if(number) {
//				var $subcat = $('.subcat_input').eq(number);
//				// CLEAR OLD SUBCATS
//				$subcat.html('');
//
//				for (var i=0; i<data.length; i++) {
//					var subcat = data[i]['subcat'];
//					var subcat_id = data[i]['subcat_id'];
//
//					var $option = $("<option value='"+subcat_id+"'>"+subcat+"</option>");
//					$subcat.append($option);
//				}
//
//				/*------------------------------------------------
//				| Select needed option
//				------------------------------------------------*/
//				var subcat_id = $subcat.data('id');
//				$subcat.val(subcat_id);
//
//			}
//
//			// $('[name=options] option').filter(function() {
//			//     return ($(this).text() == 'Blue'); //To select Blue
//			// }).prop('selected', true);
//		},
//		error: function(data, error, error_details){
//			console.log("err:",error, error_details);
//			console.log(data);
//		}
//	});
//}

//DELETE ICON FORM SUBMIT
$('.delete_items_group_icon').on('click', function(evt) {
	evt.preventDefault();
	if (confirm('Подтвердить удаление')) {
		$form = $(this).closest('form');
		$form.trigger('submit');
	} else {
		return false;
	}
});


//DELETE PDF ICON FORM SUBMIT
$('.del_pdf').on('click', function(evt) {
	evt.preventDefault();
	if (confirm('Подтвердить удаление')) {
		$form = $(this).closest('form');
		$form.trigger('submit');
	} else {
		return false;
	}
});


//// CLEAR ITEM BUTTON
//$('.clear_item_button').on('click', function(e) {
//	e.preventDefault();
//	var $form = $('.update_item_form');
//	$form.find('input[name="title"]').val("");
//	$form.find('input[name="code"]').val("");
//	$form.find('select[name="category"]').val("Механическое_en");
//	send_category("Механическое_en");
//	var first_p = $form.find('select[name="producer_id"] option').eq(0).val();
//	$form.find('select[name="producer_id"]').val(first_p);
//	$form.find('input[name="price"]').val("");
//	$form.find('input[name="currency"]').val("РУБ");
//	$form.find('input[name="procurement"]').prop("checked", true)
//	$form.find('textarea[name="description"]').val("");
//	$form.find('input[name="special"]').prop("checked", false)
//	$form.find('input[name="hit"]').prop("checked", false)
//});


// CLEAR ARTICLE BUTTON
$('.article_clean').on('click', function(e) {
	e.preventDefault();
	var $form = $('.article_update_form');
	$form.find('input[name="title"]').val("");
	$form.find('input[name="weight"]').val("");
	// $form.find('textarea[name="body"]').val("");
	CKEDITOR.instances.editor1.setData('');
});


//CHANGE SELECT DEPENDING ON CATEGORY
$('.admin_one_cat_add').on('click', function() {
	var category = $(this).data('category');
	$('.create_category').val(category);
});


//$('.add_img').click(function(e){
//	e.preventDefault();
//	console.log($(this).closest('.browse_img_admin'));
//	$(this).closest('.browse_img_admin').trigger('click');
//});

//$(function() {
//	$('#fileupload').fileupload({
//		dataType: 'json',
//		// add: function (e, data) {
//		// 	data.context = $('<button/>').text('Upload')
//		// 		.appendTo(document.body)
//		// 			.click(function () {
//		// 				data.context = $('<p/>').text('Uploading...').replaceAll($(this));
//		// 				data.submit();
//		// 			});
//		// },
//		// progressall: function (e, data) {
//		//        var progress = parseInt(data.loaded / data.total * 100, 10);
//		//        $('#progress .bar').css(
//		//            'width',
//		//            progress + '%'
//		//        );
//		//    },
//		done: function (e, data) {
//			filename = data.result;
//			var timestamp = new Date().getTime();
//			var $input = $('.inserted_input');
//			$input.val(filename);
//			var $delete_icon = $('<i class="fa fa-times delete_img_icon_ajax"></i>');
//			var $img = $('.items_item_img');
//
//			$('.delete_img_icon_ajax').remove();
//			$('.inserted_input').remove();
//			$('.browse_img_admin').after($input);
//			$img.after($delete_icon);
//			$img.attr('src', location.origin+'/img/photos/'+filename+'?no_cache='+timestamp);
//
//			delegateDeleteEvent();
//		}
//	});
//});


/*------------------------------------------------
| AJAX DELETE FILE FROM SERVER
------------------------------------------------*/
// function deleteFileFromServer(filepath) {
// 	$.ajax({
// 		url: location.origin+'/delete_file_from_server',
// 		type: 'POST',
// 		dataType: "json",
// 		data: {
// 			'filepath' : filepath
// 		},
// 		success: function(data) {
// 			// console.log(data);
// 		},
// 		error: function(data, error, error_details){
// 			console.log("err:",error, error_details);
// 			console.log(data);
// 		}
// 	});
// }


////COUNT CHEKED
//function countChecked($num, $str1, $str2, $str3) {
//	$val = $num % 100;
//
//	if ($val > 10 && $val < 20) {
//		return $num+' '+$str3;
//	} else {
//		$val = $num % 10;
//		if ($val == 1) {
//			return $num+' '+$str1;
//		} else if ($val > 1 && $val < 5) {
//			return $num+' '+$str2;
//		} else {
//			return $num+' '+$str3;
//		}
//	}
//}
//
//var message = countChecked(0, 'элемент', 'элемента', 'элементов');
//$(".selected_quantity").text('Выбрано: '+message);
//$(".admin_items_footer .admin_footer_btn").attr('disabled');
//
//$( ".admin_main_content_items input[type=checkbox]" ).on("click", function() {
//	var n = $(".admin_main_content_items input:checked").length;
//	var message = countChecked(n, 'элемент', 'элемента', 'элементов');
//	$(".selected_quantity").text('Выбрано: '+message);
//
//	if (n == 0) {
//		$(".admin_uni_button").addClass('disabled');
//	} else {
//		$(".admin_uni_button").removeClass('disabled');
//	}
//});
//
//
////GET CHECKED IDS
//IDS = [];
//$(".admin_main_content_items input[type=checkbox]").on("change", function(){
//	var checkedID = $(this).data("id");
//	IDS.push(checkedID);
//});
//
//
///*------------------------------------------------
//| ATTACH TO PDF BUTTON
//------------------------------------------------*/
//// $('.add_to_pdf').on('click', function(e) {
//// 	e.preventDefault();
//// 	var subcat_id = $('.admin_select_title_text').val();
//// 	if (subcat_id < 1) {
//// 		alert('Вы должны создать подкатегорию!');
//// 		return false;
//// 	} else {
//// 		$.ajax({
//// 			url: location.origin+'/admin/ajax_change_subcat',
//// 			type: 'POST',
//// 			dataType: "json",
//// 			data: {
//// 				'ids' 		: IDS,
//// 				'subcat_id'	: subcat_id
//// 			},
//// 			success: function(data) {
//// 				location.reload();
//// 			},
//// 			error: function(data, error, error_details){
//// 				console.log("err:",error, error_details);
//// 				console.log(data);
//// 				console.log(JSON.stringify(data.responseText, '\\', ''));
//// 			}
//// 		});
//// 	}
//// });
///*----------------------------------------------*/
//
////CHANGE SUBCAT BUTTON
//$('.change_subcat_button').on('click', function(e) {
//	e.preventDefault();
//	var subcat_id = $('.admin_select_title_text').val();
//	if (subcat_id < 1) {
//		alert('Вы должны создать подкатегорию!');
//		return false;
//	} else {
//		$.ajax({
//			url: location.origin+'/admin/ajax_change_subcat',
//			type: 'POST',
//			dataType: "json",
//			data: {
//				'ids' 		: IDS,
//				'subcat_id'	: subcat_id
//			},
//			success: function(data) {
//				location.reload();
//			},
//			error: function(data, error, error_details){
//				console.log("err:",error, error_details);
//				console.log(data);
//				console.log(JSON.stringify(data.responseText, '\\', ''));
//			}
//		});
//	}
//});
//
//
////CHANGE PDF BUTTON
//$('.change_item_pdf').on('click', function(e) {
//	var pdf_id = $('.admin_select_pdf').val();
//	$.ajax({
//		url: location.origin+'/admin/ajax_change_pdf',
//		type: 'POST',
//		dataType: "json",
//		data: {
//			'ids' 		: IDS,
//			'pdf_id'	: pdf_id
//		},
//		success: function(data) {
//			location.reload();
//		},
//		error: function(data, error, error_details){
//			console.log("err:",error, error_details);
//			console.log(data);
//			console.log(JSON.stringify(data.responseText, '\\', ''));
//		}
//	});
//});
//
//
////DELETE GROUP BUTTON
//$('.delete_group_button').on('click', function(e) {
//	e.preventDefault();
//
//	function ajax_delete_group() {
//		$.ajax({
//			url: location.origin+'/admin/ajax_delete_group',
//			type: 'POST',
//			dataType: "json",
//			data: {
//				'ids' : IDS,
//			},
//			success: function(data) {
//				location.reload();
//			},
//			error: function(data, error, error_details){
//				console.log("err: ",error, error_details);
//				console.log(data);
//				console.log(JSON.stringify(data.responseText, '\\', ''));
//			}
//		});
//	}
//
//	if (confirm('Подтвердить удаление')) {
//		ajax_delete_group();
//	} else {
//		return false;
//	}
//});
//
//
////CHANGE HIT SPECAIL PROCUREMENT
//$('.ajax_change_state').on('click', function(e) {
//	e.preventDefault();
//	var url = $(this).data('url');
//
//	$.ajax({
//		url: location.origin+url,
//		type: 'POST',
//		dataType: "json",
//		data: {
//			'ids' : IDS,
//		},
//		success: function(data) {
//			location.reload();
//		},
//		error: function(data, error, error_details){
//			console.log("err: ",error, error_details);
//			console.log(data);
//			console.log(JSON.stringify(data.responseText, '\\', ''));
//		}
//	});
//});


//EXCEL IMPORT
$('form.admin_panel_import input[type="file"]').on('click', function() {
	var filepath = $(this).val();
	var index = filepath.lastIndexOf("\\");
	console.log(index);
});


//RUN CONTSCT FROM BUTTON
$('.contact_form_button').on('click', function(evt) {
	evt.preventDefault();
	var contactFormTag = $('#bcf-trigger')[0];

	if ('click' in contactFormTag) {
		contactFormTag.click();
	} else { // doesn't work with $('#bcf-trigger')[0].click() in Safari
		var evObj = document.createEvent('MouseEvents');
		evObj.initMouseEvent('click', true, true, window);
		contactFormTag.dispatchEvent(evObj);
	}

	// if (typeof contactFormTag.click != 'undefined') {} // should work fine
	// if (contactFormTag.hasOwnProperty('click')) {} // not own property!

	// return false; // doesn't work even in IE11 and Mozilla with dispatchEvent() but fine with just click()
});


/*------------------------------------------------
| CHANGE LONG SUBCATS FONT
------------------------------------------------*/
// // var $val = $('.admin_subcategory').text();
// $('.admin_subcategory').each(function () {
// 	$val = $.trim($(this).text());
// 	var $quantity = $val.length;
// 	// console.log($val);
// 	if ($quantity > 30) {
// 		$(this).css({
// 			// 'font-size': '12px',
// 			'max-width': '270px'
// 		});
// 	};

// })
/*------------------------------------------------
| AUTOCOMPLETE
------------------------------------------------*/
// $(".js_autocomplete" ).autocomplete({
// 	source: PRODUCERS_TITLES,
// });

// function getKey(object, value) {
//   for(var key in object){
//     if(object[key] == value){
//       return key;
//     }
//   }
//   return null;
// };
/*------------------------------------------------
| CHECK Producer
------------------------------------------------*/
// var $form = $('.admin_panel_import_pdf');

// $form.find('input[type="submit"]').on('click', function(evt) {
// 	evt.preventDefault();
// 	var producer = $('.js_autocomplete').val();
// 	var key = getKey(PRODUCERS, producer);

// 	if (key) {
// 		$form.trigger('submit');
// 	} else {
// 		alert('Название производителя введено неправильно!');
// 		return false;
// 	}
// });


//Category = {
//	run : function () {
//		var categories = $('.js_select_category');
//		for (var i=0; i<categories.length; i++) {
//			var $category = $(categories[i]);
//			$category.on('change', Category.change);
//			$category.change();
//
//			var category = $category.data('id');
//			$category.closest('form').find('.js_select_subcat').val(subcat_id);
//		}
//	},
//	change : function () {
//		var current = $(this).val();
//		for (category in CATEGORIES) {
//			if (current == category) {
//				var subcats = CATEGORIES[category];
//			}
//		}
//		var $options = [];
//
//		if ('other' == current) {
//			$options.push($("<option value='0'>Не указано</option>"));
//		} else {
//			for (i = 0; i<subcats.length; i++) {
//				var subcat = subcats[i];
//				$options.push($("<option value="+subcat.subcat_id+">"+subcat.subcat+"</option>"));
//			};
//		}
//
//		$(this).closest('form').find('.js_select_subcat').html($options);
//	}
//}
//Category.run();