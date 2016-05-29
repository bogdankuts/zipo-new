@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($producer, ['url'=>[URL::to('/admin/update_producer?'.Request::getQueryString())], 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('producer', 'Призводитель', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('producer', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'producer']) }}
			</div>
		</div>
		<p class="admin_uni_label admin_uni_label--subheading">Добавить изображение 150*100 пикс.</p>
		<div class="change_item_img">
			<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
			<a id="trigger_link_img" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent select_img_trigger">Выбрать картинку</a>
		</div>
		<div class="img_preview">
			@if (isset($producer->producer_photo) && $producer->producer_photo != 'no_photo.png')
				<img src='{{ URL::to("img/photos/")}}/{{ $producer->producer_photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$producer->producer_photo }}'>
				<i class="material-icons delete_img_icon_ajax">close</i>
				{{ Form::hidden('old', $producer->producer_photo) }}
				{{ Form::hidden('photo', $producer->producer_photo, ['class' => 'inserted_input']) }}
			@else
				{{ Form::hidden('old', 'no_photo.png') }}
				{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
				<img src='{{ URL::to("img/photos/")}}/{{ "no_photo.png" }}' class='items_item_img' >
			@endif
		</div>
		<div class="change_item_buttons">
			<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent clear_item_button low_button">Очистить</p>
			{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		</div>
		{{ Form::close() }}
		<div class="change_item_delete">
			@if ($producer)
				{{ Form::open(['url'=>"/admin/delete_producer?producer_id=$producer->producer_id", 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
				{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
				{{ Form::close() }}
			@endif
		</div>
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/change_producer.js') }}
	{{ HTML::script('js/jquery.ui.widget.js') }}
	{{ HTML::script('js/jquery.fileupload.js') }}
	{{ HTML::script('js/admin/image_upload.js') }}
@stop