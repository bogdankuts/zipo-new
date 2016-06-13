@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')

@section('meta')
    <title>Зип Общепит - Заказ</title>
    <meta name='keywords' content='Страница заказа'>
    <meta name='description' content='Страница заказа'>
@stop

@section('body')
    <div class="main_content">
        <h2 class="order_heading universal_heading">Форма заказа</h2>
        <hr class="main_hr">
        <p class="contents">Содержимое вашей корзины</p>
        @foreach($items as $item)
            <div class="cart_one_item">
                <span class="cart_item_name">
                   {{$item->title}}
                </span>
                <span class="cart_item_price">
                    <span class="word_price">
                        Цена:
                    </span>
                    <span class="price">
                        {{$item->price}}
                    </span>
                    <span class="monetary_unit">
                        руб.
                    </span>
                </span>
                <span class="cart_item_amount">
                    Кол-во:
                </span>
                <p class="cart_input">{{$item->count}}</p>
                <span class="cart_item_sum">
                    Сумма: {{$item->count * $item->price}}
                </span>
            </div>
        @endforeach
        <div class="in_total">
            <p>ИТОГО:</p>
            <p class="general_amount"><span class="totalAmountContainer">0</span>
            </p><p class="currency">руб.</p>
            <p></p>
        </div>

        {{Form::open(['url' => 'order', 'method'=>'POST', 'files' => true, 'class'=>'order_form'])}}
            <div class="general_info">
                {{ Form::label('name', 'Имя: ', ['class'=>'main_label req']) }}
                @if (Auth::user()->check())
                    {{ Form::text('name', Auth::user()->get()->name, ['class'=>'change_input form-control', 'required']) }}
                @else
                    {{ Form::text('name', null, ['class'=>'change_input form-control', 'required']) }}
                @endif
                {{ Form::label('surname', 'Фамилия: ', ['class'=>'main_label req']) }}
                @if (Auth::user()->check())
                    {{ Form::text('surname', Auth::user()->get()->surname, ['class'=>'change_input form-control', 'requierd']) }}
                @else
                    {{ Form::text('surname', null, ['class'=>'change_input form-control', 'requierd']) }}
                @endif
                {{ Form::label('phone', 'Телефон: ', ['class'=>'main_label req']) }}
                @if (Auth::user()->check())
                    {{ Form::text('phone', Auth::user()->get()->phone, ['class'=>'change_input change_input_code form-control', 'required']) }}
                @else
                    {{ Form::text('phone', null, ['class'=>'change_input change_input_code form-control', 'required']) }}
                @endif
                {{ Form::label('email', 'E-Mail: ', ['class'=>'main_label req']) }}
                @if (Auth::user()->check())
                    {{ Form::email('email', Auth::user()->get()->email, ['class'=>'change_input change_input_code form-control', 'required']) }}
                @else
                    {{ Form::email('email', null, ['class'=>'change_input change_input_code form-control', 'required']) }}
                @endif
                {{ Form::label('company', 'Компания: ', ['class'=>'main_label']) }}
                @if (Auth::user()->check())
                    {{ Form::text('company', Auth::user()->get()->company, ['class'=>'change_input change_input_code form-control',]) }}
                @else
                    {{ Form::text('company', null, ['class'=>'change_input change_input_code form-control',]) }}
                @endif
                <div class="payment_method">
                	<label for="form_of_business" class="main_label req">Выбирете способ оплаты</label>
					<div class="radio">
						<label>
							<input type="radio" name="form" id="jura" value="jura" class="pay_radio" checked>
							Юридические лица
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="form" id="physic" value="physic" class="pay_radio">
							Физические лица
						</label>
					</div>
					<div class="payment_method_jura">
						<div class="radio">
							<label>
								<input type="radio" name="payment_jura" id="jura_pay" value="check" class="pay_radio" checked>
								Оплата по счету
							</label>
						</div>
					</div>
					<div class="payment_method_physic">
						<div class="radio">
							<label>
								<input type="radio" name="payment_physic" id="physic_pay_card" value="card" class="pay_radio">
								Оплата на карту "Сбербанка"(скидка 10%)
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="payment_physic" id="physic_pay_check" value="physic_check" class="pay_radio" checked>
								Оплата по счету
							</label>
						</div>
					</div>
					<div class="requisites">
						{{ Form::label('requisites', 'Реквизиты для оплаты: ', ['class'=>'main_label req']) }}
						{{ Form::file('requisites', ['class'=>'change_input change_input_code form-control',]) }}
					</div>
				</div>
            </div>
            <div class="delivery_type">
                <label for="delivery" class="main_label req">Способ доставки</label>
                <select name="delivery" id="delivery" class="form-control">
                    <option value="self">Самовывоз</option>
                    <option value="St.Petersburg_delivery">Доставка По Санкт Петербургу</option>
                    <option value="TK_business_lines">Доставка до терминала ТК Деловые Линии в Санкт Петербурге</option>
                    <option value="EMC">Доставка EMC до адреса получателя.</option>
                    <option value="SDEK">Доставка экспресс почтой СДЭК до адреса получателя.</option>
                    <option value="RATEK">Доставка до терминала ТК РАТЭК в Санкт Петербурге.</option>
                    <option value="PONY">Доставка экспресс почтой Pony express  до адреса получателя.</option>
                    <option value="Dimex">Доставка экспресс почтой  dimex до адреса получателя.</option>
                    <option value="Other">Другое</option>
                </select>
                <input type="text" name="delivery_other" id="deliver_other" placeholder="Введите желаемый способ доставки" class="form-control delivery_other">
                <div class="address">
                    {{ Form::label('address', 'Адрес: ', ['class'=>'main_label']) }}
                    {{ Form::text('address', null, ['class'=>'change_input change_input_code form-control',]) }}
                </div>
			</div>
            <div class="comment">
                {{ Form::label('comment', 'Комментарий: ', ['class'=>'main_label']) }}
                {{ Form::textarea('comment', null, ['class'=>'change_input change_input_code form-control',]) }}
            </div>
				@if(Auth::user()->check())
					{{ Form::hidden('registered', Auth::user()->get()->user_id) }}
				@else
					{{ Form::hidden('registered', null) }}
				@endif
            {{Form::submit('Отправить', ['class'=>'submit_field save_button btn'])}}
        {{Form::close()}}
    </div>
@stop