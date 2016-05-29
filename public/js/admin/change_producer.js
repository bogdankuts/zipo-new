/**
 * Created by BogdanKootz on 28.05.16.
 */
// CLEAR ITEM BUTTON
$('.clear_item_button').on('click', function(e) {
	e.preventDefault();
	var $form = $('.update_item_form');
	$form.find('input[name="producer"]').val("");
	$form.find('.mdl-textfield').removeClass('is-upgraded');
	$form.find('.mdl-textfield').removeClass('is-dirty');
});