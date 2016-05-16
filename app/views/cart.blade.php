@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@include('partials/initial_meta')

@section('body')
    <div class="main_content">
        <ol class="breadcrumb">
            <li><a href="/">Главная</a></li>
            <li class="active">Корзина</li>
        </ol>
        <h2 class="about_heading universal_heading">Корзина</h2>
        <hr class="main_hr">
        <div class="about_text_block">
            @foreach($cart_items as $cart_item)
                <div class="empty_scape cart_scape" id="itemsRow_{{$cart_item->id}}">
                    <div class="items_item_one">
                        <div class="items_item_text_block">
                            <div class="items_item_heading">
                                <div class="name_and_code">
                                    <div class="items_item_name_div">
                                         <p class="items_item_name_full">{{$cart_item->title}}</p>
                                         <p class="items_item_name">{{$cart_item->title}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="items_item_code_div">
                                    <p class="items_item_code">Кол-во:
                                        <input type="number" min="1" class="cart_input countItemsEvent" name="count[{{$cart_item->id}}]" data-id="{{$cart_item->id}}" data-price="{{$cart_item->price}}" value="{{$cart_item->count}}">
                                    </p>
                                </div>
                            <div class="items_item_price_div">
                                    <p class="items_item_price">Цена: {{$cart_item->price}}&nbsp</p>
                                    <p class="items_item_currency">руб.</p>
                                </div>
                            <div class="name_and_code summ_div">
                                    <div class="items_item_name_div">
                                        <span class="cart_item_sum">
                                            Сумма: <span id="itemTotal_{{$cart_item->id}}">{{$cart_item->price * $cart_item->count}}</span> руб.
                                         </span>
                                    </div>
                                </div>
                        </div>
                        <div class="items_buttons">
                            <a href="" class="btn btn-default items_button items_order items_order--delete js_item_remove" data-id="{{$cart_item->id}}" data-price="{{$cart_item->price}}">Убрать из корзины</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="bottom_block">
                <a href="/order" class="btn btn-default items_button items_order">Оформить заказ</a>
                <div class="in_total">
                    <p>ИТОГО:</p>
                    <p class="general_amount"><span class="totalAmountContainer">0</span>
                    </p><p class="currency">руб.</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
@stop