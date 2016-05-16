@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')

@section('meta')
	<title>Зип Общепит -{{ $item->title }}. Страница заказа</title>
	<meta name='keywords' content='{{ $item->producer }} - {{ $item->title }}. Страница заказа'>
	<meta name='description' content='{{ $item->producer }} - {{ $item->title }}. {{ $item->description }}. Страница заказа'>
@stop

@section('body')
	<div class="main_content">
		<h2 class="order_heading universal_heading">Форма заказа</h2>
		<hr class="main_hr">
		{{ Form::model($item, ['url'=>['/order'], 'method'=>'POST', 'files' => true, 'class'=>'item_form']) }}
			<table class="order_form_table">
				<tr>
					<td>{{ Form::label('name', 'Имя: ', ['class'=>'main_label req']) }}</td>
					<td>{{ Form::text('name', null, ['class'=>'change_input form-control', 'required']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('surname', 'Фамилия: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('surname', null, ['class'=>'change_input form-control']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('title', 'Наименование: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('title', null, ['class'=>'change_input change_input_short form-control', 'required', 'readonly'=>'readonly']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('code', 'Код: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('code', null, ['class'=>'change_input change_input_code form-control', 'required', 'readonly'=>'readonly']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('price', 'Стоимость: ', ['class'=>'main_label']) }}</td>
					@if($item->price == 0.00)
						<td>{{ Form::text('price', 'По запросу', ['class'=>'change_input_order form-control', 'required', 'readonly'=>'readonly']) }}</td>
					@else	
						@if (Auth::user()->check())
							<td>{{ Form::text('price', $HELP::discount_price($item->price), ['class'=>'change_input_order form-control', 'required', 'readonly'=>'readonly']) }}</td>
						@else 
							<td>{{ Form::text('price', $item->price, ['class'=>'change_input_order form-control', 'required', 'readonly'=>'readonly']) }}</td>
						@endif
					@endif
					{{-- <td>{{ Form::text('price', $item->price, ['class'=>'change_input_order form-control', 'required', 'readonly'=>'readonly']) }}</td> --}}
				</tr>
				<tr>
					<td>{{ Form::label('currency', 'Валюта: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('currency', null, ['class'=>'change_input_order form-control', 'required', 'readonly'=>'readonly']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('phone', 'Телефон: ', ['class'=>'main_label req']) }}</td>
					<td>{{ Form::text('phone', null, ['class'=>'change_input change_input_code form-control', 'required']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('email', 'E-Mail: ', ['class'=>'main_label req']) }}</td>
					<td>{{ Form::email('email', null, ['class'=>'change_input change_input_code form-control', 'required']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('company', 'Компания: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('company', null, ['class'=>'change_input change_input_code form-control',]) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('requisites', 'Реквизиты: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::file('requisites', ['class'=>'change_input change_input_code form-control',]) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('comment', 'Комментарий: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::textarea('comment', null, ['class'=>'change_input change_input_code form-control',]) }}</td>
				</tr>
			</table>
			{{ Form::submit('Отправить', ['class'=>'submit_field save_button btn']) }}
		{{ Form::close() }}
	</div>
@stop