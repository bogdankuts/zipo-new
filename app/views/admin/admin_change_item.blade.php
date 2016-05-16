@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	@include('partials/flash_messages')
	<h1 class="admin_uni_heading">Добавить товар</h1>
	<div class="admin_main_content">
		{{ Form::model($item, ['url'=>[URL::to('/admin/update_item?'.Request::getQueryString())], 'class'=>'update_item_form', 'method'=>'POST']) }}
			<div class="change_block change_item_title_block">
				{{ Form::label('title', 'Название', ['class'=>'admin_uni_label']) }}
				{{ Form::text('title', null, ['class'=>'form-control title_input', 'required']) }}
			</div>
			<div class="left_block">
				<div class="change_block change_item_code_block">
					{{ Form::label('code', 'Артикул', ['class'=>'admin_uni_label']) }}
					{{ Form::text('code', null, ['class'=>'form-control code_input', 'required']) }}
				</div>
				<div class="change_block change_item_category_div">
					{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_label']) }}
					{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], null, ['class'=>'form-control', 'required']) }}
				</div>
				<div class="change_block change_item_producer_div">
					{{ Form::label('producer_id', 'Производитель', ['class'=>'admin_uni_label producer_label']) }}
					{{ Form::select('producer_id', $HELP::createOptions($producers, 'producer_id', 'producer'), null, ['class'=>'form-control producer_input', 'required']) }}
				</div>
			</div>
			<div class="right_block">	
				<div class="change_block change_item_price_div">
					{{ Form::label('price', 'Цена', ['class'=>'admin_uni_label']) }}
					{{ Form::number('price', null, ['class'=>'form-control price_input', 'required', 'onkeypress'=>'validate(event)']) }}
				</div>
				<div class="change_block change_item_cur_div">
					{{ Form::label('currency', 'Валюта', ['class'=>'admin_uni_label']) }}
					{{-- {{ Form::text('currency', isset($item) ? null : 'RUB', ['class'=>'form-control currency_input', 'required']) }} --}}
					@if (isset($item))
						{{ Form::select('currency', ['РУБ'=>'RUB', 'EUR'=>'EUR'], $item->currency, ['class'=>'form-control currency_input', 'required']) }}
					@else
						{{ Form::select('currency', ['РУБ'=>'RUB', 'EUR'=>'EUR'], null, ['class'=>'form-control currency_input', 'required']) }}
					@endif
				</div>
				<div class="change_block change_item_subcat_div">
					{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_label']) }}
					@if (isset($item))
						{{ Form::select('subcat_id', [], null, ['class'=>'form-control subcat_input', 'required', 'data-id'=>"$item->subcat_id"]) }}
					@elseif (null != Input::old('subcat_id'))
						<?php $options = $HELP::createOptions(Subcat::where('category', Input::old('category'))->groupBy('subcat_id')->orderBy('subcat', 'asc')->get(), 'subcat_id', 'subcat'); ?>
						{{ Form::select('subcat_id', $options, Input::old('subcat_id'), ['class'=>'form-control subcat_input', 'required', 'data-old-input' => 'true']) }}
					@else
						{{ Form::select('subcat_id', [], null, ['class'=>'form-control subcat_input', 'required']) }}
					@endif
				</div>
				<div class="change_block change_item_procurement_div">
					{{ Form::label('procurement', 'Наличие', ['class'=>'admin_uni_label proc_label']) }}
					{{ Form::checkbox('procurement', true, true, ['class'=>'']) }}
				</div>
			</div>	
			<div class="change_block change_item_descript_block">
				{{ Form::label('description', 'Описание', ['class'=>'admin_uni_label descr_label']) }}
				{{ Form::textarea('description', null, ['class'=>'form-control descr_input']) }}
			</div>
			<div class="make_spec_block">
				{{ Form::label('special', 'Добавить в спецпредложения', ['class'=>'admin_uni_label']) }}
				{{ Form::checkbox('special', true, false) }}
			</div>
			<div class="make_hit_block">
				{{ Form::label('hit', 'Сделать хитом продаж', ['class'=>'admin_uni_label']) }}
				{{ Form::checkbox('hit', true, false) }}
			</div>
			<p class="admin_uni_label">Добавить изображение<br> 110*95 пикс.</p>

			<div class="change_item_img">
				<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
				<a id="trigger_link_img" class="btn admin_uni_button">Выбрать картинку</a>
			</div>

			<div class="img_preview">
				@if (isset($item->photo) && $item->photo != 'no_photo.png')
					<img src='{{ URL::to("img/photos/")}}/{{ $item->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$item->photo }}'>
					<i class="fa fa-times delete_img_icon_ajax"></i>
					{{ Form::hidden('old', $item->photo) }}
					{{ Form::hidden('photo', $item->photo, ['class' => 'inserted_input']) }}
				@else
					{{ Form::hidden('old', 'no_photo.png') }}
					{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
					<img src='{{ URL::to("img/photos/")}}/{{ "no_photo.png" }}' class='items_item_img' >
				@endif
			</div>

			{{ Form::submit('Сохранить', ['class'=>'btn admin_uni_button low_button']) }}
			<div class="change_item_buttons">
				<p class="btn admin_uni_button clear_item_button low_button">Очистить</p>
			</div>
		{{ Form::close() }}

		@if ($item)
			{{ Form::open(['url'=>"/admin/delete_item?item_id=$item->item_id", 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
				{{ Form::submit('Удалить', ['class'=>'btn admin_uni_button btn_del delete_items_group_icon']) }}
			{{ Form::close() }}	
		@endif
	</div>
@stop