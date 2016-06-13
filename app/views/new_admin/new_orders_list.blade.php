@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
    <div class="new_orders_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
        @foreach($newOrders as $recentOrder)
            <div class="card-orders mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Заказ № {{$recentOrder->order_id}}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-js-data-table">
                        <tbody>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Клиент</th>
                            <th>{{$recentOrder->name}} {{$recentOrder->surname}}</th>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Дата</td>
                            <td>{{$recentOrder->date}}</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Стасус</td>
                            <td>{{$recentOrder->state_title}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="/admin/detailed_order?order_id={{$recentOrder->order_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Подробнее
                    </a>
                </div>
				<div class="mdl-card__menu">
					<button id="{{$recentOrder->order_id}}-menu-trigger"
							class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="{{$recentOrder->order_id}}-menu-trigger">
						<li class="mdl-menu__item mark_order_done" data-id="{{$recentOrder->order_id}}">
							<p>Отметить как выполненный</p>
						</li>
						<li class="mdl-menu__item delete_order" data-id="{{$recentOrder->order_id}}">
							<p>Удалить</p>
						</li>
					</ul>
				</div>
            </div>
        @endforeach
    </div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/orders.js') }}
@stop
