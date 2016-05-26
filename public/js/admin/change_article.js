/**
 * Created by BogdanKootz on 25.05.16.
 */
//CKEDITOR EMBED
if ($('#ckeditor').length) {
	CKEDITOR.replace('ckeditor', {
		filebrowserBrowseUrl 	   : '../kcfinder/browse.php?opener=ckeditor&type=files',
		filebrowserImageBrowseUrl  : '../kcfinder/browse.php?opener=ckeditor&type=images',
		filebrowserFlashBrowseUrl  : '../kcfinder/browse.php?opener=ckeditor&type=flash',
		filebrowserUploadUrl  	   : '../kcfinder/upload.php?opener=ckeditor&type=files',
		filebrowserImageUploadUrl  : '../kcfinder/upload.php?opener=ckeditor&type=images',
		filebrowserFlashUploadUrl  : '../kcfinder/upload.php?opener=ckeditor&type=flash',
	});
}

// CLEAR ARTICLE BUTTON
$('.article_clean').on('click', function(e) {
	e.preventDefault();
	var $form = $('.article_update_form');
	$form.find('input[name="title"]').val("");
	$form.find('input[name="meta_title"]').val("");
	$form.find('input[name="meta_description"]').val("");
	$form.find('input[name="weight"]').val("");
	CKEDITOR.instances.ckeditor.setData('');
});