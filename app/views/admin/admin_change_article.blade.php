@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	@include('partials/flash_messages')
	<h1 class="admin_uni_heading">Добавить новость</h1>
	<div class="admin_main_content">
		{{ Form::model($article, ['url'=>[URL::to('/admin/update_article?'.Request::getQueryString())], 'method'=>'POST', 'class'=>'article_update_form']) }}
			<div class="change_article_title_block">
 				{{ Form::label('title', 'Заголовок: ', ['class'=>'admin_uni_label']) }}
				{{ Form::text('title', null, ['class'=>'form-control change_article_title_form', 'required']) }}
				<a href="/admin/articles" class="change_adrticle_to_all"><i class="fa fa-list-alt"></i>&nbsp К списку новостей</a>
			</div>
			<div class="change_article_weight_div">
 				{{ Form::label('weight', 'Вес новости: ', ['class'=>'admin_uni_label']) }}
				{{ Form::text('weight', null, ['class'=>'form-control change_article_weight_form', 'required']) }}
			</div>
			<div class="change_article_descript_block">
				{{ Form::textarea('body', null, array('class' => 'name', 'id' => 'ckeditor')) }}
			</div>
			<p class="admin_uni_label">Добавить миниатюру для статьи</p>

			<div class="change_article_img">
				<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
				<a id="trigger_link_img" class="btn admin_uni_button add_img">Выбрать миниатюру</a>
			</div>

			<div class="img_preview">
				@if (isset($article->photo) && $article->photo != 'no_photo.png')
					<img src='{{ URL::to("img/photos/")}}/{{ $article->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$article->photo }}'>
					<i class="fa fa-times delete_img_icon_ajax"></i>
					{{ Form::hidden('old', $article->photo) }}
					{{ Form::hidden('photo', $article->photo, ['class' => 'inserted_input']) }}
				@else
					{{ Form::hidden('old', 'no_photo.png') }}
					{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
					<img src='{{ URL::to("img/photos/")}}/{{ "no_photo.png" }}' class='items_item_img' >
				@endif
			{{-- 	@if (Session::get('temp_article'))
					<img src='{{ URL::to("img/photos/")}}/{{ Session::get("temp_article") }}' class='items_item_img'>
					<i class="fa fa-times delete_img_icon"></i>
				@else
					{{ HTML::image("img/photos/no_photo.png", "", ['class'=>'items_item_img']) }}
				@endif --}}	
			</div>

			{{ Form::submit('Сохранить', ['class'=>'btn admin_uni_button']) }}
			<div class="change_item_buttons">
				<a class="btn admin_uni_button article_clean">Очистить</a>
			</div>
		{{ Form::close() }}

		@if ($article)
			{{ Form::open(['url'=>"/admin/delete_article?article_id=$article->article_id", 'method'=>'POST', 'class'=>'admin_panel_import']) }}
				{{ Form::submit('Удалить', ['class'=>'btn admin_uni_button btn_del delete_items_group_icon']) }}
			{{ Form::close() }}
		@endif
	</div>
@stop