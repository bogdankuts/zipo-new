@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')
@extends('new_admin/partials/modals-add_state')


@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($orders as $order)
			<div class="mdl-card mdl-shadow--2dp one_order" id="{{$order->order_id}}">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Заказ № {{$order->order_id}}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="order_part">
						<p class="title">Подробности заказа</p>
						<div class="line">
							<p class="heading">Клиент</p>
							<p class="value">{{$order->name}} {{$order->surname}}</p>
						</div>
						<div class="line">
							<p class="heading">Дата</p>
							<p class="value">{{$order->date}}</p>
						</div>
						<div class="line">
							<p class="heading">Сумма</p>
							<p class="value">{{$order->sum}} руб.</p>
						</div>
						<div class="line">
							<p class="heading">Доставка</p>
							<p class="value">{{$order->delivery}}</p>
						</div>
						<div class="line">
							<p class="heading">Стасус</p>
							{{ Form::select('state_id', $HELP::createOptions($states, 'state_id', 'state_title'), $order->state_id, ['class'=>'form-control state', 'required', 'form' => 'none', 'data-target' => $order->order_id]) }}
						</div>
					</div>
					<div class="client_part">
						<p class="title">О клиенте</p>
						<div class="main">
							<div class="line">
								<p class="heading">Имя</p>
								<p class="value">{{$order->name}}</p>
							</div>
							<div class="line">
								<p class="heading">Фамилия</p>
								<p class="value">{{$order->surname}}</p>
							</div>
							<div class="line">
								<p class="heading">Компания</p>
								<p class="value">{{$order->company}}</p>
							</div>
							<div class="line">
								<p class="heading">Email</p>
								<a href="mailto:{{$order->email}} " class="value">{{$order->email}}</a>
							</div>
							<div class="line">
								<p class="heading">Телефон</p>
								<p class="value">{{$order->phone}}</p>
							</div>
						</div>
						<div class="additional">
							<div class="line">
								<p class="heading">Форма собсвтенности</p>
								<p class="value">{{$order->form_of_business}}</p>
							</div>
							<div class="line">
								<p class="heading">Дата первого заказа</p>
								<p class="value">{{$order->added_at}}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="/admin/detailed_order?order_id={{$order->order_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
					<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect about_client" id="more_{{$order->order_id}}" data-target="{{$order->order_id}}">
						Подробнее о клиенте
					</a>
					<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect client_less" id="less_{{$order->order_id}}" data-target="{{$order->order_id}}">
						Скрыть
					</a>

				</div>
				<div class="mdl-card__menu">
					<button id="{{$order->order_id}}-menu-trigger"
							class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="{{$order->order_id}}-menu-trigger">
						<li class="mdl-menu__item mark_order_done" data-id="{{$order->order_id}}">
							<p>Отметить как выполненный</p>
						</li>
						<li class="mdl-menu__item delete_order" data-id="{{$order->order_id}}">
							<p>Удалить</p>
						</li>
					</ul>
				</div>
			</div>
		@endforeach
			<div class="add_btn" id="add_btn">
				<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#addState">
					<i class="material-icons">add</i>
				</a>
			</div>
			<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
				Добавить статус заказа
			</div>
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/orders.js') }}
@stop
