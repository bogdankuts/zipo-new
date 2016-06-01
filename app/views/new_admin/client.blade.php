@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col client">
		<h1>Клиент {{$client->name}} {{$client->surname}}</h1>
		<div class="main">
			<div class="line">
				<p class="heading">Имя</p>
				<p class="value">{{$client->name}}</p>
			</div>
			<div class="line">
				<p class="heading">Фамилия</p>
				<p class="value">{{$client->surname}}</p>
			</div>
			<div class="line">
				<p class="heading">Компания</p>
				<p class="value">{{$client->company}}</p>
			</div>
			<div class="line">
				<p class="heading">Email</p>
				<a href="mailto:{{$client->email}} " class="value">{{$client->email}}</a>
			</div>
			<div class="line">
				<p class="heading">Телефон</p>
				<p class="value">{{$client->phone}}</p>
			</div>
			<div class="line">
				<p class="heading">Форма собсвтенности</p>
				<p class="value">{{$client->form_of_business}}</p>
			</div>
		</div>
		<div class="history">
			<div class="line">
				<p class="heading">Дата первого заказа</p>
				<p class="value">{{$client->added_at}}</p>
			</div>
			<div class="line">
				<p class="heading">Всего заказов</p>
				<p class="value">{{$client->total_orders}}</p>
			</div>
			<div class="line">
				<p class="heading">На сумму</p>
				<p class="value">{{$client->total_orders_sum}} руб.</p>
			</div>
			<div class="line">
				<p class="heading">Зарегестрирован</p>
				@if($client->registered)
					<p class="value">Да</p>
				@else
					<p class="value">Нет</p>
				@endif
			</div>
		</div>
		<div class="orders">
			<h1>Заказы клиента</h1>
			@foreach($orders as $order)
				<div class="mdl-card mdl-shadow--2dp one_order">
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
								<p class="value">{{$order->state_title}}</p>
							</div>
						</div>
						<div class="items_part">
							<p class="title">Товары в заказе</p>
							<table class="mdl-data-table mdl-js-data-table">
								<thead>
								<tr>
									<th class="">Код</th>
									<th>Наименование</th>
									<th>Наличие</th>
									<th class="">Цена</th>
									<th>Количесвто</th>
									<th>Сумма</th>
								</tr>
								</thead>
								<tbody>
									@foreach($order->items as $item)
										<tr>
											<td class="">{{$item->code}}</td>
											<td>{{$item->title}}</td>
											<td>
												@if($item->procurement == '1')
													В наличии
												@else
													Под заказ
												@endif
											</td>
											<td class="">{{$item->price}}</td>
											<td>{{$item->count}}</td>
											<td>{{$item->price*$item->count}} руб.</td>
										</tr>
									@endforeach
								</tbody>
							</table>

						</div>

					</div>
					<div class="mdl-card__actions mdl-card--border">
						<a href="/admin/detailed_order?order_id={{$order->order_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							Подробнее
						</a>
					</div>
				</div>

			@endforeach
		</div>
	</div>
@stop
@section('specific_page_js')
	{{--	{{ HTML::script('js/admin/orders.js') }}--}}
@stop
