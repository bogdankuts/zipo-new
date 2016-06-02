@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col pdf">
		{{ Form::model($pdf, ['url'=>[URL::to('/admin/load_pdf?'.Request::getQueryString())], 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
				{{ Form::label('good', 'Название', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('good', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'good', 'maxlength'=>'128']) }}
			</div>
		</div>
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_label']) }}
				{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], null, ['class'=>'form-control', 'required', 'id'=>'CategorySelect']) }}
			</div>
		</div>
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_label']) }}
				{{ Form::select('subcat_id', [], '', ['class'=>'form-control admin_select_title_text', 'required', 'id'=>'SubcategoriesSelect']) }}
				{{ Form:: hidden('subcategoryActive', '', ['id'=>'subcategoryActive']) }}
			</div>
		</div>
		<div class="change_block change_item_title_block">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('producer_id', 'Производитель', ['class'=>'admin_uni_label producer_label']) }}
				{{ Form::select('producer_id', $HELP::createOptions($producers, 'producer_id', 'producer'), null, ['class'=>'form-control producer_input', 'required']) }}
			</div>
		</div>
		<div class="change_block change_item_title_block">
			<p class="admin_uni_label">Загрузить деталировку</p>
			{{Form::file('file', ['required'])}}
		</div>
		<div class="change_item_buttons">
			<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent clear_item_button low_button">Очистить</p>
			{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		</div>
		{{ Form::close() }}
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/change_item.js') }}
	{{ HTML::script('js/admin/change_pdf.js') }}
	{{ HTML::script('js/jquery.ui.widget.js') }}
	{{ HTML::script('js/jquery.fileupload.js') }}
	{{ HTML::script('js/admin/image_upload.js') }}
@stop