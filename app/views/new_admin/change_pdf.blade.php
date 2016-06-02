@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col pdf">
		{{ Form::model($pdf, ['url'=>[URL::to('/admin/update_pdf?'.Request::getQueryString())], 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
				{{ Form::label('good', 'Название', ['class'=>'mdl-textfield__label']) }}
				@if(isset($pdf))
					{{ Form::text('good', $pdf->good, ['class'=>'mdl-textfield__input', 'required', 'id' => 'good', 'maxlength'=>'128']) }}
				@else
					{{ Form::text('good', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'good', 'maxlength'=>'128']) }}
				@endif

			</div>
		</div>
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_label']) }}
				@if(isset($pdf))
					{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $pdf->category, ['class'=>'form-control', 'required', 'id'=>'CategorySelect']) }}
				@else
					{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], null, ['class'=>'form-control', 'required', 'id'=>'CategorySelect']) }}
				@endif
			</div>
		</div>
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_label']) }}
				{{ Form::select('subcat_id', [], '', ['class'=>'form-control admin_select_title_text', 'required', 'id'=>'SubcategoriesSelect']) }}
				@if (isset($pdf))
					{{ Form:: hidden('subcategoryActive', $pdf->subcat_id, ['id'=>'subcategoryActive']) }}
				@else
					{{ Form:: hidden('subcategoryActive', '', ['id'=>'subcategoryActive']) }}
				@endif
			</div>
		</div>
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('producer_id', 'Производитель', ['class'=>'admin_uni_label producer_label']) }}
				@if(isset($pdf))
					{{ Form::select('producer_id', $HELP::createOptions($producers, 'producer_id', 'producer'), $pdf->producer_id, ['class'=>'form-control producer_input', 'required']) }}
				@else
					{{ Form::select('producer_id', $HELP::createOptions($producers, 'producer_id', 'producer'), null, ['class'=>'form-control producer_input', 'required']) }}
				@endif
			</div>
		</div>
		@if(isset($pdf))
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="file_div">
				{{ Form::label('file_old', 'Название', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('file_old', $pdf->file, ['class'=>'mdl-textfield__input', 'id' => 'good', 'disabled']) }}
			</div>
		</div>
		@else
			<div class="change_block change_item_title_block">
				<p class="admin_uni_label">Загрузить деталировку</p>
				{{Form::file('file', ['required'])}}
			</div>
			@endif
		<div class="change_item_buttons">
			<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent clear_item_button low_button">Очистить</p>
			{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		</div>
		{{ Form::close() }}
		<div class="change_item_delete">
			@if (isset($pdf))
				{{ Form::open(['url'=>"/admin/delete_pdf?pdf_id=$pdf->pdf_id", 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
				{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
				{{ Form::close() }}
			@endif
		</div>
		<div class="add_btn" id="add_btn">
			<a href="/admin/create_pdf" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить деталировку
		</div>
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/change_item.js') }}
	{{ HTML::script('js/admin/change_pdf.js') }}
	{{ HTML::script('js/jquery.ui.widget.js') }}
	{{ HTML::script('js/jquery.fileupload.js') }}
	{{ HTML::script('js/admin/image_upload.js') }}
@stop