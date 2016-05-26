@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content--change-article mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($article, ['url'=>[URL::to('/admin/update_article?'.Request::getQueryString())], 'method'=>'POST', 'class'=>'article_update_form']) }}
		<div class="change_article_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('title', 'Заголовок: ', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('title', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'title']) }}
			</div>
		</div>
		<div class="change_article_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('meta_title', 'Meta-title: ', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('meta_title', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'meta_title']) }}
				<div class="mdl-tooltip" for="meta_title">
					Параметр, для SEO, должен <br>должен коротко и ясно отражать суть страницы<br> Максимум 70 символов
				</div>
			</div>
		</div>
		<div class="change_article_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('meta_description', 'Meta-description: ', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('meta_description', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'meta_description']) }}
				<div class="mdl-tooltip" for="meta_description">
					Параметр, для SEO, должен <br> должен описывать содержание конкретной страницы<br> Максимум 200 символов
				</div>
			</div>
		</div>
		<div class="change_article_descript_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::textarea('body', null, array('class' => 'name mdl-textfield__input', 'id' => 'ckeditor')) }}
			</div>
		</div>
		<div class="change_article_weight_div">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('weight', 'Вес новости: ', ['class'=>'mdl-textfield__label']) }}
				{{ Form::number('weight', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'title']) }}
			</div>
		</div>
		<p class="admin_uni_label admin_uni_label--subheading">Добавить миниатюру для статьи</p>

		<div class="change_article_img">
			<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
			<a id="trigger_link_img" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent select_img_trigger">Выбрать миниатюру</a>
		</div>

		<div class="img_preview">
			@if (isset($article->photo) && $article->photo != 'no_photo.png')
				<img src='{{ URL::to("img/photos/")}}/{{ $article->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$article->photo }}'>
				<i class="material-icons delete_img_icon_ajax">close</i>
				{{ Form::hidden('old', $article->photo) }}
				{{ Form::hidden('photo', $article->photo, ['class' => 'inserted_input']) }}
			@else
				{{ Form::hidden('old', 'no_photo.png') }}
				{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
				<img src='{{ URL::to("img/photos/")}}/{{ "no_photo.png" }}' class='items_item_img' >
			@endif
		</div>

		<a href="/admin/articles" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent back"><i class="fa fa-list-alt"></i>&nbsp К списку новостей</a>

		{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent save']) }}
		<div class="change_item_buttons">
			<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent article_clean">Очистить</a>
		</div>
		{{ Form::close() }}

		@if ($article)
			{{ Form::open(['url'=>"/admin/delete_article?article_id=$article->article_id", 'method'=>'POST', 'class'=>'admin_panel_import']) }}
			{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
			{{ Form::close() }}
		@endif
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/jquery.ui.widget.js') }}
	{{ HTML::script('js/jquery.fileupload.js') }}
	{{ HTML::script('js/admin/image_upload.js') }}
	{{ HTML::script('js/admin/change_article.js') }}
@stop