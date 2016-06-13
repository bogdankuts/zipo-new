@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="admin_panel_pdf_div">
			{{ Form::model($admin, ['url'=>[URL::to('/admin/update_admin?'.Request::getQueryString())], 'files'=>false, 'method'=>'POST', 'class'=>'admin_panel_import_pdf']) }}
			<div class="good">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					{{ Form::label('login', 'Логин', ['class'=>'mdl-textfield__label']) }}
					{{ Form::text('login', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'login']) }}
				</div>
			</div>
			<div class="good">
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					@if(isset($admin))
						{{ Form::label('new_password', 'Новый пароль', ['class'=>'mdl-textfield__label']) }}
						{{ Form::text('new_password', null, ['class'=>'mdl-textfield__input', 'id' => 'password']) }}
					@else
						{{ Form::label('new_password', 'Пароль', ['class'=>'mdl-textfield__label']) }}
						{{ Form::text('new_password', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'password']) }}
					@endif
				</div>
			</div>
			<div class="good">
				<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="master" id="master_tooltip">
					{{ Form::checkbox('master', true, true, ['class'=>'mdl-switch__input', 'id'=>'master']) }}
					<span class="mdl-switch__label">Сделать master-админом</span>
				</label>
				<div class="mdl-tooltip" for="master_tooltip">
					Master-админ <br>может создавать и редактировать<br> админов
				</div>
			</div>
			{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent submit_admin']) }}
			{{ Form::close() }}
		</div>
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/admins.js') }}
@stop