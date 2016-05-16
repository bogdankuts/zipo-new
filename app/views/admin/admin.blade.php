@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	@include('partials/flash_messages')
	<h1 class="admin_uni_heading">Панель управления</h1>
	<div class="admin_main_content">
		<div class="admin_panel_import_div">
			<p class="admin_uni_label"><i class="fa fa-reply"></i> Импорт</p>
			{{ Form::open(['url'=>'/admin/import', 'files'=>true, 'method'=>'POST', 'class'=>'admin_panel_import']) }}
				{{ Form::file('excel', ['class'=>'admin_panel_input']) }}
				{{ Form::submit('Импортировать', ['class'=>'btn admin_uni_button']) }}
			{{ Form::close() }}
		</div>
		<div class="admin_panel_search_div">
			<p class="admin_uni_label"><i class="fa fa-search"></i> Поиск по артикулу</p>
			{{ Form::open(array('url' => "/admin/search", 'method' => 'GET', 'class'=>'admin_panel_search')) }}
				{{ Form::text('query', null, ['placeholder'=>"Поиск по каталогу", 'class'=>'form-control admin_input_search', 'id' =>'search']) }} 
				{{ Form::submit('Поиск', ['class'=>'btn admin_uni_button']) }}
			{{ Form::close() }}
		</div>
		<div class="admin_panel_discount_div">
			<p class="admin_uni_label">% Скидка для<br> зарегистрированных<br> пользователей</p>
			{{ Form::open(array('url' => "/admin/set_discount?discount=$discount", 'method' => 'POST', 'class'=>'admin_discount_input')) }}
				{{ Form::text('discount', $discount, ['class'=>'form-control discount_input', 'required']) }} 
				{{ Form::submit('Изменить', ['class'=>'btn admin_uni_button']) }}
			{{ Form::close() }}
		</div>
		<div class="admin_panel_discount_div">
			<p class="admin_uni_label rate_label">Текущий курс евро<br />на {{Carbon\Carbon::now()->format('d-m-Y')}}</p>
			{{ Form::open(array('url' => "/admin/set_eur_rate", 'method' => 'POST', 'class'=>'admin_discount_input rate_input')) }}
				{{ Form::text('rate', $current_EUR_rate, ['class'=>'form-control discount_input', 'required']) }} 
				{{ Form::submit('Изменить', ['class'=>'btn admin_uni_button']) }}
			{{ Form::close() }}
			{{-- 
			{{ Form::open(array('url' => "/admin/set_rate?rate=$rate", 'method' => 'POST', 'class'=>'admin_discount_input')) }}
				{{ Form::text('rate', $rate, ['class'=>'form-control discount_input', 'required']) }} 
				{{ Form::submit('Изменить', ['class'=>'btn admin_uni_button']) }}
			{{ Form::close() }} --}}
		</div>
	</div>
	<h1 class="admin_uni_heading">Загрузка деталировки</h1>
	<div class="admin_main_content">
		<div class="admin_panel_pdf_div">
			<p class="admin_uni_label"><i class="fa fa-file-pdf-o"></i>Загрузить деталировку</p>
			{{ Form::open(['url'=>'/admin/import_pdf', 'files'=>true, 'method'=>'POST', 'class'=>'admin_panel_import_pdf']) }}
				{{ Form::file('file', ['class'=>'admin_pdf_input']) }}
				<div class="good">
					{{ Form::label('good', 'Название товара', ['class'=>'admin_uni_label good_label']) }}
					{{ Form::text('good', '', ['class'=>'form-control good_input', 'required']) }}
				</div>
				<div class="producer">
					{{ Form::label('producer_id', 'Призводитель', ['class'=>'admin_uni_label category_label']) }}
					{{ Form::select('producer_id', $HELP::createOptions($producers, 'producer_id', 'producer'), null, ['class'=>'form-control producer_input', 'required']) }}
					{{-- {{ Form::text('producer_id', null, ['class'=>'js_autocomplete producer_input form-control', 'required']) }}
					<script>
						window.PRODUCERS_TITLES = {{ json_encode($producers->lists('producer')) }};
						window.PRODUCERS = {{ json_encode($producers->lists('producer', 'producer_id')) }};
					</script> 
					--}} 
				</div>
				<div class="change_item_category_div">
					{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_main_label']) }}
					{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], null, ['class'=>'form-control', 'required']) }}
				</div>
				<div class="change_item_subcat_div">
					{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_main_label']) }}
					@if (isset($pdf))
						{{ Form::select('subcat_id', [], null, ['class'=>'form-control subcat_input', 'required', 'data-id'=>"$pdf->subcat_id"]) }}
					@elseif (null != Input::old('subcat_id'))
						<?php $options = $HELP::createOptions(Subcat::where('category', Input::old('category'))->groupBy('subcat_id')->orderBy('subcat', 'asc')->get(), 'subcat_id', 'subcat'); ?>
						{{ Form::select('subcat_id', $options, Input::old('subcat_id'), ['class'=>'form-control subcat_input', 'required', 'data-old-input' => 'true']) }}
					@else
						{{ Form::select('subcat_id', [], null, ['class'=>'form-control subcat_input', 'required']) }}
					@endif

				</div>
				{{ Form::submit('Загрузить', ['class'=>'btn admin_uni_button']) }}
			{{ Form::close() }}
			<a href="/admin/list_pdf" class="btn admin_uni_button to_pdf">Перейти к деталировкам</a>
		</div>
	</div>
	@if (Auth::admin()->get()->master)
		<h1 class="admin_uni_heading">Добавить админа</h1>
		<div class="admin_main_content">
			<div class="admin_panel_pdf_div">
				{{ Form::open(['url'=>'/admin/new_admin', 'files'=>false, 'method'=>'POST', 'class'=>'admin_panel_import_pdf']) }}
				<div class="good">
					{{ Form::label('login', 'Login', ['class'=>'admin_uni_label good_label']) }}
					{{ Form::text('login', '', ['class'=>'form-control good_input', 'required']) }}
				</div>
				<div class="good">
					{{ Form::label('password', 'Password', ['class'=>'admin_uni_label good_label']) }}
					{{ Form::text('password', '', ['class'=>'form-control good_input', 'required']) }}
				</div>
				<div class="good">
					{{ Form::label('master', 'Master', ['class'=>'admin_uni_label good_label']) }}
					{{ Form::checkbox('master',true, true, ['class'=>'form-control good_input']) }}
				</div>
				{{ Form::submit('Add', ['class'=>'btn admin_uni_button']) }}
				{{ Form::close() }}
				<a href="/admin/list_admins" class="btn admin_uni_button to_pdf">Перейти к admins</a>
			</div>
		</div>
	@endif
@stop
