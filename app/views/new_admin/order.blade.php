@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')
@extends('new_admin/partials/modals-add_state')


@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--orders mdl-cell mdl-cell--12-col order">
		<h2>Заказ №{{$order->order_id}}</h2>
		<div class="order_part mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<p class="title mdl-card__title-text">Подробности заказа</p>
			</div>
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
				<p class="heading">Оплата</p>
				@if($order->payment === 'card')
					<p class="value">Оплата на карту "Сбербанка"(скидка 10% не указана в сумме заказа!)</p>
				@elseif ($order->payment === 'check')
					<p class="value">Оплата по счету(юр.лица)</p>
				@else
					<p class="value">Оплата по счету(физ.лица)</p>
				@endif
			</div>
			@if($order->address != '')
				<div class="line">
					<p class="heading">Адресс</p>
					<p class="value">{{$order->address}}</p>
				</div>
			@endif
			<div class="line">
				<p class="heading">Стасус</p>
				{{ Form::select('state_id', $HELP::createOptions($states, 'state_id', 'state_title'), $order->state_id, ['class'=>'form-control state', 'required', 'form' => 'none', 'data-target' => $order->order_id]) }}
			</div>
			@if($order->comment != '')
				<div class="line">
					<p class="heading">Комментарий</p>
					<p class="value">{{$order->comment}}</p>
				</div>
			@endif
			@if($order->requisites != '')
				<div class="line">
					<p class="heading">Реквизиты</p>
					{{HTML::link("/requisites/$order->requisites", "Заказ № $order->order_id реквизиты | загрузка",['target'=>'_blank', 'download'=>'', 'class' => 'value']) }}
				</div>
			@endif
			<div class="delete_block">
				{{ Form::open(['url'=>"/admin/delete_order?order_id=$order->order_id", 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
				{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
				{{ Form::close() }}
			</div>
		</div>
		<div class="client_part mdl-card mdl-shadow--2dp">
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
					<a href="mailto::{{$order->email}}" class="value">{{$order->email}}</a>
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
			<div class="line">
				@if($order->number_of_order <= 1)
					<p class="heading clients_order">Это первый заказ клиента!</p>
				@else
					<p class="heading clients_order">Этот клиент сделал {{$order->number_of_order}} заказов(а)!</p>
				@endif
				<div class="client_more">
					<a href="/admin/detailed_client?client_id={{$order->client_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее о клиенте
					</a>
				</div>
			</div>
		</div>
		<div class="items_part mdl-card mdl-shadow--2dp">
			<p class="title">Товары в заказе (всего: {{count($order->items)}})</p>
			@foreach($order->items as $item)
				<div class="empty_scape">
					@if ($item->hit&&$item->special)
						{{ HTML::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
						{{ HTML::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag_d']) }}
					@elseif ($item->hit)
						{{ HTML::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
					@elseif ($item->special)
						{{ HTML::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag']) }}
					@endif
					<div class="@if ($item->hit) item_hit @elseif ($item->special) item_spec @endif items_item_one admin_items"><!--last class is for admin css-->
						<div class="items_item_text_block">
							<div class="items_item_heading">
								<div class="name_and_code">
									<div class="items_item_name_div">
										<p class="items_item_name">{{$item->title}}</p>
										<p class="items_item_name_full">{{$item->title}}</p>
									</div>
								</div>
								<div class="items_item_code_div">
									<p class="items_item_code">Арт: {{$item->code}}</p>
									<p class="items_item_code_full">Арт: {{$item->code}}</p>
								</div>
								@if ($item->price == 0.00)
									<div class="items_item_price_div">
										<p class="items_item_price">По запросу&nbsp</p>
										<p class="items_item_currency"></p>
									</div>
								@else
									<div class="items_item_price_div">
										<p class="items_item_price">{{$item->price}}&nbsp</p>
										<p class="items_item_currency">{{$item->currency}}.</p>
									</div>
								@endif
							</div>
							<div class="items_item_descript">
								{{ HTML::image("img/photos/$item->photo", "$item->title", ['class'=>'items_page_item_img']) }}
								<table class="items_item_text">
									<tr>
										<td colspan='2' class="small_heading">Характеристики</td>
									</tr>
									<tr>
										<td>Бренд:&nbsp&nbsp&nbsp&nbsp</td>
										<td class="items_item_dyn_text">{{$item->producer->producer}}</td>
									</tr>
									<tr>
										<td>Код:</td>
										<td class="items_item_dyn_text">{{$item->code}}</td>
									</tr>
									<tr>
										<td>Тип:&nbsp</td>
										<td class="items_item_dyn_text">{{$item->subcat->subcat}}</td>
									</tr>
									<tr>
										<td>Наличие:&nbsp</td>
										@if ($item->procurement)
											<td>В наличии</td>
										@else
											<td>Под заказ</td>
										@endif
									</tr>
								</table>
							</div>
							<div class="result_block">
								<p class="quantity">{{$item->count}}</p>
								<p class="times">X</p>
								<p class="price">{{$item->price}}</p>
								<p class="eq">=</p>
								<p class="result">{{$item->price * $item->count}} руб.</p>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			<div class="final_sum_block">
				<p class="general_sum">Сумма {{$order->sum}} руб.</p>
			</div>
		</div>
	</div>
	<div class="add_btn" id="add_btn">
		<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#addState">
			<i class="material-icons">add</i>
		</a>
	</div>
	<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
		Добавить статус заказа
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/orders.js') }}
@stop
