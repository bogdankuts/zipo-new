/**
 * Created by BogdanKootz on 25.05.16.
 */
//FILE UPLOAD
$('#trigger_link_img').click(function(e){
	e.preventDefault();
	$('.browse_img_admin').trigger('click');
	console.log('correct');
});

$(function() {
	$('#fileupload').fileupload({
		dataType: 'json',
		done: function (e, data) {
			filename = data.result;
			console.log('filename ' + filename);
			var timestamp = new Date().getTime();
			var $input = $('.inserted_input');
			$input.val(filename);
			console.log('input ' +  $input);
			var $delete_icon = $('.delete_img_icon_ajax');
			console.log('icon ' + $delete_icon);
			var $img = $('.items_item_img');
			console.log('img ' + $img);

			$('.delete_img_icon_ajax').remove();
			$('.inserted_input').remove();
			$('.browse_img_admin').after($input);
			$img.after($delete_icon);
			$img.attr('src', location.origin+'/img/photos/'+filename+'?no_cache='+timestamp);

			delegateDeleteEvent();
		}
	});
});

// DELETE IMG ICON
function delegateDeleteEvent() {
	$('.delete_img_icon_ajax').on('click', function() {
		var $img = $('.items_item_img');
		var $input = $('.inserted_input');

		$('.inserted_input').val('no_photo.png');
		$img.attr('src', location.origin+'/img/photos/no_photo.png');
		$(this).remove();
	});
}
delegateDeleteEvent();