/**
 * Created by BogdanKootz on 24.05.16.
 */

$category = $('#CategorySelect').val();
console.log($category);

$subcategory = $('#subcategoryActive').val();

//	choose active category
$(document).ready(function() {
	getSubcats($category, $subcategory);
});

$('#CategorySelect').on('change', function() {
	$categorySelected =  $(this).val();
	getSubcats($categorySelected, '');
});


function getSubcats($category, $subcategory) {
	$.ajax({
		url: location.origin+'/admin/ajax-get-subcategories',
		type: 'POST',
		dataType: "json",
		data: {
			'category' : $category
		},
		success: function(data) {
			$subcats = $('#SubcategoriesSelect');
			// CLEAR OLD SUBCATS
			$subcats.html('');

			for (var i = 0; i < data.length; i++) {
				var subcat = data[i]['subcat'];
				var subcat_id = data[i]['subcat_id'];

				var $option = $("<option value='" + subcat_id + "'>" + subcat + "</option>");
				$subcats.append($option);
			}

			if ($subcategory !== '') {
				$subcats.val($subcategory);
			}
		},
		error: function(data, error, error_details){
			console.log("err:",error, error_details);
			console.log(data);
		}
	});
}

// CLEAR ITEM BUTTON
$('.clear_item_button').on('click', function(e) {
	e.preventDefault();
	var $form = $('.update_item_form');
	$form.find('input[name="title"]').val("");
	$form.find('input[name="meta_title"]').val("");
	$form.find('input[name="meta_description"]').val("");
	$form.find('input[name="code"]').val("");
	$form.find('select[name="category"]').val("Механическое_en");
	getSubcats("Механическое_en", '');
	var first_p = $form.find('select[name="producer_id"] option').eq(0).val();
	$form.find('select[name="producer_id"]').val(first_p);
	$form.find('input[name="price"]').val("");
	$form.find('select[name="currency"]').val("РУБ");
	$form.find("label[for='procurement']").addClass('is-checked');
	$form.find('input[name="procurement"]').prop("checked", true)
	$form.find('textarea[name="description"]').val("");
	$form.find("label[for='special']").removeClass('is-checked');
	$form.find("label[for='hit']").removeClass('is-checked');
	$form.find('input[name="special"]').prop("checked", false);
	$form.find('input[name="hit"]').prop("checked", false);
});
